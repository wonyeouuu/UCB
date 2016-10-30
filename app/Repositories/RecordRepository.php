<?php

namespace App\Repositories;

use DB;
use Auth;
use App\Record;
use Illuminate\Support\Facades\Input;

Class RecordRepository
{
    public static function make()
    {
        return new static;
    }

    public function all()
    {
        return Auth::user()->records()->get();
    }

    public function create()
    {
        Record::create(array_merge(Input::all(), ['user_id' => Auth::user()->id]));
        return [
            'success' => 1,
            'message' => 'Success.'
        ];
    }

    public function update($id)
    {
        Record::find($id)->update(Input::all());
        return [
            'success' => 1,
            'message' => 'Success.'
        ];
    }

    public function show($id)
    {
        return Record::find($id);
    }
}
