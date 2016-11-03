<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class TokenController extends Controller
{
    public function postToken($id)
    {
        $user = User::find($id);
        $user->fcm_token = Input::get('token');
        $result = $user->save();
        return [
            'success' => $result ? 1: 0
        ];
    }
}
