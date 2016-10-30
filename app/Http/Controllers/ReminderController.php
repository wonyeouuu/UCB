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

    public function show($id)
    {
        return ReminderRepository::make()->show($id);
    }

    public function update($id)
    {
        return ReminderRepository::make()->update($id);
    }

    public function create()
    {
        return ReminderRepository::make()->create();
    }

    public function delete($id)
    {
        return ReminderRepository::make()->delete($id);
    }
}
