<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
use App\Http\Requests;
session_start();

class CheckoutController extends Controller
{
    //
    public function login_checkout() {
        $cat_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderby('brand_id', 'desc')->get();
       
        return view('pages.checkout.login_checkout');
    }

    public function add_customer(Request $request) {
        $data = array();

        $data['customer_name'] = $request->customer_name;
        $data['customer_gender'] = $request->customer_gender;
        $data['customer_age'] = $request->customer_age;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = $request->customer_password;
        $data['customer_address'] = $request->customer_address;
        $data['customer_phone'] = $request->customer_phone;

        $customer_id = DB::table('tbl_customer')->insertGetId($data);

        Session::put('customer_id', $customer_id);
        Session::put('customer_name', $request->customer_name);

        return Redirect('/checkout');
    }

    public function checkout(){

    }
}
