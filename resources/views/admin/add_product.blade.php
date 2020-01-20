@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Add Product
            </header>
            <div class="panel-body">
                <form class="form-horizontal bucket-form" method="post" action="{{URL::to('/save-product')}}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group"><!-- Message -->
                        <label class="col-sm-3 control-label"></label>
                        <div class="col-sm-6">
                            <span class="help-block">
                            <?php 
                                $message = Session::get('message');
                                if($message) {
                                    echo '<span class="alert">'.$message.'</span>';
                                    Session::put('message', null);
                                }
                            ?>
                            </span>
                        </div>
                    </div>

                    <div class="form-group"><!-- Product Name -->
                        <label class="col-sm-3 control-label">Product Name</label>
                        <div class="col-sm-6">
                            <input type="text" name="product_name" placeholder="Enter product name..." class="form-control">
                        </div>
                    </div>
                    
                    <div class="form-group "><!-- Product Description -->
                        <label for="ccomment" placeholder="Enter product description..." class="control-label col-lg-3">Product Description</label>
                        <div class="col-lg-6">
                            <textarea class="form-control" name="product_description" style="resize: none;" rows="5" id="ccomment" required=""></textarea>
                        </div>
                    </div>

                    <div class="form-group"><!-- Category Product -->
                        <label class="col-sm-3 control-label col-lg-3" for="inputSuccess">Category Product</label>
                        <div class="col-lg-6">
                            <select name="product_cat" class="form-control m-bot15">
                                @foreach($cat_product as $key => $cat)    
                                <option value="{{ $cat->category_id }}">{{ $cat->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group"><!-- Brand Product -->
                        <label class="col-sm-3 control-label col-lg-3" for="inputSuccess">Brand Product</label>
                        <div class="col-lg-6">
                            <select name="product_brand" class="form-control m-bot15">
                                @foreach($brand_product as $key => $brand)    
                                <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group"><!-- Product Quantity -->
                        <label class="col-sm-3 control-label">Product Quantity</label>
                        <div class="col-sm-6">
                            <input type="text" name="product_quantity" placeholder="Enter product quantity..." class="form-control">
                        </div>
                    </div>

                    <div class="form-group"><!-- Product Price -->
                        <label class="col-sm-3 control-label">Product Price</label>
                        <div class="col-sm-6">
                            <input type="text" name="product_price" placeholder="Enter product price..." class="form-control">
                        </div>
                    </div>

                    <div class="form-group"><!-- Product Image -->
                        <label class="col-sm-3 control-label">Product Image</label>
                        <div class="col-sm-6">
                            <input type="file" name="product_image" class="form-control">
                        </div>
                    </div>

                    <div class="form-group"><!-- Product Status -->
                        <label class="col-sm-3 control-label col-lg-3" for="inputSuccess">Product Status</label>
                        <div class="col-lg-6">

                            <select name="product_status" class="form-control m-bot15">
                                <option value="0">Hide</option>
                                <option value="1">Show</option>
                            </select>

                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-6">
                            <button name="add_product" class="btn btn-save" type="submit"><i class="glyphicon glyphicon-plus"></i> Save</button>
                            <button name="cancel_product" class="btn btn-cancel" type="button"><i class="glyphicon glyphicon-remove"></i> Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
@endsection