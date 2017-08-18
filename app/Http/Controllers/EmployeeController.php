<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all employees from user table and send them to the view


        $employees = User::whereHas('role', function ($q) {
            $q->where('role', 'employee');
        })->get();

        return view('employee.index', compact('employees'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // check that the authenticated user is admin to pass to form view

        if (\Auth::user()->role->role !== 'admin')
            return \Redirect::route('home');

        return view('employee.create');


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //storing the created employee

        //validate the fields if passed it will continue ,if not it returns back

        $this->validate($request, ['name' => 'required|min:6', 'email' => 'email|required|unique:users', 'password' => 'required|min:6', 'class' => 'required']);

        //creating new user and assign role to user
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $role = Role::whereName($request->class)->first();
        $user->role()->associate($role);
        $user->save();

        return \Redirect::route('employee.index');


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
}
