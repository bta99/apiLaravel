@extends('master')
@section('body')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Quản Lí sản phẩm
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-body">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-5">
                            <form action="{{ route('product_home') }}" method="get">
                                <div class="form-group">
                                    <label for="search_key">Search</label>
                                    <input type="text" name="search_key" placeholder="search product..."
                                        class="form-control d-inline">
                                </div>
                                <div class="form-group">
                                    <label for="type_pro_key">Tìm Kiếm theo loại</label>
                                    <select name="type_pro_key" id="" class="form-control">
                                        <option value="">
                                            -chọn loại-
                                        </option>
                                        @foreach ($cate as $c)
                                            <option value="{{ $c->id }}">
                                                {{ $c->type_prod }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button class="btn btn-sm btn-primary">search</button>
                            </form>
                        </div>

                    </div>
                </div>
                <table class="table table-light">
                    <thead class="thead-dark">
                        <tr>
                            <th>STT</th>
                            <th>Name</th>
                            <th>Info</th>
                            <th>Ram</th>
                            <th>Rom</th>
                            <th>Camera</th>
                            <th>Pin</th>
                            <th>Product Type</th>
                            <th>Brand</th>
                            <th>status</th>
                            <th>Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lstPro as $pro)
                            <tr>
                                <td>{{ $stt++ }}</td>
                                <td>{{ $pro->name }}</td>
                                <td>{{ $pro->info }}</td>
                                <td>{{ $pro->ram }} GB</td>
                                <td>{{ $pro->rom }} GB</td>
                                <td>{{ $pro->camera }} MP</td>
                                <td>{{ $pro->pin }} MAH</td>
                                <td>
                                    @for ($i = 0; $i < count($cate); $i++)
                                        @if ($pro->category_id == $cate[$i]->id)
                                            {{ $cate[$i]->type_prod }}
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for ($i = 0; $i < count($brand); $i++)
                                        @if ($pro->brand_id == $brand[$i]->id)
                                            {{ $brand[$i]->brand_name }}
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    {{ $pro->status }}
                                </td>
                                <td>{{ $stock[$stt - 2] }}</td>
                                <td>
                                    <a class="btn btn-sm btn-primary"
                                        href="{{ route('update-product-get', ['id' => $pro->id]) }}">Update
                                        <i class="fas fa-edit"></i></a>
                                </td>
                                <td>
                                    @if ($pro->status == 'tạm hết hàng')
                                        <form action="{{ route('delete-product') }}" method="get">
                                            {{-- @method('DELETE') --}}
                                            <input type="hidden" name="id_active" value="{{ $pro->id }}">
                                            <button class="btn btn-sm btn-success">active <i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    @else
                                        <form action="{{ route('delete-product') }}" method="get">
                                            {{-- @method('DELETE') --}}
                                            <input type="hidden" name="id" value="{{ $pro->id }}">
                                            <button class="btn btn-sm btn-danger">stop selling <i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
        {{ $lstPro->links() }}
    </section>
    <!-- /.content -->
@stop
