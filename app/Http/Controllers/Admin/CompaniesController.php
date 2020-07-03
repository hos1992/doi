<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\EditCompanyRequest;
use App\Mail\NewCompany;
use Illuminate\Http\Request;
use App\Company;
use App\Http\Requests\AddNewCompanyRequest;
use Illuminate\Support\Facades\Mail;
use App\User;

class CompaniesController extends BaseController
{

    protected $model;
    protected $UserModel;
    public function __construct()
    {
        $this->model = new Company();
        $this->UserModel = new User();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['companies'] = $this->model->get_paginated(10);
        return view('admin.companies.index')->with([
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
        return view('admin.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddNewCompanyRequest $request)
    {
        if($this->model->add($request->all())){

            // send the email
            $emails = $this->UserModel->get_emails();
            foreach ($emails as $email){
                Mail::to($email)->send(new NewCompany());
            }

           return redirect(action("Admin\CompaniesController@index"))->with('success', 'data added successfully');
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
        $data['company'] = $this->model->get_one($id);
        return view('admin.companies.edit')->with([
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
    public function update(EditCompanyRequest $request, $id)
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
        if($this->model->remove($id)){
            $data['status'] = 1;
        }else{
            $data['status'] = 0;
        }
        return $data;
    }
}
