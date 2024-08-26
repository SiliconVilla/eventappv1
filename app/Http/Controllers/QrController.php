<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Memcache;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class QrController extends Controller
{
    //
    // QR code should be only avilable for non logged in user
    public function qr()
    {

        if (Auth::check())
        {

            return "you are already logged in, open it in incognito mode";

        }
        else
        {

            return view('qr');
        }
    }

    //QR scanner only avilable for logged in user
    public function qrscanner()
    {
        if (Auth::check())
        {
            $login = true;

            return view('frontend.drm.qrscanner', compact('login'));
        }
        return redirect()->route('home');
    }

    public function CreateQrcodeAction()
    {

        $url = 'http://' . $_SERVER['HTTP_HOST']; // Get the current url
        // dd($url);
        $http = $url . '/api/login/mobile/scan/qrcode'; // Verify the url method of scanning code
        $key = Str::random(30); //$this->getRandom(30); // The key value stored in memcache, a random 32-bit string
        $random = mt_rand(1000000000, 9999999999); //random integer
        $_SESSION['qrcode_name'] = $key; // Save the key as the name of the picture in the session
        $forhash = substr($random, 0, 2);
        $sgin_data = HashUserID($forhash); // The basic algorithm for generating the sign string
        $sgin = strrev(substr($key, 0, 2)) . $sgin_data; // Intercept the first two digits and reverse them
        $value = $http . '?key=' . $key . '&type=1'; // Two-dimensional Code content
        $pngImage = QrCode::format('png')
        //  ->merge(public_path('frontend/img/streamly-logo.png'), 0.3, true)
        ->size(300)
            ->errorCorrection('H')
            ->generate($value, public_path('assets/img/qrcodeimg/' . $key . '.png'));

        $return = array(
            'status' => 0,
            'msg' => ''
        );

        $qr = public_path('assets/img/qrcodeimg/' . $key . '.png');

        if (!file_exists($qr))
        {
            $return = array(
                'status' => 0,
                'msg' => ''
            );
            return response()->json($return, 404);
            //   return "no found qr img";

        }
        $qr = asset('assets/img/qrcodeimg/' . $key . '.png');

        $mem = new \Memcache();
        $mem->connect('127.0.0.1', 11211);
        $res = json_encode(array(
            'sign' => $sgin,
            'type' => 0
        ));
        // store in memcache, expiration time is three minutes
        $mem->set($key, $res, 0, 180); // 180
        $return = array(
            'status' => 1,
            'msg' => $qr,
            'key' => $key
        );
        return response()->json($return, 200);

    }

    // Mobile device scan code
    public function mobileScanQrcodeAction(Request $request)
    {
        $key = $_GET['key'];
        $url = 'http://' . $_SERVER['HTTP_HOST'];
        $agent = $_SERVER["HTTP_USER_AGENT"];
        $headerpasscode = $request->header('userpasscode');

        $http = $url . '/api/login/qrcodedoLogin'; // Return to confirm the login link
        $mem = new \Memcache();
        $mem->connect('127.0.0.1', 11211);
        $data = json_decode($mem->get($key) , true);

        if (empty($data))
        {
            $return = array(
                'status' => 2,
                'msg' => 'expired'
            );
            return response()->json($return, 200);
        }
        $data['type'] = 1; // Increase the type value to determine whether the code has been scanned
        $res = json_encode($data);
        $mem->set($key, $res, 0, 180);
        $http = $http . '?key=' . $key . '&type=scan&login=' . $headerpasscode . '&sign=' . $data['sign'];
        $return = array(
            'status' => 1,
            'msg' => $http
        );
        return response()->json($return, 200);
    }
    /* *
     * Log in after the client scans the code
     * $sign passes the identification when the client scans the code, and compares it with the memcache
     * $key is the key passed in the QR code on the web page
     * $uid The user id sent by scanning the code after the client logs in
     * @return void
    */
    public function qrcodeDoLoginAction(Request $request)
    {

        $login = $_GET['login']; //jwt or passcode
        $key = $_GET['key'];
        $sign = $_GET['sign'];
        $mem = new \Memcache();
        $mem->connect('127.0.0.1', 11211);
        $data = json_decode($mem->get($key) , true); // Remove the value of memcache
        if (empty($data))
        {
            $return = array(
                'status' => 2,
                'msg' => 'expired'
            );
            return response()->json($return, 200);
        }
        else
        {
            if (!isset($data['sign']))
            {
                $return = array(
                    'status' => 0,
                    'msg' => 'Sign notset'
                );
            }
            if ($data['sign'] != $sign)
            { // Verify delivery Sign
                $return = array(
                    'status' => 0,
                    'msg' => 'Verification Error'
                );
                //  return  $this ->createJsonResponse( $return );
                return response()->json($return, 403);
            }
            else
            {
                if ($login)
                { // Mobile phone scan code webpage login, save the user name in memcache
                    $data['jwt'] = $login;
                    $res = json_encode($data);
                    $mem->set($key, $res, 0, 180);
                    $return = array(
                        'status' => 1,
                        'msg' => 'Login successful'
                    );
                    //  return  $this ->createJsonResponse( $return );
                    return response()->json($return, 200);
                }
                else
                {
                    $return = array(
                        'status' => 0,
                        'msg' => 'Please pass the correct user information'
                    );
                    //  return  $this ->createJsonResponse( $return );
                    return response()->json($return, 401);
                }
            }
        }

    }

    /* *
     * Check whether the code has been scanned, this checked by polling,
     * it looks for the key, the filename,
    */
    public function isScanQrcodeAction(Request $request)
    {

        $key = $request['key'];
        $mem = new \Memcache();
        $mem->connect('127.0.0.1', 11211);
        $data = json_decode($mem->get($key) , true);
        if (empty($data))
        {
            $return = array(
                'status' => 2,
                'msg' => 'expired'
            );
        }
        else
        {
            if ($data['type'])
            {
                $return = array(
                    'status' => 1,
                    'msg' => 'success'
                );

            }
            else
            {
                $return = array(
                    'status' => 0,
                    'msg' => ''
                );
            }
        }
        return response()->json($return, 200);
        // return  $this->createJsonResponse( $return );

    }

    public function loginEntry(Request $request)
  {

     $key=$request['key'];
     if (empty($key)){

     $return = array ('status'=>2,'msg'=>'key not provided' );
     return response()->json($return, 200);
     }
    $mem = new \Memcache();
    $mem->connect('127.0.0.1',11211);
    $data = json_decode($mem->get($key),true); 
//     $passcode=$data['login'];
    if (empty($data)){
     $return = array ('status'=>2,'msg'=>'expired' );
     return response()->json($return, 200);
 } else {
     if (isset($data['jwt'])){
      $userid=UnHashUserID($data['jwt']);
      $user = Auth::loginUsingId($userid, true);


         $return = array ('status'=>1,'msg'=>'success','jwt'=>$data['jwt'],'user'=>$user );
         return response()->json($return, 200);
    } else {
         $return = array ('status'=>0,'msg'=>'','data'=>$data );
         return response()->json($return, 400);
    }

    
  }
}

/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
    
        return $this->sendResponse(ProductResource::collection($products), 'Products retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $product = Product::create($input);
   
        return $this->sendResponse(new ProductResource($product), 'Product created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
  
        if (is_null($product)) {
            return $this->sendError('Product not found.');
        }
   
        return $this->sendResponse(new ProductResource($product), 'Product retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $product->name = $input['name'];
        $product->detail = $input['detail'];
        $product->save();
   
        return $this->sendResponse(new ProductResource($product), 'Product updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
   
        return $this->sendResponse([], 'Product deleted successfully.');
    }

}


