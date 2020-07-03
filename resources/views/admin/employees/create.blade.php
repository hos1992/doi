@extends('admin.layout.app')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('trans.employees')</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">


            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">@lang('trans.add new')</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ action('Admin\EmployeesController@store') }}" enctype="multipart/form-data" method="post" class="form-horizontal">
                    <div class="card-body">

                        @if(session('success'))

                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>

                        @endif

                        {{ csrf_field() }}


                        <div class="form-group row">
                            <label for="first_name" class="col-sm-2 col-form-label">@lang('trans.first name')</label>
                            <div class="col-sm-10">
                                <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name" value="{{ old('first_name') }}">
                                @error('first_name')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-sm-2 col-form-label">@lang('trans.last name')</label>
                            <div class="col-sm-10">
                                <input type="text" name="last_name" class="form-control" id="name" placeholder="Last Name" value="{{ old('last_name') }}">
                                @error('last_name')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">@lang('trans.email')</label>
                            <div class="col-sm-10">
                                <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ old('email') }}">
                                @error('email')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-sm-2 col-form-label">@lang('trans.phone')</label>
                            <div class="col-sm-10">
                                <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone" value="{{ old('phone') }}">
                                @error('phone')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="company" class="col-sm-2 col-form-label">@lang('trans.company')</label>
                            <div class="col-sm-10">

                                <select name="company_id" id="company" class="form-control">
                                    <option selected disabled>@lang('trans.choose company')</option>
                                    @foreach($data['companies'] as $company)
                                        <option @if(old('company_id') == $company->id) selected @endif value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                </select>

                                @error('phone')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">@lang('trans.save')</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>


        </div><!-- /.container-fluid -->
    </section>


@stop
