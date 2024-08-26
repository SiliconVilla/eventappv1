@extends('layouts.app')

@section('content')

<br>

<div class="card col-md-8" style="margin-top: 100px;">
    <div class="card-header">{{ __('Listado de Actividades') }}</div>
        <div class="card-body">
            <div class="">
                <div class="fixed-top" style="margin-top: 50px; text-align: center; font-weight: bold; font-size: 20px; background-color: #0069d9; color: white; padding-top: 2%; padding-bottom: 2%; ">
                    

                   
                    Hola Jayder Apoyo Alimentario
        
  
                    
                </div>

                <div class="col-md-12" style="margin-top: 70px;">
                
                    <table id="tabla-listar-actividades" style="text-align: center;">
                        <thead></thead>
                        <tbody>
                            
                            
                            <div>
                                <a class="Pagar con Criptomoneda"
                                href="https://commerce.coinbase.com/checkout/0a512b31-afb4-47cc-bbba-0be412bcfbd3">
                                Buy with Crypto
                                </a>
                                <script src="https://commerce.coinbase.com/v1/checkout.js?version=201807">
                                </script>
                            </div>
  

                        </tbody>
                    </table>
                    

                </div>
            </div>
        </div>

</div>

<script>
    function msg(){
     
        var paymentAddress=document.getElementById("payment-address").value;
     
        // Dialog is javascript interface name
        // mentioned in Mainactivity.Java
        Dialog.showMsg(paymentAddress);
        }
     
     
 </script>


    
