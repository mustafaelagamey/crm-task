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
        //
        if (\Auth::user()->role->role === 'admin') {
            $customers = Customer::with('employee')->get();
        } elseif (\Auth::user()->role->role === 'employee') {
            $customers = \Auth::user()->customers()->with('employee')->get();
        }


        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        if (\Auth::user()->role->role === 'admin' || \Auth::user()->role->role === "employee") {

            $employees = [];
            if (\Auth::user()->role->role === 'admin') {
                $listedEmployees = User::whereHas('role', function ($q) {
                    $q->where('role', 'employee');
                })->get();

                foreach ($listedEmployees as $listedEmployee) {
                    $employees[$listedEmployee->id] = "$listedEmployee->name - $listedEmployee->email";
                }


            }




            return view('customers.create', compact('employees'));
        } else {

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
        //
        $this->validate($request, ['first_name' => 'required|min:3', 'last_name' => 'required|min:3']);

        if (\Auth::user()->role->role === 'admin')
            $this->validate($request, ['employee' => '']);


        $customer = new Customer();
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
//        dd($request->employee);
        if ($request->employee === "" || $request->employee === null)
            $customer->employee()->associate(\Auth::user());
        else
            $customer->employee()->associate($request->employee);
        $customer->save();

        if ($request->action==='on'){
            return \Redirect::action('CustomerController@createAction',$customer->id);

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
        //
        $customer=Customer::with('actions')->find($id);
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
        //

        if (\Auth::user()->role->role === 'adminn' || \Auth::user()->role->role === "employee") {

            $types = [];
            $customer=Customer::with('actions')->find($id);
            $listedTypes=Type::all();
            foreach ($listedTypes as $listedType) {
                $types[$listedType->id] = $listedType->name;
            }
            return view('customers.addAction', compact('customer','types'));
        } else {

        }


    }

    /**
     * Store a newly created action in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeAction(Request $request,$id)
    {
        //


        $this->validate($request, ['type' => 'required|min:1', 'result' => 'required|min:1']);


        $action = new Action();

        $action->type()->associate($request->type);
        $action->customer()->associate($id);
        $action->result=$request->result;
        $action->save();


        return \Redirect::action('CustomerController@show',$id);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function editEmployee($id)
    {
        //
        $customer = Customer::with('employee')->find($id);
        $employees = [];

        $listedEmployees = User::whereHas('role', function ($q) {
            $q->where('role', 'employee');
        })->get();
        foreach ($listedEmployees as $listedEmployee) {
            $employees[$listedEmployee->id] = "$listedEmployee->name - $listedEmployee->email";
        }
        return view('customers.employeeChange',compact('customer','employees'));


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
        //
        Customer::find($id)->employee()->associate($request->employee)->save();
        return \Redirect::back();
    }




}
