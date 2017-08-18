<?php

namespace App\Http\Controllers;

use App\Action;
use App\Customer;
use App\Type;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all users for admin
        //get related customer to the employee


        if (\Auth::user()->role->role === 'admin') {
            $customers = Customer::with('employee')->get();
        } elseif (\Auth::user()->role->role === 'employee') {
            $customers = \Auth::user()->customers()->with('employee')->get();
        } else \Redirect::route('home');


        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return the form for creating new customer

        //check who can create customer
        if (\Auth::user()->role->role === 'admin' || \Auth::user()->role->role === "employee") {

            // if authenticated user admin return all employees to view
            // employees returned to make admin able to assign customer to employee
            $employees = [];
            if (\Auth::user()->role->role === 'admin') {
                $listedEmployees = User::whereHas('role', function ($q) {
                    $q->where('role', 'employee');
                })->get();

                //optimizing passed array to be compatible with form builder
                foreach ($listedEmployees as $listedEmployee) {
                    $employees[$listedEmployee->id] = "$listedEmployee->name - $listedEmployee->email";
                }

            }


            return view('customers.create', compact('employees'));
        } else {

            \Redirect::route('home');
        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validating the request
        $this->validate($request, ['first_name' => 'required|min:3', 'last_name' => 'required|min:3']);

        //validate the assigned employee if the authenticated user is admin
        // if authenticated employee not admin this assigned employee will be passed
        if (\Auth::user()->role->role === 'admin')
            $this->validate($request, ['employee' => '']);

        //creating new customer
        $customer = new Customer();
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;

        if ($request->employee === "" || $request->employee === null)
            // authenticate customer to the authenticated user (employee) in case of authenticated employee
            $customer->employee()->associate(\Auth::user());
        else
            // authenticate customer to the selected user (employee ) in case of authenticated admin
            $customer->employee()->associate($request->employee);


        $customer->save();

        // this checks if employee want to add action for created customer or not
        if ($request->action === 'on') {
            return \Redirect::action('CustomerController@createAction', $customer->id);

        }
        return \Redirect::action('CustomerController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //get specific customer and send it to show page

        $customer = Customer::with('actions')->find($id);
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

    }


    /*
     * adding actions
     */
    public function createAction($id)
    {
        //get recording action form
        //check who can create action (in our case only employee who can)

        if (\Auth::user()->role->role === "employee") {

            //getting customer information to send it to the view
            $customer = Customer::with('actions')->find($id);

            //getting action types dynamically
            $types = [];
            $listedTypes = Type::all();

            //optimizing passed array to be compatible with form builder
            foreach ($listedTypes as $listedType) {
                $types[$listedType->id] = $listedType->name;
            }

            return view('customers.addAction', compact('customer', 'types'));

        } else {
            \Redirect::route('home');
        }


    }

    /**
     * Store a newly created action in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeAction(Request $request, $id)
    {
        //storing the created action

        $this->validate($request, ['type' => 'required|min:1', 'result' => 'required|min:1']);


        //create action and assign it to user
        $action = new Action();
        $action->type()->associate($request->type);
        $action->customer()->associate($id);
        $action->result = $request->result;
        $action->save();


        return \Redirect::action('CustomerController@show', $id);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function editEmployee($id)
    {
        //get the form for edit the assigned employee

        //make sure that authenticated user is admin
        if (\Auth::user()->role->role !== 'admin')
            \Redirect::route('home');

        //getting customer from url
        $customer = Customer::with('employee')->find($id);

        //git the employees and optimize array passed to view for form builder
        $listedEmployees = User::whereHas('role', function ($q) {
            $q->where('role', 'employee');
        })->get();

        $employees = [];
        foreach ($listedEmployees as $listedEmployee) {
            $employees[$listedEmployee->id] = "$listedEmployee->name - $listedEmployee->email";
        }
        return view('customers.employeeChange', compact('customer', 'employees'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function updateEmployee(Request $request, $id)
    {
        //assign and saving the customer to employee
        Customer::find($id)->employee()->associate($request->employee)->save();
        return \Redirect::back();
    }


}
