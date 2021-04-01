<?php

namespace App\Http\Controllers;

use Automattic\WooCommerce\Client;
use Automattic\WooCommerce\HttpClient\HttpClientException;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Exception;
// use DB;
use Carbon\Carbon;

class member extends Controller
{
    public function customer()
    {

        $woocommerce = new Client(
            'http://ecauat.xyz',
            'ck_dcedb92fe596ac9f914ab6bab5dc13722ca47cff',
            'cs_978fab72af3b43eeba7f409b4c2587f27c9335ce',
            [
                'version' => 'wc/v3',
            ]
        );
        dd($woocommerce->get('customers'));
    }

    public function customer_add(Request $request)
    {
        $data = $request->all();
        // var_dump($data['customer_id']);
        try {

            $mytime = Carbon::now();
            // $time = $mytime->toDateString();
            $Year = $mytime->year;
            $Year = substr($Year, 2, 2);
            $month = $mytime->month;
            if ($month <= 9) {
                $month = '0' . $month;
            }

            $GetDate = DB::select('select substr(max(member_nbr),3,4) as member_nbr from `tr_customer`');
            if ($GetDate[0]->member_nbr != '' || $GetDate[0]->member_nbr != null) {
                $Date_DB =  $GetDate[0]->member_nbr;
                $DBMonth = substr($Date_DB, 2, 2);
                $DBYear = substr($Date_DB, 0, 2);
                if ($Year != $DBYear) {
                        $new_id = '55' . $Year . $month . '0001';
                }else{
                    if ($month != $DBMonth) {
                        $new_id = '55' . $Year . $month . '0001';
                    } else {
                        $new =  DB::select('SELECT SUBSTR(max(member_nbr)+1,7,4) as new_gen FROM `tr_customer`');
                        $new_id =  '55' . $DBYear . $DBMonth . $new[0]->new_gen;
                    }
                }
            }else{
                $new_id = '55' . $Year . $month . '0001';
            }

            // return $new_id;
            DB::table('tr_customer')->insert([
                'member_nbr' => $new_id,
                'id' => $data['customer_id'],
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                't_first_name' => $data['first_name'],
                't_last_name' => $data['last_name'],
                'email' => $data['email'],
                'member_date' => $data['member_date'],
                'in_date' => $data['in_date'],
            ]);
        } catch (Exception $e) {
            return response()->json(array('message' => $e->getMessage()));
        }
    }

    public function customer_update(Request $request)
    {
        $data = $request->all();
        // var_dump($data);
        // var_dump($data['billing_address']['first_name']);
        try {
            DB::table('tr_customer')
                ->where('member_nbr', $data['customer_id'])
                ->update([
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    't_first_name' => $data['first_name'],
                    't_last_name' => $data['last_name'],
                    'email' => $data['email'],
                ]);

            $Address_B = DB::table('tr_member_address')
                ->where('member_nbr', '=', $data['customer_id'])
                ->where('addr_type', '=', 'B')
                ->count();
            // $street = $data['billing_address']['street'] ?? 'N/A';
            // var_dump($street);

            if ($data['billing_address'] != '') {
                if ($Address_B) {
                    DB::table('tr_member_address')
                        ->where('member_nbr', $data['customer_id'])
                        ->where('addr_type', 'B')
                        ->update([
                            'address1' => $data['billing_address']['address_1'] ?? null,
                            'address2' => $data['billing_address']['address_2'] ?? null,
                            'street' =>  $data['billing_address']['street'] ?? null,
                            'district' => $data['billing_address']['district'] ?? null,
                            'city' => $data['billing_address']['city'] ?? null,
                            'province' => $data['billing_address']['province'] ?? null,
                            'country' => $data['billing_address']['country'] ?? null,
                            'phone' => $data['billing_address']['phone'] ?? null,
                            'postal' => $data['billing_address']['postcode'] ?? null,
                        ]);
                } else {
                    DB::table('tr_member_address')->insert([
                        'member_nbr' => $data['customer_id'],
                        'addr_type' => 'B',
                        'address1' => $data['billing_address']['address_1'] ?? null,
                        'address2' => $data['billing_address']['address_2'] ?? null,
                        'street' => $data['billing_address']['street'] ?? null,
                        'district' => $data['billing_address']['district'] ?? null,
                        'city' => $data['billing_address']['city'] ?? null,
                        'province' => $data['billing_address']['province'] ?? null,
                        'country' => $data['billing_address']['country'] ?? null,
                        'phone' => $data['billing_address']['phone'] ?? null,
                        'postal' => $data['billing_address']['postcode'] ?? null,
                    ]);
                }
            }


            $Address_S = DB::table('tr_member_address')
                ->where('member_nbr', '=', $data['customer_id'])
                ->where('addr_type', '=', 'S')
                ->count();

            if ($data['shipping_address'] != '') {
                if ($Address_S) {
                    DB::table('tr_member_address')
                        ->where('member_nbr', $data['customer_id'])
                        ->where('addr_type', 'S')
                        ->update([
                            'address1' => $data['shipping_address']['address_1'] ?? null,
                            'address2' => $data['shipping_address']['address_2'] ?? null,
                            'street' => $data['shipping_address']['street'] ?? null,
                            'district' => $data['shipping_address']['district'] ?? null,
                            'city' => $data['shipping_address']['city'] ?? null,
                            'province' => $data['shipping_address']['province'] ?? null,
                            'country' => $data['shipping_address']['country'] ?? null,
                            'phone' => $data['shipping_address']['phone'] ?? null,
                            'postal' => $data['shipping_address']['postcode'] ?? null,
                        ]);
                } else {
                    DB::table('tr_member_address')->insert([
                        'member_nbr' => $data['customer_id'],
                        'addr_type' => 'S',
                        'address1' => $data['shipping_address']['address_1'] ?? null,
                        'address2' => $data['shipping_address']['address_2'] ?? null,
                        'street' => $data['shipping_address']['street'] ?? null,
                        'district' => $data['shipping_address']['district'] ?? null,
                        'city' => $data['shipping_address']['city'] ?? null,
                        'province' => $data['shipping_address']['province'] ?? null,
                        'country' => $data['shipping_address']['country'] ?? null,
                        'phone' => $data['shipping_address']['phone'] ?? null,
                        'postal' => $data['shipping_address']['postcode'] ?? null,
                    ]);
                }
            }
        } catch (Exception $e) {
            return response()->json(array('message' => $e->getMessage()));
        }
    }

    public function customer_delete(Request $request)
    {
        $data = $request->all();
        // var_dump($data['customer_id']);
        try {
            DB::table('tr_customer')
                ->where('member_nbr', $data['customer_id'])
                ->delete();

            DB::table('tr_member_address')
                ->where('member_nbr', $data['customer_id'])
                ->delete();
        } catch (Exception $e) {
            return response()->json(array('message' => $e->getMessage()));
        }
    }
}
