<!-- Button -->


{{ Html::linkRoute( 'employee.create', 'Add Employees',[],["class"=>"btn btn-success"])}}
{{ Html::linkRoute( 'employee.index', 'Show Employees',[],["class"=>"btn btn-primary"])}}


{{ Html::linkRoute( 'customer.create', 'Add Customer',[],["class"=>"btn btn-success"])}}
{{ Html::linkRoute( 'customer.index', 'Show Customers',[],["class"=>"btn btn-primary"])}}


{{--


<a class="btn btn-primary">Add Employee</a>
<a class="btn btn-success">Show Employees</a>
<a class="btn btn-primary">Add Customer</a>
<a class="btn btn-success">Show Customers</a>--}}
