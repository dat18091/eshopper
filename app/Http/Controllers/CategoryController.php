<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
use App\Http\Requests;
session_start();

class CategoryController extends Controller
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

    public function add_category_product(){
        $this->checkLogin();
        $parent = DB::table('tbl_parent_category')->orderby('parent_id', 'desc')->get();
        return view('admin.add_category_product')->with('category_product_parent', $parent);
        //return view('admin.add_category_product');
    }

    public function list_category_product(){        
        $this->checkLogin();
        $list_category_product = DB::table('tbl_category_product')
        ->join('tbl_parent_category','tbl_parent_category.parent_id','=','tbl_category_product.parent_id')->get();
        $manager_category_product = view('admin.list_category_product')->with('list_category_product', $list_category_product);
        return view('admin_layout')->with('admin.list_category_product', $manager_category_product);
    }

    public function save_category_product(Request $request){
        $this->checkLogin();
        $data = array();

        $data['category_name'] = $request->category_product_name;
        $data['parent_id'] = $request->category_product_parent;
        $data['category_description'] = $request->category_product_description;
        $data['category_status'] = $request->category_product_status;

        DB::table('tbl_category_product')->insert($data);
        Session::put('message', 'Add this category product is successfully.');
        return Redirect::to('add-category-product');
    }

    public function unactive_category_product($category_product_id){
        $this->checkLogin();
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update(['category_status'=>1]);
        Session::put('message', 'Hide this category is successfully.');
        return Redirect::to('list-category-product');
    }

    public function active_category_product($category_product_id){
        $this->checkLogin();
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update(['category_status'=>0]);
        Session::put('message', 'Show this category is successfully.');
        return Redirect::to('list-category-product');
    }

    public function update_category_product(Request $request, $category_product_id){
        $this->checkLogin();
        $data = array();

        $data['category_name'] = $request->category_product_name;
        $data['parent_id'] = $request->category_product_parent;
        $data['category_description'] = $request->category_product_description;

        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update($data);
        Session::put('message', 'Update this category product is successfully.');
        return Redirect::to('list-category-product');
    }

    public function edit_category_product($category_product_id){
        $this->checkLogin();
        $parent_product = DB::table('tbl_parent_category')->orderby('parent_id', 'desc')->get();
        $edit_category_product = DB::table('tbl_category_product')->where('category_id', $category_product_id)->get();
        $manager_category_product = view('admin.edit_category_product')->with('edit_category_product', $edit_category_product)
        ->with('parent_product', $parent_product);
        return view('admin_layout')->with('admin.edit_category_product', $manager_category_product);
    }

    public function delete_category_product($category_product_id){
        $this->checkLogin();
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->delete();
        Session::put('message', 'Delete this category product is successfully.');
        return Redirect::to('list-category-product');
    }

    #End Function Admin Page
    public function show_category_home($category_id){
        $cat_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderby('brand_id', 'desc')->get();

        $category_by_id = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('tbl_product.category_id',$category_id)->get();

        $cat_by_name = DB::table('tbl_category_product')->where('tbl_category_product.category_id',$category_id)->limit(1)->get();


        return view('pages.category.show_category')->with('category',$cat_product)->with('brand',$brand_product)
        ->with('category_by_id',$category_by_id)->with('cat_by_name',$cat_by_name);
    }
}
