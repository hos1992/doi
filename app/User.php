<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


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

    public function get_emails(){
        $emails = $this->pluck('email');
        return $emails;
    }

    public function add($data){

        $insert['name'] = $data['name'];
        $insert['email'] = $data['email'];
        $insert['password'] = bcrypt($data['password']);

        if($this->create($insert)){
            return true;
        }
    }

    public function edit($data, $id){

        $insert['name'] = $data['name'];
        $insert['email'] = $data['email'];
        if(isset($data['password']) && !empty($data['password'])){
            $insert['password'] = bcrypt($data['password']);
        }
        $update = $this->where('id', $id)->update($insert);
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
