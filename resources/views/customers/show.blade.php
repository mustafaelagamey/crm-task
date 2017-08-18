@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <h3>Welcome our {{ Auth::user()->role->name }}</h3>
                        <p>Here here the user can see customer details and actions</p>
                        <h4>Customer Details</h4>

                        <div>
                            <table class="table">
                                <tbody>

                                    <tr>
                                        <th>First Name</th>
                                        <td>{{$customer->first_name}}</td>

                                    </tr>
                                    <tr>
                                        <th>Last Name</th>
                                        <td>{{$customer->last_name}}</td>

                                    </tr>
                                    <tr>
                                        <th>Employee</th>
                                        <td>{{$customer->employee->name."(" .$customer->employee->email." )"}}</td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{ Html::linkRoute( 'customer-action.create', 'Add Action',[$customer->id],["class"=>"btn btn-success"])}}
                        {{ Html::linkRoute( 'customer.index', 'Show Customers',[],["class"=>"btn btn-primary"])}}
                        @if(Auth::user()->role->role==='admin')
                            {{ Html::linkRoute( 'customer-employee.edit', 'Change Employee',[$customer->id],["class"=>"btn btn-danger"])}}
                        @endif
                        {{ Html::linkRoute( 'home', 'home',[],["class"=>"btn btn-primary"])}}


                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>
                                        Action
                                    </th>
                                    <th>
                                        Date
                                    </th>
                                    <th>
                                        Result
                                    </th>

                                    <th>
                                        Class
                                    </th>


                                </tr>
                            </thead>
                            <tbody>

                                @foreach( $customer->actions as $action)
                                    <tr>
                                        <td>
                                            {{$action->type->name}}
                                        </td>

                                        <td>
                                            {{$action->created_at}}
                                        </td>

                                        <td>
                                            {{$action->result}}
                                        </td>


                                    </tr>
                                @endforeach
                            </tbody>

                        </table>

                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
