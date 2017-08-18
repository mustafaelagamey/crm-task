@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <h3>Welcome our {{ Auth::user()->role->name }}</h3>
                        <p>Here the admin can assign customer to employee</p>
                        <h4>Change Customer Employee</h4>

                        {{Form::open(['route'=>['customer-employee.update',$customer->id ], 'method' => 'Patch'])}}

                        <div class="form-group">


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

                            @if(Auth::user()->role->role==='admin')
                                {{ Form::label('employee', 'Select Employee' , ['class' => 'control-label']) }}
                                {{ Form::select('employee', $employees, null, ['placeholder' => 'Select Employee ...' , 'class'=>'form-control'])}}
                            @endif
                        </div>



                        <br>



                        {{Form::submit('Set',["class"=>"btn btn-success"]) }}

                        {{ Html::linkRoute( 'home', 'home',[],["class"=>"btn btn-primary"])}}
                        {{ Html::linkRoute( 'customer.index', 'Show Customers',[],["class"=>"btn btn-primary"])}}

                        {{Form::close()}}

                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection
