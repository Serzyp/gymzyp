<?php

namespace App\Http\Controllers;


use App\Models\Table;
use GuzzleHttp\Client;
use App\Models\Comment;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Facade\IgnitionContracts\Solution;

class PayPalController extends Controller
{
    private $client;
    private $clientId;
    private $secret;

    public function __construct()
    {
        $this->middleware('auth');


        $this->client = new Client([
            'base_uri' => 'https://api-m.sandbox.paypal.com'
        ]);

        $this->clientId = env('PAYPAL_CLIENT_ID');
        $this->secret = env('PAYPAL_SECRET');
    }

    public function index()
    {
        return view('paypal.payment');
    }

    public function indexCompleted()
    {
        return view('paypal.completedPayment');
    }

    public function indexFailed()
    {
        return view('paypal.failedPayment');
    }


    private function getAccessToken(){
        $response = $this->client->request('POST', '/v1/oauth2/token', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'body' => 'grant_type=client_credentials',
                'auth' => [
                    $this->clientId, $this->secret, 'basic'
                ]
            ]
        );

        $data = json_decode($response->getBody(), true);
        return $data['access_token'];
    }

    // https://api-m.sandbox.paypal.com/v2/checkout/orders
    public function process($order_id,Request $request)
    {

        $accessToken = $this->getAccessToken();

        $url = '/v2/checkout/orders/' . $order_id;

        $response = $this->client->request('GET', $url , [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => "Bearer $accessToken"
            ]
        ]);



        $data = json_decode($response->getBody(), true);

        if ($data['status'] === 'APPROVED') {
            $user_id = $request->input('user_id');
            $amount = $data['purchase_units'][0]['amount']['value'];

            return [
                'success' => $this->registerSuccessfulPayment($user_id,$amount,$order_id)
            ];
        }

        return [
            'success' => false
        ];
    }

    //Devuelve true or false
    private function registerSuccessfulPayment($user_id,$amount,$order_id):bool{
        // El ?: es por si lo que viene de arriba es null
        $user_id = $user_id ?: auth()->user()->id;

        Payment::create([
            'user_id' => $user_id,
            'amount' => $amount,
            'paypal_payment_id' => $order_id
        ]);

        $user = User::find($user_id);

        $user->role = "premium";

        $user->save();


        if(Payment::where('user_id','=',$user_id)){
            return true;
        }else{
            return false;
        }



    }


}
