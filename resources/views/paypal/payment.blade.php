@extends('layouts.app')

@section('page_title')
{{ __('Premium version') }}
@endsection

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center text-center">
        <div class="col-md-8 col-12 mt-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0 text-center">
                        {{ __('Premium benefits') }}
                    </h5>
                </div>
                <div class="card-body pt-2 pb-1">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-12">
                            <br>
                            <i class="fas fa-piggy-bank text-secondary fa-6x"></i>
                            <br>
                            <br>
                            <h3>{{ __('Select your payment method:') }}</h3>
                            <br>
                            <div id="paypal-button-container"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    var name = '{{ auth()->user()->name }}';
    var surname = '{{ auth()->user()->surname }}';
    var email = '{{ auth()->user()->email }}';

    // console.log(name+' '+surname+' '+email);

    // TIPOS DE PAGOS

    const FUNDING_SOURCES = [
        paypal.FUNDING.PAYPAL,
        paypal.FUNDING.CARD
    ];

    //REALIZA LA MISMA FUNCION POR CADA METODO ELEGIDO EN LA CONSTANTE DE ARRIBA

    FUNDING_SOURCES.forEach(function(fundingSource){
        // Inicializamos los botones
        const button = paypal.Buttons({
            fundingSource: fundingSource,
            createOrder: function(data, actions) {
                return actions.order.create({
                    application_context: {
                        shipping_preference: "NO_SHIPPING"
                    },
                    payer: {
                        email_address: email,
                        name: {
                            given_name: name,
                            surname: surname
                        }
                    },
                    purchase_units: [{
                        amount:{
                            value: '10'
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return fetch('/paypal/process/' + data.orderID +'?user_id='+{{ auth()->user()->id }})
                .then(function(res){
                    return res.json();
                }).then(function(response){
                    // Tres casos:
                    //  (1) Que se rechaze la tarjeta
                    //  (2) Que no haya nada de dinero en la tarjeta
                    //  (3) Que se complete la transacción
                    var errorDetail = Array.isArray(response.details) && response.details[0];

                    // if (errorDetail && errorDetail.issue == 'INSTRUMENT_DECLINED'){
                    //     return actions.restart();
                    // }

                    if (errorDetail){

                        var msg = 'Sorry, your transaction could not be processed.';
                        location.href = "{{ route('paypal.failed') }}";
                        // return alert(msg);
                        console.log(msg);

                    }
                    // console.log('data', data);
                    // console.log('actions', actions);
                    // console.log('response', response);
                    return actions.order.capture().then(function(details){
                        //APARTIR DE AQUI REDIRIGIR A PAGINA NUEVA
                        location.href = "{{ route('paypal.completed') }}";
                        alert('Transaction completed by ' + details.payer.name.given_name);
                    });

                });


            },
            onError: function (err) {
                location.href = "{{ route('paypal.failed') }}";
                console.log(err);
            }
        });

        // Se comprueba si el boton existe en el script
        if (button.isEligible()){
            button.render('#paypal-button-container')
        }

    });

</script>

@endsection
