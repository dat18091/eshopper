<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
use App\Http\Requests;
session_start();

class HomeController extends Controller
{
    //
    public function index(){
        $cat_product = DB::table('tbl_category_product')->where('category_status','0')
        #->join('tbl_parent_category','tbl_parent_category.parent_id','=','tbl_category_product.parent_id')
        ->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderby('brand_id', 'desc')->get();
        
        $parent_product = DB::table('tbl_parent_category')->where('parent_status','0')->orderby('parent_id', 'desc')->get();
        $all_product = DB::table('tbl_product')->where('product_status','0')->orderby('product_id', 'desc')
        ->limit(6)->get();
        return view('pages.home')->with('category',$cat_product)->with('brand',$brand_product)
        ->with('parent', $parent_product)->with('all_product', $all_product);
    }
}
