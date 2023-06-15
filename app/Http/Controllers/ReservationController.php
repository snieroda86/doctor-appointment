<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    // create 
    public function create(Request $request){
        
        $user_id = auth()->user()->id;
        $reservation_date = $request->work_day_date;
        $reservation_time = $request->res_visit_hour;
        $reservation_day_name = $request->work_day_name;

        $reservation = new Reservation();
        $reservation->user_id = $user_id;
        $reservation->reservation_date = $reservation_date;       
        $reservation->reservation_time = $reservation_time;

        if ($reservation->save()) {
            return redirect()->to('home');
        } else {
            return redirect()->back()->withErrors('Nie udało się zapisać rezerwacji.');
        }


    }
}
