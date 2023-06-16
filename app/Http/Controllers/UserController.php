<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;

class UserController extends Controller
{
    // mu accout page
    public function index(){
        $user = Auth::user();
        $name = $user->name;
        $email = $user->email;
        $reservations = Reservation::where('user_id' , $user->id )->get();

        return view('user.my_account' , ['name'=> $name , 'email' => $email , 'reservations' => $reservations]);
    }
}
