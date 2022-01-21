@extends('master')
@section('body')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Sửa Chi tiết Sản Phẩm
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-body">

                <div class="container">
                    <div class="row">
                        <div class="col-sm-7">

                            <form action="{{ route('update-product-detail-post') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $name }}"
                                        readonly>
                                    {{-- @if ($errors->has('name'))
                                        <h5 class="text-danger"> {{ $errors->first('name') }}</h5>
                                    @endif --}}
                                </div>

                                <div class="form-group">
                                    <label for="color">Color</label>
                                    <input type="text" name="color" value="{{ $product->color }}" class="form-control">
                                    @if ($errors->has('color'))
                                        <h5 class="text-danger"> {{ $errors->first('color') }}</h5>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" name="price" value="{{ $product->price }}"
                                        class="form-control">
                                    @if ($errors->has('price'))
                                        <h5 class="text-danger"> {{ $errors->first('price') }}</h5>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="sales_price">Sales_price</label>
                                    <input type="number" name="sales_price" value="{{ $product->sales_price }}"
                                        class="form-control">
                                    @if ($errors->has('sales_price'))
                                        <h5 class="text-danger"> {{ $errors->first('sales_price') }}</h5>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="stock">Stock</label>
                                    <input type="number" name="stock" class="form-control"
                                        value="{{ $product->stock }}">
                                    @if ($errors->has('stock'))
                                        <h5 class="text-danger"> {{ $errors->first('stock') }}</h5>
                                    @endif
                                </div>



                                <img src="{{ $product->image }}" alt="" width="100" height="100">

                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" class="form-control">
                                    @if ($errors->has('status'))
                                        <h5 class="text-danger"> {{ $errors->first('status') }}</h5>
                                    @endif
                                </div>

                                <button class="btn btn-block btn-success">Save</button>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@stop
