@extends('master')
@section('body')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Thêm Sản Phẩm
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

                            <form action="{{ route('update-product-post') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $prod->id }}">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $prod->name }}">
                                    @if ($errors->has('name'))
                                        <h5 class="text-danger"> {{ $errors->first('name') }}</h5>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="info">Info</label>
                                    <textarea name="info" id="" cols="30" rows="10" class="form-control">
                                                                                                                        {{ $prod->info }}
                                                                                                                    </textarea>
                                    @if ($errors->has('info'))
                                        <h5 class="text-danger"> {{ $errors->first('info') }}</h5>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="ram">Ram(GB)</label>
                                    <input type="number" name="ram" value="{{ $prod->ram }}" class="form-control">
                                    @if ($errors->has('ram'))
                                        <h5 class="text-danger"> {{ $errors->first('ram') }}</h5>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="rom">Rom(GB)</label>
                                    <input type="number" name="rom" value="{{ $prod->rom }}" class="form-control">
                                    @if ($errors->has('rom'))
                                        <h5 class="text-danger"> {{ $errors->first('row') }}</h5>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="camera">Camera(MP)</label>
                                    <input type="number" name="camera" class="form-control"
                                        value="{{ $prod->camera }}">
                                    @if ($errors->has('camera'))
                                        <h5 class="text-danger"> {{ $errors->first('camera') }}</h5>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="pin">Pin(MAH)</label>
                                    <input type="number" name="pin" class="form-control" value="{{ $prod->pin }}">
                                    @if ($errors->has('pin'))
                                        <h5 class="text-danger"> {{ $errors->first('pin') }}</h5>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="category_id">Product Type</label>
                                    <select name="category_id" id="" class="form-control">
                                        @foreach ($cate as $c)
                                            <option value="{{ $c->id }}" @if ($c->id == $prod->category_id)
                                                selected
                                        @endif
                                        >
                                        {{ $c->type_prod }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('category_id'))
                                        <h5 class="text-danger"> {{ $errors->first('category_id') }}</h5>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="brand_id">Brand</label>
                                    <select name="brand_id" id="" class="form-control">
                                        @foreach ($brand as $b)
                                            <option value="{{ $b->id }}" @if ($b->id == $prod->brand_id)
                                                selected
                                        @endif
                                        >
                                        {{ $b->brand_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('brand_id'))
                                        <h5 class="text-danger"> {{ $errors->first('brand_id') }}</h5>
                                    @endif
                                </div>

                                {{-- <div class="form-group">
                                    <label for="status">Status</label>
                                    <input name="status" type="checkbox">
                                    @if ($errors->has('status'))
                                        <h5 class="text-danger"> {{ $errors->first('status') }}</h5>
                                    @endif
                                </div> --}}

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
