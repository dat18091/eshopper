@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Add Category
            </header>
            <div class="panel-body">
                <form class="form-horizontal bucket-form" method="post" action="{{URL::to('/save-category-product')}}">
                    {{ csrf_field() }}
                    <div class="form-group">
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

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Category Name</label>
                        <div class="col-sm-6">
                            <input type="text" name="category_product_name" placeholder="Enter category name..." class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label col-lg-3" for="inputSuccess">Category Parent</label>
                        <div class="col-lg-6">

                            <select name="category_product_parent" class="form-control m-bot15">
                                <option value="1">Electronic Devices</option>
                                <option value="2">Home & Lifestyle</option>
                            </select>

                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="ccomment" placeholder="Enter category description..." class="control-label col-lg-3">Category Description</label>
                        <div class="col-lg-6">
                            <textarea class="form-control" name="category_product_description" style="resize: none;" rows="5" id="ccomment" required=""></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label col-lg-3" for="inputSuccess">Category Status</label>
                        <div class="col-lg-6">

                            <select name="category_product_status" class="form-control m-bot15">
                                <option value="0">Hide</option>
                                <option value="1">Show</option>
                            </select>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-6">
                            <button name="add_category_product" class="btn btn-save" type="submit"><i class="glyphicon glyphicon-plus"></i> Save</button>
                            <button name="cancel_category_product" class="btn btn-cancel" type="button"><i class="glyphicon glyphicon-remove"></i> Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
@endsection