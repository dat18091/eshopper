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
    public function add_category_product(){
        return view('admin.add_category_product');
    }

    public function list_category_product(){
        $list_category_product = DB::table('tbl_category_product')->get();
        $manager_category_product = view('admin.list_category_product')->with('list_category_product', $list_category_product);
        return view('admin_layout')->with('admin.list_category_product', $manager_category_product);
    }

    public function save_category_product(Request $request){
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
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update(['category_status'=>1]);
        Session::put('message', 'Hide this category is successfully.');
        return Redirect::to('list-category-product');
    }

    public function active_category_product($category_product_id){
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update(['category_status'=>0]);
        Session::put('message', 'Show this category is successfully.');
        return Redirect::to('list-category-product');
    }

    public function update_category_product(Request $request, $category_product_id){
        $data = array();

        $data['category_name'] = $request->category_product_name;
        $data['parent_id'] = $request->category_product_parent;
        $data['category_description'] = $request->category_product_description;

        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update($data);
        Session::put('message', 'Update this category product is successfully.');
        return Redirect::to('list-category-product');
    }

    public function edit_category_product($category_product_id){
        $edit_category_product = DB::table('tbl_category_product')->where('category_id', $category_product_id)->get();
        $manager_category_product = view('admin.edit_category_product')->with('edit_category_product', $edit_category_product);
        return view('admin_layout')->with('admin.edit_category_product', $manager_category_product);
    }

    public function delete_category_product($category_product_id){
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->delete();
        Session::put('message', 'Delete this category product is successfully.');
        return Redirect::to('list-category-product');
    }
}
