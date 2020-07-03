@extends('admin.layout.app')
@section('content')


    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('trans.users')</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>


    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">

                    <div class="card">
                        @if(auth()->user()->super_admin == 1)
                        <div class="card-header">

                            <a href="{{ action('Admin\UsersController@create') }}" class="btn btn-success">
                                <i class="nav-icon fas fa-plus"></i>&nbsp;
                                @lang('trans.add new')
                            </a>
                        </div>
                        @endif
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>@lang('trans.name')</th>
                                    <th>@lang('trans.email')</th>
                                    <th>@lang('trans.controls')</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($data['users'] as $user)
                                    <tr class="to-dlt-{{ $user->id }}">
                                        <td>
                                            {{ $loop->index + 1 }}
                                        </td>
                                        <td>
                                            {{ $user->name }}
                                        </td>
                                        <td>
                                            @if(!empty($user->email))
                                                {{ $user->email  }}
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            @if(auth()->user()->super_admin == 1)

                                            <a href="{{ action('Admin\UsersController@edit', $user->id) }}"> <i class="nav-icon fas fa-edit"></i></a>
                                            @if($user->super_admin != 1)
                                            <a href="{{ action('Admin\UsersController@destroy', $user->id) }}" data-id="{{ $user->id }}" class="dlt-link"> <i class="nav-icon fas fa-trash"></i></a>
                                            @endif
                                                @endif
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <!-- pagination -->
                            {{ $data['users']->links() }}
                        </div>
                    </div>

                </div>
            </div>


        </div><!-- /.container-fluid -->
    </section>


@stop
