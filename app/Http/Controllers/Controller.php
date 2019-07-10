<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function first()
    {
        $users = User::all();
        return view('welcome')->with('users', $users);
    }

    public function delete($id){
        $user = User::find($id);
        $user->delete();
        return redirect('/');
    }
}
