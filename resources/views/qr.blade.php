@extends('layouts.app')

@section('content')
<script type="text/javascript">
    
                
// Check whether the login has been confirmed 
function is_loginfun(){
      var key = $('#key').val();
      console.log("is_login called");
    $.ajax({
        type: "POST" ,
        dataType: "json" ,
        url: "web/login/entry/login" ,
        data:{
            key:key ,
              "_token":"{{ csrf_token() }}"
        },
          
            headers: {'x-csrf-token': '{{ csrf_token() }}'}, 
        success:function(data) {
              if (data.status==1 ){
                  var uid = data.jwt;
                  var user = data.user;
                  console.log("user",user);
                //  var sign = data.sign;
                  // Cancel timed tasks and clear cookies  
                clearInterval($('#is_login' ).val ());
                $( '#is_login').val('' );
                  // Hide the successful scanning code  
               // $('.barcode-container.scanned .status.scanned, .barcode-container.scanned .mask' ).hide();
                  //  
               // Confirmed pop-up $('.confirmed,.mask' ).show();
                  // Confirm login at a time of 1 second  
               
                console.log("login successfull",uid);
                $('.qrcode-img').attr('src','');
                alert("login successfull",uid);
                  $('#thelogindata').text(uid)
                  window.location.href = '/';
            } else  if (data.status==2 ){
                  // Cancel timed tasks and clear cookies  
                clearInterval($('#is_login').val());
                $('#is_login').val('' );
                alert(data.msg);
            }
        }
    });
}
    // Check whether the code has been scanned 
function is_sacn_qrcode(){
    var key = $('#key').val();
    console.log("is_sacn_qrcode called");
    //return;
    $.ajax({
        type: "POST" ,
        dataType: "json" ,
        url: "api/login/scan/qrcode" ,
        data:{
            key:key
        },
        success: function(data){
              if(data.status==1){
                  // Scan code successfully  
                // $('.barcode-container.scanned .status.scanned, .barcode-container.scanned .mask' ).show() ; 
                  // Cancel timing tasks and clear cookies  
                clearInterval($('#timing').val());
                $( '#timing').val('');
                  // // close the pop-up window at a timing of 2 seconds 
                // setTimeout(function(){ 
                //     $('.qrcode').hide( ); 
                // }, 2000);
                // Check whether the login has been confirmed 
            
            var is_login = setInterval(function() {
      is_loginfun();
   },3000);
                $('#is_login').val(is_login);
                  // $.cookie('is_login', is_login); 
            } else if(data.status==2 ){
                $('.timeout,.mask').show();
                  // Cancel timing tasks and clear cookies  
                clearInterval($('#timing').val());
                $('#timing').val('');
            }
        }
    });
}
        $(document).ready(function() {
        
    $('.scanqrcode').click(function(){
        // Request QR code 
        $.ajax({
            type: "POST" ,
            dataType: "json" ,
            url: "api/login/create/qrcode" , 
            headers: {'x-csrf-token': '{{ csrf_token() }}'},
            success:function(data){
                   if(data.status == 1) {
                       var qrcodeimg=data.msg;
                       // of Put in hidden The Key Domain   
                    $('#key').val(data.key);
                    console.log("key",data.key);
                       // Replace the QR code   
                    $('.qrcode-img').attr('src',qrcodeimg);
                       //Trigger timed task, check whether it has been Scan code 
                    var inter = setInterval(function() {
      is_sacn_qrcode();
   },3000);
                    $('#timing').val(inter);
                }
            }
        });
    });
        
    
        });    
        
$("#my_form").submit(function(event){
	event.preventDefault(); //prevent default action 
	var zipnumber = $("[name='zip']");
	// alert(zip); exit;
	$.ajax({
							 
							 url:"{{ route('ajax-check') }}",
					 
							 type:"GET",
							 data:{zip: zipnumber.val()},
							 dataType: 'json',
							 success: function (data) {
								 $('#card-button').prop('disabled', false);
								 $('#ziphelp').html('<p style="color:green">'+data.message+'  <a href="javascript:void(0)" onclick="openNavReg();"style="padding: 0;">Start Your Trial Now!</a></p>');
							 },
							 error:function(xhr, status, error){ 
								 if(xhr.status==404) {
									 // alert('status:' + xhr.status + ', status text: ' + xhr.responseText);
									 $('#card-button').prop('disabled', true);
								 $('#ziphelp').html('<p style="color:red">'+xhr.responseJSON.message+' Our apologies, your location is outside of the streamly service area. Please call 1111111111 for more information.</p>');
												 
						 
							 }
									// coupon was invalid, clear input so it doesn't get posted if user doesn't input a new valid coupon
							 }
					 });
	
});
</script>
	<style>
		nav#mainNav {
			background-color: #004E92;
		}
		body{
			background: #F9F9F9 0% 0% no-repeat padding-box;
		}
		
		.page-section {
		    padding: 8rem 0;
		}
		ul.setting-card {
		    margin: 0 auto;
		    list-style: none;
		    box-shadow: 0px 3px 6px #00000029;
    		padding: 0;
		}
		ul.setting-card li:first-child {
			font-weight: bold;
			background: #004E92 0% 0% no-repeat padding-box;
			padding: 12px 34px;
			letter-spacing: 0.24px;
			color: #FFFFFF;
			border-top-right-radius: 6px;
    		border-top-left-radius: 6px;
		}
		ul.setting-card {
		    margin: 0 auto;
		    color: #5E5E5E;
		}	
		.col-centered {
		    margin: 0 auto;
		    position: relative;
		}
		ul.setting-card li:not(:first-child) {
		    padding: 12px 34px;
		    letter-spacing: 0.24px;
		}	
		.light-brown{
			color: #989898;
		}
		.account-save-btn {
			background: #C4C4C4 0% 0% no-repeat padding-box;
			border-radius: 6px;
		}
		.account-cancel-btn {
			border: 1px solid #707070;
			border-radius: 6px;
		}
		.cancel-subscription {
			display: block;
    		text-align: right;
    		color: #CF0000;
		}
		i.fa.fa-trash {
		    cursor: pointer;
		}
		i.fa.fa-edit {
			cursor: pointer;
		}
		.modal-dialog {
			min-height: calc(100vh - 60px);
		    display: flex;
		    flex-direction: column;
		    justify-content: center;
		    overflow: auto;
		}
		.modal-body {
		    position: relative;
		    flex: 1 1 auto;
		    padding: 3rem 5rem;
		}
		.modal-body p{
			letter-spacing: 0.24px;
			color: #5E5E5E;
		}
	</style>





@if(session()->has('message'))
 <div class="alert alert-success alert-dismissible ">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		{{ session()->get('message') }}
</div>
@endif

    
    <section class="page-section">
		<div class="container">
				<h2 class="section-heading text-center">QR code</h2>
				<div class="row setting-cards">
					<div class="col-centered col-md-8">
						<ul class="setting-card">
							
						<li class="text-center"><button class="scanqrcode">Login with QR</button></li>
					<li class="text-center">
                    
            <p id="thelogindata"></p>
              <img class="qrcode-img" src="" />
              <input type="hidden" id="key">
             <input type="hidden" id="timing" value="timing">
             <input type="hidden" id="is_login" value="is_login "></li>			
                                </ul>
							
					</div>
				</div>
				

				@if ($errors->any())
				<div class="alert alert-danger">
						<ul>
								@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
								@endforeach
						</ul>
				</div>
		@endif

		</div>
		
	</section><section class="page-section">
	
		
	</section>
	
@endsection
	
	