<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\RecordRepository;

class RecordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function all()
    {
        return RecordRepository::make()->all();
    }

    public function create()
    {
        return RecordRepository::make()->create();
    }
}
