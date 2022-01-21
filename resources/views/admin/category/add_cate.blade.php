@extends('master')
@section('body')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Thêm Loại Sản Phẩm
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

                            <form action="{{ route('add-cate-post') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" class="form-control">
                                    @if ($errors->has('image'))
                                        <h5 class="text-danger"> {{ $errors->first('image') }}</h5>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="type_prod">Product Type</label>
                                    <input type="text" name="type_prod" class="form-control">
                                    @if ($errors->has('type_prod'))
                                        <h5 class="text-danger"> {{ $errors->first('type_prod') }}</h5>
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
