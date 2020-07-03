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

            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <a href="{{ action('Admin\CompaniesController@create') }}" class="btn btn-success">
                                <i class="nav-icon fas fa-plus"></i>&nbsp;
                                @lang('trans.add new')</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>@lang('trans.logo')</th>
                                    <th>@lang('trans.name')</th>
                                    <th>@lang('trans.email')</th>
                                    <th>@lang('trans.url')</th>
                                    <th>@lang('trans.controls')</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($data['companies'] as $company)
                                    <tr class="to-dlt-{{ $company->id }}">
                                        <td>
                                            {{ $loop->index + 1 }}
                                        </td>
                                        <td>
                                            @if(!empty($company->logo))
                                                <img src="{{ asset('/uploads/'.$company->logo) }}" width="100" alt="Logo">
                                            @endif
                                        </td>
                                        <td>
                                            {{ $company->name }}
                                        </td>
                                        <td>
                                            @if(!empty($company->email))
                                            {{ $company->email  }}
                                             @endif
                                        </td>
                                        <td>
                                            @if(!empty($company->url))
                                                <a href="{{ $company->url }}" class="btn btn-link" target="_blank">
                                                    <i class="nav-icon fas fa-link"></i>&nbsp;
                                                    URL</a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ action('Admin\CompaniesController@edit', $company->id) }}"> <i class="nav-icon fas fa-edit"></i></a>
                                            <a href="{{ action('Admin\CompaniesController@destroy', $company->id) }}" data-id="{{ $company->id }}" class="dlt-link"> <i class="nav-icon fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <!-- pagination -->
                            {{ $data['companies']->links() }}
                        </div>
                    </div>

                </div>
            </div>


        </div><!-- /.container-fluid -->
    </section>


@stop
