@extends('master')
@section('body')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Quản Lí Tài Khoản
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-body">

                <table class="table table-light">
                    <thead class="thead-dark">
                        <tr>
                            <th>STT</th>
                            <th>Image</th>
                            <th>Link</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lst as $slider)
                            <tr>
                                <td>{{ $stt++ }}</td>
                                <td>
                                    <img src="{{ $slider->image }}" alt="" width="200" height="50">
                                </td>
                                <td>{{ $slider->link }}</td>
                                <td>
                                    <a class="btn btn-sm btn-primary"
                                        href="{{ route('update-user-get', ['id' => $slider->id]) }}">Update
                                        <i class="fas fa-edit"></i></a>
                                </td>
                                <td>
                                    <form action="{{ route('delete-user') }}" method="get">
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $slider->id }}">
                                        <button class="btn btn-sm btn-danger">Delete <i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@stop
