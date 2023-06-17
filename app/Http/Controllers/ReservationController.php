<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Devpark\Transfers24\Requests\Transfers24;
use App\Models\Reservation;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;


class ReservationController extends Controller
{

    private Transfers24 $transfers24;

    public function __construct(Transfers24 $transfers24){
        $this->transfers24 = $transfers24;
    }
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
            // return redirect()->route('user.my_account');
            return $this->paymentTransaction($reservation);
        } else {
            return redirect()->back()->withErrors('Nie udało się zapisać rezerwacji.');
        }


    }

    // Payment transaction
    private function paymentTransaction( Reservation $reservation){
        $payment = new Payment();
        $payment->reservation_id = $reservation->id;
        
        $this->transfers24->setEmail('snieroda86@wp.pl')->setAmount(100);

        try {
            $response = $this->transfers24->init();

            if($response->isSuccess())
            {
                $payment->status = 'nieopłacone';
                $payment->session_id = $response->getSessionId();
                $payment->save();

                // save registration parameters in payment object
                
                return redirect( $this->transfers24->execute($response->getToken()) );
            }else{
                $payment->status = 'nieopłacone';
                $payment->error_code = $response->getErrorCode();
                $payment->error_desc = json_encode($response->getErrorDescription());
                $payment->save();
                return back()->with('warning' , 'Płatność nie powiodła się');
            }
        } catch(Exception $e) {
            Log::error('Błąd płatności' , ['error'=> $e]);
           return back()->with('warning' , 'Płatność nie powiodła się');
        }

       
    }
}
