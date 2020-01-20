@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Add Brand
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

                @foreach($edit_brand_product as $key => $brand_edit)
                <form class="form-horizontal bucket-form" method="post" action="{{URL::to('/update-brand-product/'.$brand_edit->brand_id)}}">
                    {{ csrf_field() }}
                    <div class="form-group"><!-- Brand Name -->
                        <label class="col-sm-3 control-label">Brand Name</label>
                        <div class="col-sm-6">
                            <input type="text" name="brand_product_name" value="{{ $brand_edit->brand_name }}" class="form-control">
                        </div>
                    </div>

                    <div class="form-group "><!-- Brand Description -->
                        <label for="ccomment" class="control-label col-lg-3">Brand Description</label>
                        <div class="col-lg-6">
                            <textarea class="form-control" name="brand_product_description" style="resize: none;" rows="5" id="ccomment" required="">{{ $brand_edit->brand_description }}</textarea>
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