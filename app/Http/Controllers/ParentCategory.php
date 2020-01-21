<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
use App\Http\Requests;
session_start();

class ParentCategory extends Controller
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

    public function add_parent_category(){
        $this->checkLogin();
        return view('admin.add_parent_category');
    }

    public function list_parent_category(){
        $this->checkLogin();
        $list_parent_category = DB::table('tbl_parent_category')->get();
        $manager_parent_category = view('admin.list_parent_category')->with('list_parent_category', $list_parent_category);
        return view('admin_layout')->with('admin.list_parent_category', $manager_parent_category);
    }

    public function save_parent_category(Request $request){
        $this->checkLogin();
        $data = array();

        $data['parent_name'] = $request->parent_category_name;
        $data['parent_description'] = $request->parent_category_description;
        $data['parent_status'] = $request->parent_category_status;

        DB::table('tbl_parent_category')->insert($data);
        Session::put('message', 'Add this parent category is successfully.');
        return Redirect::to('add-parent-category');
    }

    public function unactive_parent_category($parent_category_id){
        $this->checkLogin();
        DB::table('tbl_parent_category')->where('parent_id', $parent_category_id)->update(['parent_status' => 1]);
        Session::put('message', 'Hide this parent category is successfully.');
        return Redirect::to('list-parent-category');
    }

    public function active_parent_category($parent_category_id){
        $this->checkLogin();
        DB::table('tbl_parent_category')->where('parent_id', $parent_category_id)->update(['parent_status' => 0]);
        Session::put('message', 'Show this parent category is successfully.');
        return Redirect::to('list-parent-category');
    }

    public function update_parent_category(Request $request, $parent_category_id){
        $this->checkLogin();
        $data = array();

        $data['parent_name'] = $request->parent_category_name;
        $data['parent_description'] = $request->parent_category_description;

        DB::table('tbl_parent_category')->where('parent_id', $parent_category_id)->update($data);
        Session::put('message', 'Update this parent category is successfully.');
        return Redirect::to('list-parent-category');
    }

    public function edit_parent_category($parent_category_id){
        $this->checkLogin();
        $edit_parent_category = DB::table('tbl_parent_category')->where('parent_id', $parent_category_id)->get();
        $manager_parent_category = view('admin.edit_parent_category')->with('edit_parent_category', $edit_parent_category);
        return view('admin_layout')->with('admin.edit_parent_category', $manager_parent_category);
    }

    public function delete_parent_category($parent_category_id){
        $this->checkLogin();
        DB::table('tbl_parent_category')->where('parent_id', $parent_category_id)->delete();
        Session::put('message', 'Delete this parent category is successfully.');
        return Redirect::to('list-parent-category');
    }
}
