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
                    You are logged in!
                </div>

                <div>

                    @include('pages.home')

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
