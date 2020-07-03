<?php

namespace App\Http\Controllers\Admin;

//use App\Http\Controllers\Controller;
use App\Http\Requests\EditUserRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\AddNewUserRequest;
use App\Http\Controllers\Admin\BaseController;

class UsersController extends BaseController
{

    protected $model;

    public function __construct()
    {
        $this->model = new User();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['users'] = $this->model->get_paginated(10);
        return view('admin.users.index')->with([
           'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddNewUserRequest $request)
    {
        if($this->model->add($request->all())){
            return redirect()->action('Admin\UsersController@index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['user'] = $this->model->get_one($id);
        return view('admin.users.edit')->with([
           'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUserRequest $request, $id)
    {
        if($this->model->edit($request->all(), $id)){
            return redirect()->back()->with('success', 'data updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->model->remove($id);
        $data['status'] = 1;
        return $data;
    }
}
