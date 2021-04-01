<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Automattic\WooCommerce\Client;
use Illuminate\Http\Request;
use Automattic\WooCommerce\HttpClient\HttpClientException;
use Session;
use Closure;
use Log;

use DB;

class updateorder extends Controller
{


    
    public function updateorder($id){
        
        $woocommerce = new Client(
            'http://ecauat.xyz', 
            'ck_dcedb92fe596ac9f914ab6bab5dc13722ca47cff', 
            'cs_978fab72af3b43eeba7f409b4c2587f27c9335ce',
            [
                'version' => 'wc/v3',
            ]
        );

        
        
            $request->test;

            session::put('test2', $request->test);

            session::put('test',$id);

      
        return ($id);
            
        // $woocommerce->get('orders');

        // dd($woocommerce);

        // $test=Request()->all();
        
        // Session::put('store', $test);
        
        // $data = Session::all();

        // $value = $request->session()->get('test', 'test');
        
        
          

    

        // return view('welcome')->with($data);


    }


    public function test(Request $request){




        return dump(session('data'));

        // echo session('customer');
      
    }


    // public function testorder(Request $request){


    //     Session::put(['testorder',$request->all()]);


    //     echo $request->all();

    // }


    public function webhooks(Request $request){


        // dump($id);

        $data=[
            'customer_id'=>$request->input('id'),
            'order_id'=>$request->input('order_id')
        ];

        DB::table('tr_customer')->insert($data);
        

        // session::put('customer_id',$customer_id);

        // session::put('data',$request->input('id'));

        // return session('data');


        
        

        

    }


    public function test2(Request $request,$id){

        echo "1234";
        dump($id);

        return $id;

        // dd($request->input('customer'));

        // echo   $request->input('customer');


        // $woocommerce = new Client(
        //     'http://ecauat.xyz', 
        //     'ck_dcedb92fe596ac9f914ab6bab5dc13722ca47cff', 
        //     'cs_978fab72af3b43eeba7f409b4c2587f27c9335ce',
        //     [
        //         'version' => 'wc/v3',
        //     ]
        // );

        // $lastRequest = $woocommerce->get('customers')->getRequest();
      
        
      
        // $order=  $woocommerce->get('customers');

        // dd($lastRequest->getBody());

        // foreach($result['orders'] as $data){



        // }

        

        //  session::put('customer_id',$request->input('customer'));


        // return response()->json($request->input('customer'));

        

        // session::put('customer_id',$request->input('customer_id'));

        // echo  $request->input('customer_id');


    }
}
