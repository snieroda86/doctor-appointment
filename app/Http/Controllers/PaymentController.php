<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Devpark\Transfers24\Requests\Transfers24;
use App\Model\Payment;

class PaymentController extends Controller
{
    private Transfers24 $transfers24;

    public function __construct(Transfers24 $transfers24){
        $this->transfers24 = $transfers24;
    }
    public function status(request $request){
        
        $response = $this->transfers24->receive($request);
        $payment = Payment::where('session_id',$response->getSessionId())->firstOrFail();

        if ($response->isSuccess()) {
            $payment->status = 'opłacone';
            
        }else{
            $payment->status = 'nieopłacone';
            $payment->error_code = $response->getErrorCode();
            $payment->error_desc = json_encode($response->getErrorDescription());
        }

        $payment->save();
    }
}
