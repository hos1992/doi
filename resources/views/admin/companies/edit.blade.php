@extends('admin.layout.app')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('trans.companies')</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">


            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">@lang('trans.edit')</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ action('Admin\CompaniesController@update', $data['company']->id) }}" enctype="multipart/form-data" method="post" class="form-horizontal">
                    <div class="card-body">

                        @if(session('success'))

                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>

                        @endif

                        {{ csrf_field() }}
                        {{ method_field('patch') }}

                        <div class="form-group row">
                            <label for="logo" class="col-sm-2 col-form-label">@lang('trans.logo')</label>
                            <div class="col-sm-10">

                                @if(!empty($data['company']->logo))
                                    <img src="{{ asset('/uploads/'. $data['company']->logo) }}" class="logo-img" width="100" alt="Logo">
                                @endif
                                <input type="file" name="logo" class="form-control" id="logo" accept="image/*"  placeholder="Logo">
                                @error('logo')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">@lang('trans.name')</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ $data['company']->name }}">
                                @error('name')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">@lang('trans.email')</label>
                            <div class="col-sm-10">
                                <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ $data['company']->email }}">
                                @error('email')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="url" class="col-sm-2 col-form-label">@lang('trans.url')</label>
                            <div class="col-sm-10">
                                <input type="text" name="url" class="form-control" id="url" placeholder="Url" value="{{ $data['company']->url }}">
                                @error('url')
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
