@extends('master')
@section('body')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Danh Sách Chi Tiết Sản Phẩm
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
                            <th>Product Name</th>
                            <th>Color</th>
                            <th>Price</th>
                            <th>Sales_price</th>
                            <th>Stock</th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lst as $l)
                            <tr>
                                <td>{{ $stt++ }}</td>
                                <td>
                                    @for ($i = 0; $i < count($pro); $i++)
                                        @if ($pro[$i]->id == $l->product_id)
                                            {{ $pro[$i]->name }}
                                        @endif
                                    @endfor
                                </td>
                                <td>{{ $l->color }}</td>
                                <td>{{ $l->price }}</td>
                                <td>{{ $l->sales_price }}</td>
                                <td>{{ $l->stock }}</td>
                                <td>
                                    <img src="{{ $l->image }}" alt="" width="50" height="50">
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-primary"
                                        href="{{ route('update-product-detail-get', ['id' => $l->id]) }}">Update
                                        <i class="fas fa-edit"></i></a>
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
