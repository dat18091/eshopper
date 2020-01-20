@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Add Parent Category
            </header>
            <div class="panel-body">
                <form class="form-horizontal bucket-form" method="post" action="{{URL::to('/save-parent-category')}}">
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

                    <div class="form-group"><!-- Add Parent Category -->
                        <label class="col-sm-3 control-label">Parent Category Name</label>
                        <div class="col-sm-6">
                            <input type="text" name="parent_category_name" placeholder="Enter parent category name..." class="form-control">
                        </div>
                    </div>

                    <div class="form-group "><!-- Add Parent Description -->
                        <label for="ccomment" placeholder="Enter parent catgory description..." class="control-label col-lg-3">Parent Category Description</label>
                        <div class="col-lg-6">
                            <textarea class="form-control" name="parent_category_description" style="resize: none;" rows="5" id="ccomment" required=""></textarea>
                        </div>
                    </div>

                    <div class="form-group"><!-- Add Parent Status -->
                        <label class="col-sm-3 control-label col-lg-3" for="inputSuccess">Parent Category Status</label>
                        <div class="col-lg-6">

                            <select name="parent_category_status" class="form-control m-bot15">
                                <option value="0">Hide</option>
                                <option value="1">Show</option>
                            </select>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-6">
                            <button name="add_parent_category" class="btn btn-save" type="submit"><i class="glyphicon glyphicon-plus"></i> Save</button>
                            <button name="cancel_parent_category" class="btn btn-cancel" type="button"><i class="glyphicon glyphicon-remove"></i> Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
@endsection