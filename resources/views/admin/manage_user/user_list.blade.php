@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="/home"><button class="btn btn-warning"><i class="fa fa-arrow-left" ></i>&nbsp;Dashboard</button></a>
                    </div>

                    <div class="card-body">
                      @if (session('status'))
                          <div class="alert alert-success" role="alert">
                              {{ session('status') }}
                          </div>
                      @endif
                        <?php
                        $get_unit = DB::table('users')->get();
                        ?>

                        <table class="table">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Addres</th>
                                <th>User Status</th>
                                <th width="280px">Actions</th>
                            </tr>
                            @foreach ($get_unit as $app)
                                <tr>
                                    <td>{{ $app->name }}</td>
                                    <td>{{ $app->email }}</td>
                                    <td>{{ $app->phone }}</td>
                                    <td>{{ $app->address }}</td>
                                    <td>
                                        @if($app->status=='1')
                                            <button class="btn btn-success btn-sm">Active</button>
                                        @endif
                                        @if($app->status=='0')
                                             <button class="btn btn-warning btn-sm">Banned</button>
                                         @endif
                                    </td>
                                    <td>
                                        @if($app->status=='1')
                                        <a class="btn btn-warning btn-sm" href="{{'/bann/'.$app->id}}">Banned</a>
                                        @endif
                                        @if($app->status=='0')
                                        <a class="btn btn-success btn-sm" href="{{'/bann/'.$app->id}}">Activate</a>
                                        @endif
                                       <a class="btn btn-danger btn-sm" href="{{'/del_user/'.$app->id}}">Delete</a>

                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
