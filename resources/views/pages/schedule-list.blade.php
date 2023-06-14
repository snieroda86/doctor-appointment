@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
          <div class="card">
              <div class="card-header">
                <h5 class="p-0 m-0">Doctor profile</h5>
              </div>

              <div class="card-body">
                   <div class="doctor-profile">
                    <div class="member text-center">
                      <div class="pic pt-3 pb-3" >
                        <img src="{{ asset('images/doctor-1.jpg') }}" class="img-fluid b-radius-50" alt="" style="max-width: 200px;">
                      </div>
                      <div class="member-info">
                        <h4>Walter White</h4>
                        <span>Chief Medical Officer</span>
                        <p>Explicabo voluptatem mollitia et repellat qui dolorum quasi</p>
                        <div class="social">
                          <a href=""><i class="ri-twitter-fill"></i></a>
                          <a href=""><i class="ri-facebook-fill"></i></a>
                          <a href=""><i class="ri-instagram-fill"></i></a>
                          <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
          </div>
        </div>


        <div class="col-md-8">
         <div class="card">
          <div class="card-header">
            <h5 class="p-0 m-0">Harmonogram - szczegóły</h5>
          </div>
          <div class="card-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Data</th>
                  <th scope="col">Dzień</th>
                  <th scope="col">Dostępne godziny</th>
                  <th scope="col">Zarejestruj się</th>

                </tr>
              </thead>
              <tbody>

                @if( !is_null( $work_days ))

                    @php
                        $i = 1;
                    @endphp

                    @foreach($work_days as $key => $workDay)
                        <tr>
                          <th scope="row">{{ $key + 1 }}</th>
                          <td>{{ $workDay->date }}</td>
                          <td>{{ $workDay->day_name }}</td>
                          <td>

                            <div class="row" style="max-width: 320px;">
                               
                                @foreach($workDay->availableDates as $hour_key => $hour)
                                    
                                    <div class="col-md-4 col-sm-6 visit-hour-item mb-2">
                                        <input id="visit_hour-{{ $hour_key + 1 }}-{{ $i }}" type="checkbox" name="res_visit_hours[]" value="{{ $hour->available_time }}">
                                        <label for="visit_hour-{{ $hour_key + 1}}-{{ $i }}">
                                            {{ $hour->available_time }}
                                        </label>
                                        
                                    </div>
                                   
                                @endforeach
                    
                
                            </div>

                          </td>

                          <td>
                            <form method="GET" class="book-visit-form">
                                @csrf
                                <input type="hidden" name="work_day_id" value="{{ $workDay->id }}">
                                @auth
                                    <button type="submit"  class="btn btn-primary">Zapisz się</button>
                                @else
                                    <a href="{{ url('/login') }}" class="btn btn-primary">Zaloguj się</button>
                                @endauth
                                
                            </form>
                          </td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                    @endforeach

                @else
                    <p> Brak danych </p>
                @endif
                
                
              </tbody>
            </table>
            
          </div>
    </div>
        </div>
    </div>
</div>
@endsection
