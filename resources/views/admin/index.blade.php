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
                            <th>Fullname</th>
                            <th>Phone</th>
                            <th>Birthday</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lstUser as $user)
                            <tr>
                                <td>{{ $stt++ }}</td>
                                <td>{{ $user->fullname }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->birthday }}</td>
                                <td>{{ $user->address }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @for ($i = 0; $i < count($type); $i++)
                                        @if ($user->accType_Id == $type[$i]->id)
                                            {{ $type[$i]->TypeAcc }}
                                        @endif
                                    @endfor
                                </td>
                                <td>{{ $user->status }}</td>
                                <td>
                                    <a class="btn btn-sm btn-primary"
                                        href="{{ route('update-user-get', ['id' => $user]) }}">Update
                                        <i class="fas fa-edit"></i></a>
                                </td>
                                <td>
                                    <form action="{{ route('delete-user') }}" method="get">
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $user->id }}">
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
