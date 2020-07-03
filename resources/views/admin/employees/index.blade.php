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

            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <a href="{{ action('Admin\EmployeesController@create') }}" class="btn btn-success">
                                <i class="nav-icon fas fa-plus"></i>&nbsp;
                                @lang('trans.add new')</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>@lang('trans.name')</th>
                                    <th>@lang('trans.email')</th>
                                    <th>@lang('trans.phone')</th>
                                    <th>@lang('trans.company')</th>
                                    <th>@lang('trans.controls')</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($data['employees'] as $employee)
                                    <tr class="to-dlt-{{ $employee->id }}">
                                        <td>
                                            {{ $loop->index + 1 }}
                                        </td>
                                        <td>
                                            {{ $employee->name }}
                                        </td>
                                        <td>
                                            @if(!empty($employee->email))
                                                {{ $employee->email  }}
                                            @endif
                                        </td>
                                        <td>
                                            @if(!empty($employee->phone))
                                                {{ $employee->phone  }}
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($employee->company->name))
                                                {{ $employee->company->name }}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ action('Admin\EmployeesController@edit', $employee->id) }}"> <i class="nav-icon fas fa-edit"></i></a>
                                            <a href="{{ action('Admin\EmployeesController@destroy', $employee->id) }}" data-id="{{ $employee->id }}" class="dlt-link"> <i class="nav-icon fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <!-- pagination -->
                            {{ $data['employees']->links() }}
                        </div>
                    </div>

                </div>
            </div>


        </div><!-- /.container-fluid -->
    </section>


@stop
