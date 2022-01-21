@extends('master')
@section('body')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Thêm Chi Tiết Sản Phẩm
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-body">

                <div class="container">
                    <form action="{{ route('add-product-detail-post') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="product_id">Sản Phẩm</label>
                                    <select name="product_id" id="" class="form-control">
                                        @foreach ($product as $pro)
                                            <option value="{{ $pro->id }}">
                                                {{ $pro->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="color">Color</label>
                                    <input type="text" name="color" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" name="price" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="sales_price">Sales price</label>
                                    <input type="number" name="sales_price" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="stock">Stock</label>
                                    <input type="number" name="stock" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" accept="img/*" class="form-control">
                                </div>
                                <button class="btn btn-sm btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@stop
