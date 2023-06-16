@extends('layouts.app')

@section('style-css')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">{{ __('Kokpit') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <ul>
                        <li>{{ $name }}</li>
                        <li>{{ $email }}</li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ __('Moje rezerwacje') }}</div>

                <div class="card-body">

                    <table class="table" id="user-reservations-table">
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
                        @php 
                            $i = 1;
                        @endphp
                        @if( count($reservations) > 0)
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

                        @else
                            
                            <p>Brak wizyt</p>
                                
                        @endif
                      </tbody>
                    </table>

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts-js')
<script  src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        let table = new DataTable('#user-reservations-table');
    });
</script>
@endsection
