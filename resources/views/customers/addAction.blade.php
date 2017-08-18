@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <h3>Welcome our {{ Auth::user()->role->name }}</h3>
                        <p>Here the user can add action to the customer</p>
                        <h4>Create New Action For Customer: {{$customer->first_name ."  ".  $customer->last_name   }} </h4>


                        {{Form::open(['route'=>['customer-action.store' ,$customer->id]])}}

                        <div class="form-group">


                            {{ Form::label('type', 'Type' , ['class' => 'control-label']) }}
                            {{ Form::select('type', $types, null, ['placeholder' => 'Select Type ...' , 'class'=>'form-control'])}}

                            {{ Form::label('result', 'Result' , ['class' => 'control-label' ]) }}
                            {{ Form::text('result', null, ['class' => 'form-control' , 'required'=>'true']) }}
                            <br>
                            {{Form::submit('Record',["class"=>"btn btn-success"]) }}
                            {{ Html::linkRoute( 'home', 'home',[],["class"=>"btn btn-primary"])}}
                            {{Form::close()}}
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection
