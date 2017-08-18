@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <h3>Welcome our {{ Auth::user()->role->name }}</h3>
                        <p>Here here the admin can fill form to create new employee</p>
                        <h4>Create New Employee</h4>

                        {{Form::open(['route'=>'employee.store'])}}

                        <div class="form-group">


                            {{ Form::label('name', 'Name' , ['class' => 'control-label' ]) }}
                            {{ Form::text('name', null, ['class' => 'form-control' , 'required'=>'true']) }}


                            {{ Form::label('email', 'Email' , ['class' => 'control-label']) }}
                            {{ Form::text('email', null, ['class' => 'form-control', 'required'=>'true']) }}


                            {{ Form::label('password', 'Password' , ['class' => 'control-label']) }}
                            {{ Form::text('password', null, ['class' => 'form-control', 'required'=>'true']) }}



                            {{ Form::label('class', 'Class' , ['class' => 'control-label']) }}
                            {{ Form::select('class', ['employee' => 'Employee'], null, ['placeholder' => 'Select Class ...' , 'class'=>'form-control','required'=>'true'])}}

                        </div>

                        {{Form::submit('Add',["class"=>"btn btn-success"]) }}
                        {{ Html::linkRoute( 'home', 'home',[],["class"=>"btn btn-primary"])}}

                        {{Form::close()}}

                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection
