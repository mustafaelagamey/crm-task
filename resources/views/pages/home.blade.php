@if(Auth::guest())
    Please Log in
@else
    @if(Auth::user()->role->role==='admin')
        {{--the users can add employees interface--}}

        {{ Html::linkRoute( 'employee.create', 'Add Employees',[],["class"=>"btn btn-success"])}}
        {{ Html::linkRoute( 'employee.index', 'Show Employees',[],["class"=>"btn btn-primary"])}}
    @endif
    @if(Auth::user()->role->role==='employee' ||Auth::user()->role->role==='admin')
        {{--the users can add customers interface--}}

        {{ Html::linkRoute( 'customer.create', 'Add Customer',[],["class"=>"btn btn-success"])}}
        {{ Html::linkRoute( 'customer.index', 'Show Customers',[],["class"=>"btn btn-primary"])}}
    @endif
@endif




