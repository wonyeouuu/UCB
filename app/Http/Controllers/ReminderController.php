<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\ReminderRepository;

class ReminderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function all()
    {
        return ReminderRepository::make()->all();
    }

    public function create()
    {
        return ReminderRepository::make()->create();
    }
}
