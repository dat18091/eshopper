@extends('admin_layout')
@section('admin_content')
<div class="panel panel-default">
    <div class="panel-heading">
        List Brand
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
                    <th>Description</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Quantity</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th style="width:30px;"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($list_product as $key => $product)
                <tr>
                    <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->product_description }}</td>
                    <td>{{ $product->product_price }}</td>
                    <td>{{ $product->category_name }}</td>
                    <td>{{ $product->brand_name }}</td>
                    <td>{{ $product->product_quantity }}</td>
                    <td><img src="public/uploads/product/{{ $product->product_image }}" width="50" height="50"></td>
                    <td>
                        <span class="text-ellipsis">
                            <?php
                            if ($product->product_status == 0) {
                            ?>
                                <a href="{{URL::to('/unactive-product/'.$product->product_id)}}"><span class="fa-styling fa fa-thumbs-up"></span></a>;
                            <?php
                            } else {
                            ?>
                                <a href="{{URL::to('/active-product/'.$product->product_id)}}"><span class="fa-styling fa fa-thumbs-down"></span></a>;
                            <?php
                            }
                            ?>
                        </span>
                    </td>
                    <td>
                        <a href="{{URL::to('/edit-product/'.$product->product_id)}}" class="active" ui-toggle-class="">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="{{URL::to('/delete-product/'.$product->product_id)}}" onclick="return confirm('Are you sure want delete this product?')" class="active" ui-toggle-class="">
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