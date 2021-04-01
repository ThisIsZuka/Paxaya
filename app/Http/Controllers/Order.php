<?php

namespace App\Http\Controllers;
use Automattic\WooCommerce\Client;
use Illuminate\Http\Request;
use Automattic\WooCommerce\HttpClient\HttpClientException;


class Order extends Controller
{


    
    public function orders(){
        
        $woocommerce = new Client(
            'http://ecauat.xyz', 
            'ck_dcedb92fe596ac9f914ab6bab5dc13722ca47cff', 
            'cs_978fab72af3b43eeba7f409b4c2587f27c9335ce',
            [
                'version' => 'wc/v3',
            ]
        );


        $woocommerce->get('orders');

        dd($woocommerce);

    }
}
