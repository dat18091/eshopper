<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
use App\Http\Requests;
session_start();

class BrandController extends Controller
{
    //
    public function add_brand_product(){
        return view('admin.add_brand_product');
    }

    public function list_brand_product(){
        $list_brand_product = DB::table('tbl_brand_product')->get();
        $manager_brand_product = view('admin.list_brand_product')->with('list_brand_product', $list_brand_product);
        return view('admin_layout')->with('admin.list_brand_product', $manager_brand_product);
    }

    public function save_brand_product(Request $request){
        $data = array();

        $data['brand_name'] = $request->brand_product_name;
        $data['brand_description'] = $request->brand_product_description;
        $data['brand_status'] = $request->brand_product_status;

        DB::table('tbl_brand_product')->insert($data);
        Session::put('message', 'Add this brand product is successfully.');
        return Redirect::to('add-brand-product');
    }

    public function unactive_brand_product($brand_product_id){
        DB::table('tbl_brand_product')->where('brand_id', $brand_product_id)->update(['brand_status' => 1]);
        Session::put('message', 'Hide this brand is successfully.');
        return Redirect::to('list-brand-product');
    }

    public function active_brand_product($brand_product_id){
        DB::table('tbl_brand_product')->where('brand_id', $brand_product_id)->update(['brand_status' => 0]);
        Session::put('message', 'Show this brand is successfully.');
        return Redirect::to('list-brand-product');
    }

    public function update_brand_product(Request $request, $brand_product_id){
        $data = array();

        $data['brand_name'] = $request->brand_product_name;
        $data['brand_description'] = $request->brand_product_description;

        DB::table('tbl_brand_product')->where('brand_id', $brand_product_id)->update($data);
        Session::put('message', 'Update this brand product is successfully.');
        return Redirect::to('list-brand-product');        
    }

    public function edit_brand_product($brand_product_id){
        $edit_brand_product = DB::table('tbl_brand_product')->where('brand_id', $brand_product_id)->get();
        $manager_brand_product = view('admin.edit_brand_product')->with('edit_brand_product', $edit_brand_product);
        return view('admin_layout')->with('admin.edit_brand_product', $manager_brand_product);
    }

    public function delete_brand_product($brand_product_id){
        DB::table('tbl_brand_product')->where('brand_id', $brand_product_id)->delete();
        Session::put('message', 'Delete this brand is successfully.');
        return Redirect::to('list-brand-product');
    }
}
