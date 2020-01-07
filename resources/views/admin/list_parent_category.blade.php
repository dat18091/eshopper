@extends('admin_layout')
@section('admin_content')
<div class="panel panel-default">
    <div class="panel-heading">
        List Parent Category
    </div>
    <div class="row w3-res-tb">
        <div class="col-sm-5 m-b-xs">
            <select class="input-sm form-control w-sm inline v-middle">
                <option value="0">Bulk action</option>
                <option value="1">Delete selected</option>
                <option value="2">Bulk edit</option>
                <option value="3">Export</option>
            </select>
            <button class="btn btn-sm btn-default">Apply</button>
        </div>
        <div class="col-sm-4">
        </div>
        <div class="col-sm-3">
            <div class="input-group">
                <input type="text" class="input-sm form-control" placeholder="Search">
                <span class="input-group-btn">
                    <button class="btn btn-sm btn-default" type="button">Go!</button>
                </span>
            </div>
        </div>
    </div>
    <?php
    $message = Session::get('message');
    if ($message) {
        echo '<span class="alert">' . $message . '</span>';
        Session::put('message', null);
    }
    ?>
    <div class="table-responsive">
        <table class="table table-striped b-t b-light">
            <thead>
                <tr>
                    <th style="width:20px;">
                        <label class="i-checks m-b-none">
                            <input type="checkbox"><i></i>
                        </label>
                    </th>
                    <th>Name</th>
                    <th>Parent</th>
                    <th>Description</th>
                    <th style="width:30px;"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($list_parent_category as $key => $parent)
                <tr>
                    <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                    <td>{{ $parent->parent_name }}</td>
                    <td>{{ $parent->parent_description }}</td>
                    <td>
                        <span class="text-ellipsis">
                            <?php
                            if ($parent->parent_status == 0) {
                            ?>
                                <a href="{{URL::to('/unactive-parent-category/'.$parent->parent_id)}}"><span class="fa-styling fa fa-thumbs-up"></span></a>;
                            <?php
                            } else {
                            ?>
                                <a href="{{URL::to('/active-parent-category/'.$parent->parent_id)}}"><span class="fa-styling fa fa-thumbs-down"></span></a>;
                            <?php
                            }
                            ?>
                        </span>
                    </td>
                    <td>
                        <a href="{{URL::to('/edit-parent-category/'.$parent->parent_id)}}" class="active" ui-toggle-class="">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="{{URL::to('/delete-parent-category/'.$parent->parent_id)}}" onclick="return confirm('Are you sure want delete this parent category?')" class="active" ui-toggle-class="">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <footer class="panel-footer">
        <div class="row">

            <div class="col-sm-5 text-center">
                <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
            </div>
            <div class="col-sm-7 text-right text-center-xs">
                <ul class="pagination pagination-sm m-t-none m-b-none">
                    <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
                    <li><a href="">1</a></li>
                    <li><a href="">2</a></li>
                    <li><a href="">3</a></li>
                    <li><a href="">4</a></li>
                    <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
                </ul>
            </div>
        </div>
    </footer>
</div>
@endsection