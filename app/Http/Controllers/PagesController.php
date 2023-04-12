<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\WorkDay;

class PagesController extends Controller
{
    // schedulerList
    public function schedulerList(){
        $workDays = WorkDay::with('availableDates')->latest()->get();
        return view('pages.schedule-list' , ['work_days' => $workDays]);
    }
}
