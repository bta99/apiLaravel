@extends('master')
@section('body')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Thêm Slider
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

                            <form action="{{ route('add-slider-post') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" class="form-control">
                                    @if ($errors->has('image'))
                                        <h5 class="text-danger"> {{ $errors->first('image') }}</h5>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="link">Link</label>
                                    <input type="text" name="link" class="form-control">
                                    @if ($errors->has('link'))
                                        <h5 class="text-danger"> {{ $errors->first('link') }}</h5>
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
