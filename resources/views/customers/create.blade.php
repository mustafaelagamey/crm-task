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
                        <h4>Create New Customer</h4>

                        {{Form::open(['route'=>'customer.store'])}}

                        <div class="form-group">


                            {{ Form::label('first_name', 'First Name' , ['class' => 'control-label' ]) }}
                            {{ Form::text('first_name', null, ['class' => 'form-control' , 'required'=>'true']) }}


                            {{ Form::label('last_name', 'Last Name' , ['class' => 'control-label' ]) }}
                            {{ Form::text('last_name', null, ['class' => 'form-control' , 'required'=>'true']) }}

                            @if(Auth::user()->role->role==='admin')
                                {{ Form::label('employee', 'Employee' , ['class' => 'control-label']) }}
                                {{ Form::select('employee', $employees, null, ['placeholder' => 'Select Employee ...' , 'class'=>'form-control'])}}
                            @endif
                        </div>


                        @if(Auth::user()->role->role==='employee')

                        {{Form::checkbox('action', null, true, array('class' => 'name'))}}
                        {{ Form::label('action', 'Add Action' , ['class' => 'control-label']) }}
                        @endif

                        <br>



                        {{Form::submit('Add',["class"=>"btn btn-success"]) }}
                        {{ Html::linkRoute( 'home', 'home',[],["class"=>"btn btn-primary"])}}
                        {{Form::close()}}

                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection
