<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TableController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $myTables = Table::orderBy('updated_at')->paginate(6);

        return view('tables.myTables',compact('myTables'));
    }

    public function store(Request $request){
        //Usuario identificado
        $user = Auth::user();
        $idUser = $user->id;

         // Subir la imagen
        $image_path_name = 'Default.png';
        $image_path = $request->file('image_path');

        if($image_path){
            //Pongo nombre unico
            $image_path_name = time().$image_path->getClientOriginalName();

            //Guardo en la carpea Storage
            Storage::disk('tables')->put($image_path_name, File::get($image_path));

        }

        $validator = Validator::make($request->all(), [
            'id' => 'nullable',
            'user_id' => 'nullable',
            'name' => 'required',
            'description' => 'required',
            'image_path' => 'nullable'
        ]);


        if ($validator->fails()) {
            return response()->json(['status' => 0, 'validation_error' => $validator->errors()->toArray()]);
        } else {

            /**
             * La validación tiene X campos, si necesito otro más, debo meterla a otra variable
             */
            $data = $validator->validated();

            //añado valor extra
            //$data['codModel'] = $newModelCar->codModel;
            try {
                DB::beginTransaction();
                $data['user_id'] = $idUser;
                $data['image_path'] = $image_path_name;

                // dd($data);
                $table = Table::updateOrCreate(
                    ['id' => $request->id],$data
                );
                $cancel_store_trait = in_array(CancelStoring::class, class_uses(new table));
                //El trait deshabilita la edición
                if ($cancel_store_trait == true) {
                    DB::rollback();
                    return response()->json(['cancel_store_trait_error' => 'This external module has disabled any changes']);
                }
                //updateOrCreate hace un update
                if (!$table->wasRecentlyCreated && $table->wasChanged()) {

                    DB::commit();
                    return response()->json(['submit_store_success' => 'Table updated successfully']);
                }
                //updateOrCreate hace update sin realizar cambios
                else if (!$table->wasRecentlyCreated && !$table->wasChanged()) {

                    DB::commit();
                    return response()->json(['submit_store_success' => 'Table not changed']);
                    //return response()->json(['cancel_store_trait_error' => 'This external module has disabled any changes']);
                }
                //updateOrCreate hace create
                else if ($table->wasRecentlyCreated) {
                    DB::commit();
                    return response()->json(['submit_store_success' => 'Table created successfully']);
                }
            }
            //Error sentencia SQL
            catch (\Exception $myException) {
                DB::rollback();

            }

        }

    }

    public function getImage($filename){
        $file = Storage::disk('tables')->get($filename);
        return new Response($file);
    }


}
