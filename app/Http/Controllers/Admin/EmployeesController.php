<?php

namespace App\Http\Controllers\Admin;

use App\Company;
//use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employee;
use App\Http\Requests\AddNewEmployeeRequest;
use App\Http\Requests\EditEmployeeRequest;
use App\Http\Controllers\Admin\BaseController;

class EmployeesController extends BaseController
{

    protected $model;
    protected $companyModel;

    public function __construct()
    {
        $this->model = new Employee();
        $this->companyModel = new Company();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['employees'] = $this->model->get_paginated(10);
        return view('admin.employees.index')->with([
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
        $data['companies'] = $this->companyModel->get_all();
        return view('admin.employees.create')->with([
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddNewEmployeeRequest $request)
    {
        if($this->model->add($request->all())) {
            return redirect()->action('Admin\EmployeesController@index');
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
        $data['employee'] = $this->model->get_one($id);
        $data['companies'] = $this->companyModel->get_all();
        return view('admin.employees.edit')->with([
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
    public function update(EditEmployeeRequest $request, $id)
    {
        if($this->model->edit($request->except(['_token', '_method']), $id)){
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
