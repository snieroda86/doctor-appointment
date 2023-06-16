@extends('layouts.admin')

@section('content')

<div class="wrapper p-3">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						Lista rezerwacji
					</div>
					<div class="card-body">
						<table class="table" id="reservations-admin-table">
						  <thead class="thead-dark">
						    <tr>
						      <th scope="col">#</th>
						      <th scope="col">Data</th>
						      <th scope="col">Godzina</th>
						      <th scope="col">Status</th>
						      <th scope="col">Status płatności</th>
						      <th scope="col">Akcje</th>

						    </tr>
						  </thead>
						  <tbody>
						  	@if( count($reservations) > 0)
						  	@php 
						  		$i = 1;
						  	@endphp
								@foreach($reservations as $reservation)
									<tr>
								      <th scope="row">{{ $i }}</th>
								      <td>{{ $reservation->reservation_date }}</td>
								      <td>{{ $reservation->reservation_time }}</td>
								      <td>{{ $reservation->status }}</td>
								      <td>{{ $reservation->payment_status }}</td>
								      <td><a href="#" class="btn btn-danger">Anuluj</a></td>
								    </tr>
								    {{ $i++ }}
								@endforeach
							@endif

						  </tbody>
						</table>

						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection