<?php

namespace App\Http\Controllers;

use Auth;
use App\User;

class RemoveUserController extends Controller
{
    function __invoke($id) {

    	if (Auth::check()) {
		    if (Auth::id() == $id) {
		    	Auth::logout();
		    	User::find($id)->delete();
		    	return redirect('/');
		    }
		    else {
		    	"You can't delete other users!";
		    }
		}
		else {
			return "You are not logged in!";
		}
    }
}
