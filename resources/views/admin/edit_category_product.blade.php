@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Update Category
            </header>
            <div class="panel-body">
                <div class="form-group"><!-- Message -->
                    <label class="col-sm-3 control-label"></label>
                    <div class="col-sm-6">
                        <span class="help-block">
                            <?php
                            $message = Session::get('message');
                            if ($message) {
                                echo '<span class="alert">' . $message . '</span>';
                                Session::put('message', null);
                            }
                            ?>
                        </span>
                    </div>
                </div>

                @foreach($edit_category_product as $key => $cat_edit)
                <form class="form-horizontal bucket-form" method="post" action="{{URL::to('/update-category-product/'.$cat_edit->category_id)}}">
                    {{ csrf_field() }}
                    <div class="form-group"><!-- Category Name -->
                        <label class="col-sm-3 control-label">Category Name</label>
                        <div class="col-sm-6">
                            <input type="text" name="category_product_name" value="{{ $cat_edit->category_name }}" placeholder="Enter category name..." class="form-control">
                        </div>
                    </div>

                    <div class="form-group"><!-- Category Parent -->
                        <label class="col-sm-3 control-label col-lg-3" for="inputSuccess">Category Parent</label>
                        <div class="col-lg-6">
                            <select name="category_product_parent" class="form-control m-bot15">
                                @foreach($parent_product as $key => $cat_parent)
                                    @if($cat_parent->parent_id == $cat_edit->parent_id)
                                        <option selected value="{{ $cat_parent->parent_id }}">{{ $cat_parent->parent_name }}</option>
                                    @else
                                        <option value="{{ $cat_parent->parent_id }}">{{ $cat_parent->parent_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="ccomment" placeholder="Enter category description..." class="control-label col-lg-3">Category Description</label>
                        <div class="col-lg-6">
                            <textarea class="form-control" name="category_product_description" style="resize: none;" rows="5" id="ccomment" required="">{{ $cat_edit->category_description }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-6">
                            <button name="update_category_product" class="btn btn-save" type="submit"><i class="glyphicon glyphicon-plus"></i> Update</button>
                            <button name="cancel_category_product" class="btn btn-cancel" type="button"><i class="glyphicon glyphicon-remove"></i> Cancel</button>
                        </div>
                    </div>
                </form>
                @endforeach
            </div>
        </section>
    </div>
</div>
@endsection