@extends('master')
@section('body')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Danh Sách Loại Sản Phẩm
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
                            <th>Product Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lst as $c)
                            <tr>

                                {{-- <td>
                                    <img src="{{ $c->image }}" alt="" width="50" height="50">
                                </td> --}}
                                <td>{{ $stt++ }}</td>
                                <td>{{ $c->type_prod }}</td>
                                <td>
                                    <a class="btn btn-sm btn-primary"
                                        href="{{ route('update-user-get', ['id' => $c->id]) }}">Update
                                        <i class="fas fa-edit"></i></a>
                                </td>
                                <td>
                                    <form action="{{ route('delete-product-detail') }}" method="get">
                                        {{-- @method('DELETE') --}}
                                        <input type="hidden" name="id" value="{{ $c->id }}">
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
