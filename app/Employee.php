<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'company_id',
    ];

    protected $appends = ['name'];

    public function getNameAttribute(){
        return $this->first_name . ' ' . $this->last_name;
    }

    public function company(){
        return $this->belongsTo('App\Company', 'company_id');
    }

    public function get_paginated($limit){
        return $this->paginate($limit);
    }

    public function get_all(){
        return $this->all();
    }

    public function get_one($id){
        $row = $this->find($id);
        return $row;
    }

    public function add($data){
        if($this->create($data)){
            return true;
        }
    }

    public function edit($data, $id){
        $update = $this->where('id', $id)->update($data);
        if($update){
            return true;
        }
    }

    public function remove($id){
        if($this->destroy($id)){
            return true;
        }
    }


}
