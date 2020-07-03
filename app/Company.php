<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class Company extends Model
{
    protected $table = 'companies';

    protected $fillable = [
      'logo',
      'name',
      'email',
      'url',
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

    public function add($data){
        $insert = []; // data to be inserted to the database


        // check if the request has logo file
        if(isset($data['logo'])) {

            // get the uploaded logo
            $logo = $data['logo'];

            // create new name
            $file_name = time() . '_' . md5($logo->getClientOriginalName()) . '.'. $logo->getClientOriginalExtension();

            // resize the image
            $img = Image::make($logo->getRealPath())->resize(100, 100);

            // add new file to storage
            Storage::put($file_name, (string) $img->encode());

            // add the name to the insert array
            $insert['logo'] = $file_name;

        }

        $insert['name'] = $data['name'];
        $insert['email'] = $data['email'];
        $insert['url'] = $data['url'];

        if($this->create($insert)){
            return true;
        }

    }

    public function edit ($data,$id){

        $row = $this->find($id);

        // check if the request has logo file
        if(isset($data['logo'])) {

            // delete an existing one
            Storage::delete($row->logo);

            // get the uploaded logo
            $logo = $data['logo'];

            // create new name
            $file_name = time() . '_' . md5($logo->getClientOriginalName()) . '.'. $logo->getClientOriginalExtension();

            // resize the image
            $img = Image::make($logo->getRealPath())->resize(100, 100);

            // add new file to storage
            Storage::put($file_name, (string) $img->encode());

            // add the name to the insert array
            $row->logo = $file_name;

        }

        $row->name = $data['name'];
        if(!empty($data['email'])){
            $row->email = $data['email'];
        }
        if(!empty($data['url'])){
            $row->url = $data['url'];
        }

        $save = $row->save();
        if($save){
            return true;
        }


    }

    public function remove($id){
        $row = $this->find($id);

        // delete the attached logo file
        Storage::delete($row->logo);

        $row->delete();

        return true;
    }

}
