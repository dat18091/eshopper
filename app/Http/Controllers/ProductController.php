<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
use App\Http\Requests;
session_start();

class ProductController extends Controller
{
    //
    public function checkLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }

    public function add_product(){
        $this->checkLogin();
        $cat_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->orderby('brand_id', 'desc')->get();
        return view('admin.add_product')->with('cat_product', $cat_product)->with('brand_product', $brand_product);
    }

    public function list_product(){
        $this->checkLogin();
        $list_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->orderby('tbl_product.product_id','desc')->get();
        $manager_product = view('admin.list_product')->with('list_product', $list_product);
        return view('admin_layout')->with('admin.list_product', $manager_product);
    }

    public function save_product(Request $request){
        $this->checkLogin();
        $data = array();

        $data['product_name'] = $request->product_name;
        $data['product_description'] = $request->product_description;
        $data['product_price'] = $request->product_price;
        $data['category_id'] = $request->product_cat;
        $data['brand_id'] = $request->product_brand;
        $data['product_quantity'] = $request->product_quantity;
        #$data['product_image'] = $request->product_image;
        $data['product_status'] = $request->product_status;

        $get_image = $request->file('product_image');
        if($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->insert($data);
            Session::put('message', 'Add this product is successfully.');
            return Redirect::to('add-product');
        }
        $data['product_image'] = '';
        DB::table('tbl_product')->insert($data);
        Session::put('message', 'Add this product is successfully.');
        return Redirect::to('add-product');
    }

    public function unactive_product($product_id){
        $this->checkLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 1]);
        Session::put('message', 'Hide this product is successfully.');
        return Redirect::to('list-product');
    }

    public function active_product($product_id){
        $this->checkLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 0]);
        Session::put('message', 'Show this product is successfully.');
        return Redirect::to('list-product');
    }

    public function update_product(Request $request, $product_id){
        $this->checkLogin();
        $data = array();

        $data['product_name'] = $request->product_name;
        $data['product_description'] = $request->product_description;
        $data['product_price'] = $request->product_price;
        $data['category_id'] = $request->product_cat;
        $data['brand_id'] = $request->product_brand;
        $data['product_quantity'] = $request->product_quantity;
        #$data['product_image'] = $request->product_image;
        #$data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');

        if($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            Session::put('message', 'Update this product is successfully.');
            return Redirect::to('list-product');
        }
        #$data['product_image'] = '';
        DB::table('tbl_product')->where('product_id', $product_id)->update($data);
        Session::put('message', 'Update this product is successfully.');
        return Redirect::to('list-product');        
    }

    public function edit_product($product_id){
        $this->checkLogin();
        $cat_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->orderby('brand_id', 'desc')->get();

        $edit_product = DB::table('tbl_product')->where('product_id', $product_id)->get();
        $manager_product = view('admin.edit_product')->with('edit_product', $edit_product)
        ->with('cat_product', $cat_product)->with('brand_product', $brand_product);
        return view('admin_layout')->with('admin.edit_product', $manager_product);
    }

    public function delete_product($product_id){
        $this->checkLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->delete();
        Session::put('message', 'Delete this product is successfully.');
        return Redirect::to('list-product');
    }

    #End Admin Page
    public function product_details($product_id){
        $cat_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderby('brand_id', 'desc')->get();

        $details_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.product_id', $product_id)->get();

        foreach($details_product as $key => $details){
            $brand_id = $details->brand_id;
        }

        $related_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->where('tbl_brand_product.brand_id', $brand_id)
        ->whereNotIn('tbl_product.product_id', [$product_id])->get();

        return view('pages.product.show_product_details')->with('category',$cat_product)->with('brand',$brand_product)
        ->with('product_details',$details_product)->with('related',$related_product);
    }
}
