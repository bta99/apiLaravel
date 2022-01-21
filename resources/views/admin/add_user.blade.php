@extends('master')
@section('body')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Thêm Tài Khoản
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

                            <form action="{{ route('add-user-post') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="fullname">Fullname</label>
                                    <input type="text" name="fullname" class="form-control">
                                    @if ($errors->has('fullname'))
                                        <h5 class="text-danger"> {{ $errors->first('fullname') }}</h5>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" class="form-control">
                                    @if ($errors->has('phone'))
                                        <h5 class="text-danger"> {{ $errors->first('phone') }}</h5>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="birthday">Birthday</label>
                                    <input type="date" name="birthday" class="form-control">
                                    @if ($errors->has('birthday'))
                                        <h5 class="text-danger"> {{ $errors->first('birthday') }}</h5>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" class="form-control">
                                    @if ($errors->has('address'))
                                        <h5 class="text-danger"> {{ $errors->first('address') }}</h5>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" class="form-control">
                                    @if ($errors->has('email'))
                                        <h5 class="text-danger"> {{ $errors->first('email') }}</h5>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control">
                                    @if ($errors->has('password'))
                                        <h5 class="text-danger"> {{ $errors->first('password') }}</h5>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="accType_Id">Account Type</label>
                                    <select name="accType_Id" id="" class="form-control">
                                        @foreach ($type as $accType)
                                            <option value="{{ $accType->id }}">
                                                {{ $accType->TypeAcc }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('accType_Id'))
                                        <h5 class="text-danger"> {{ $errors->first('accType_Id') }}</h5>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <input name="status" type="checkbox">
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
