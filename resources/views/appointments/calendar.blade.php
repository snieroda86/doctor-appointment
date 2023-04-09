@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 pt-5 pb-5">
            
               
               <div class="calendar-wrapper">
                   <div id="calendar"></div>
               </div>
            
        </div>
    </div>
</div>
@endsection

@section('scripts-js')

<script type="text/javascript">
     document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth' ,
        });
        calendar.render();
      });
</script>

@endsection
