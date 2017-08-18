@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <h3>Welcome our {{ Auth::user()->role->name }}</h3>
                        <p>Here here the admin show all employees</p>
                        <h4>Our Employees</h4>




                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Email
                                    </th>

                                    <th>
                                        Class
                                    </th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employees as $employee)
                                    <tr>
                                        <td>
                                            {{$employee->name}}
                                        </td>
                                        <td>
                                            {{$employee->email}}
                                        </td>
                                        <td>
                                            {{$employee->role->name}}
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
