@extends('layouts.admin')

@section('content')

<div class="wrapper p-3 col-md-8">
	<div class="card" class="">
	  <div class="card-header">
	    <h5 class="p-0 m-0">Harmonogram wizyt</h5>
	  </div>
	  <div class="card-body">
	  	<div class="row">
	  		<div class="col-md-5">
	  			<div id="scheduler-sn" data-language="pl"></div>
	  		</div>

	  		<div class="col-md-7">
	  			<div class="alert alert-warning d-flex aligitems-center">
	  				<span>Data: </span><span class="pl-3 text-bold"><div id="visit-day"></div></span>
	  			</div>

	  			<form id="save-doctor-scheduler"  method="get">
	  				@csrf
	  				<input type="hidden" id="visit_day_ff" name="visit_day" value="">
	  				<div class="row">
	  					<div class="col-md-3 col-sm-6 visit-hour-item">
	  						<input id="visit_hour_1" type="checkbox" name="visit_hours[]" value="7:00">
	  						<label for="visit_hour_1">
	  							7:00
	  						</label>
	  						
	  					</div>

	  					<div class="col-md-3 col-sm-6 visit-hour-item">
	  						<input id="visit_hour_2" type="checkbox" name="visit_hours[]" value="7:45">
	  						<label for="visit_hour_2">
	  							7:45
	  						</label>
	  						
	  					</div>

	  					<div class="col-md-3 col-sm-6 visit-hour-item">
	  						<input id="visit_hour_3" type="checkbox" name="visit_hours[]" value="8:30">
	  						<label for="visit_hour_3">
	  							8:30
	  						</label>
	  						
	  					</div>

	  					<div class="col-md-3 col-sm-6 visit-hour-item">
	  						<input id="visit_hour_4" type="checkbox" name="visit_hours[]" value="9:15">
	  						<label for="visit_hour_4">
	  							9:15
	  						</label>
	  						
	  					</div>

	  					<!-- Second row -->
	  					<div class="col-md-3 col-sm-6 visit-hour-item">
	  						<input id="visit_hour_5" type="checkbox" name="visit_hours[]" value="10:00">
	  						<label for="visit_hour_5">
	  							10:00
	  						</label>
	  						
	  					</div>

	  					<div class="col-md-3 col-sm-6 visit-hour-item">
	  						<input id="visit_hour_6" type="checkbox" name="visit_hours[]" value="10:45">
	  						<label for="visit_hour_6">
	  							10:45
	  						</label>
	  						
	  					</div>

	  					<div class="col-md-3 col-sm-6 visit-hour-item">
	  						<input id="visit_hour_7" type="checkbox" name="visit_hours[]" value="11:30">
	  						<label for="visit_hour_7">
	  							11:30
	  						</label>
	  						
	  					</div>

	  					<div class="col-md-3 col-sm-6 visit-hour-item">
	  						<input id="visit_hour_8" type="checkbox" name="visit_hours[]" value="12:15">
	  						<label for="visit_hour_8">
	  							12:15
	  						</label>
	  						
	  					</div>

	  				</div>

	  				<input type="submit" value="Zapisz" class="btn btn-primary mt-5">
	  			</form>
	  		</div>
	  	</div>
	  </div>

	</div>
</div>


@endsection

@section('scripts-js')


<script type="text/javascript">
	jQuery(document).ready(function($) {

	   var schedulerSN = document.getElementById("scheduler-sn");
	   var visitDayDiv = document.getElementById("visit-day");

	   var visit_day_ff = document.getElementById("visit_day_ff");

	   var myCalendar = jsCalendar.new(schedulerSN);

	   myCalendar.onDateClick(function(event, date){
	      // alert('To jest data');
	      visitDayDiv.textContent = date.toLocaleDateString();
	      visit_day_ff.value = date.toLocaleDateString();
	   });

	   // AJAX CALL
	   $(document).on('submit', '#save-doctor-scheduler', function(event) {
		    event.preventDefault();

		    if(  $('#visit_day_ff').val() === '' ){
		    	alert('Musisz wybrać date');

		    	return;
		    }
		    
		    var formData = $(this).serialize();
		    
		    $.ajax({
		        url: "{{ route('harmonogram.save') }}",
		        type: "GET",
		        data: formData,
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        },
		        success: function(data) {
		            location.reload();
		        },
		        error: function(xhr, status, error) {
		            location.reload();
		        }
		    });
		});


	})	
</script>


@endsection