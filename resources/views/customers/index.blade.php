@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <h3>Welcome our {{ Auth::user()->role->name }}</h3>
                        <br>
                        <h4>Our Customers</h4>


                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Employee Email
                                    </th>

                                    <th>
                                        Employee Name
                                    </th>

                                    <th>
                                        Edit
                                    </th>


                                </tr>
                            </thead>
                            <tbody>

                                @foreach($customers as $customer)
                                    <tr>
                                        <td>
                                            {{$customer->first_name." ". $customer->last_name}}
                                        </td>

                                        <td>
                                            {{$customer->employee->email}}
                                        </td>

                                        <td>
                                            {{$customer->employee->name}}
                                        </td>

                                        <td>

                                            @if(Auth::user()->role->role==='employee')
                                            {{ Html::linkRoute( 'customer-action.create', 'Action',[$customer->id],["class"=>"btn btn-success"])}}
                                            @endif

                                            {{ Html::linkRoute( 'customer.show', 'Details',[$customer->id],["class"=>"btn btn-primary"])}}

                                                @if(Auth::user()->role->role==='admin')
                                                    {{ Html::linkRoute( 'customer-employee.edit', 'Change Employee',[$customer->id],["class"=>"btn btn-success"])}}
                                                @endif




                                        </td>


                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                        {{ Html::linkRoute( 'home', 'home',[],["class"=>"btn btn-primary"])}}

                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
