<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorkDay;
use App\Models\AvailableDate;
use RealRashid\SweetAlert\Facades\Alert;


class AdminController extends Controller
{
    // kokpit
    public function kokpit(){
        return view('admin.kokpit');
    }

    // harmonongram
    public function harmonogram(){
        $workDays = WorkDay::with('availableDates')->latest()->get();
        return view('admin.harmonogram' , ['work_days' => $workDays]);
    }

    // harmonongram insert
    public function insert( Request $req){
        setlocale(LC_ALL, 'pl_PL' );
        $visit_day = $req->visit_day;

        if(!is_null($visit_day)){
            $newDate = date("Y-m-d", strtotime($visit_day));  
            $day_of_week = strtolower(strftime('%A', strtotime($newDate))) ;
            $dni_tygdnia = [
                'monday' => 'Poniedziałek',
                'tuesday' => 'Wtorek',
                'wednesday' => 'Środa',
                'thursday' => 'Czwartek',
                'friday' => 'Piątek',
                'saturday' => 'Sobota',
                'sunday' => 'Niedziela'
            ];

            $day_of_week = $dni_tygdnia[ $day_of_week ];
            $workDay = new WorkDay();
            $workDay->date = $newDate;
            $workDay->day_name = $day_of_week;

            if($workDay->save()){
               
            }else{
                return Alert::error('Bład!', 'Nie udało się zapisać danych');
            }
        }

        //  Available time
        $success = true;
        if( !is_null($visit_hours = $req->visit_hours) ){
            $lastInsertedId = $workDay->id;

            foreach ($visit_hours as $key => $value) {
                $availableDate = new AvailableDate();
                $availableDate->work_days_id = $lastInsertedId;
                $availableDate->available_time = $value;
                if (!$availableDate->save()) {
                    $success = false;
                }

            }
        }

        if ($success) {
           return Alert::success('Udało się!', 'Dane zapisane poprawnie');
        } else {
            return Alert::error('Bład!', 'Nie udało się zapisać danych');
        }
        
        
    }

    // harmonongram  - delete work day
    public function delete( Request $req ){
        
        $work_day_id = $req->work_day_id;

        $workday = WorkDay::find($work_day_id);
        
        if (!$workday) {
            abort(404);
        }
        
        $deleted = $workday->delete();
        
        if ($deleted) {
           return Alert::success('Udało się!', 'Rekord usuniety poprawnie');
        } else {
            return Alert::error('Bład!', 'Nie udało się usunać rekordu');
        }

    }
}
