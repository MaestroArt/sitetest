@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">The weather in Zaporizhzhia</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        Temperature: {{$temperature}} &deg;C<br>
                        Wind: {{$wind}} м/с<br>
                        Precipitation {!!$osadki!!}<br>
                        Pressure {{$pressure}} мм рт. ст.<br>
                        Humidity {{$humidity}} влажн.<br>
                        Update time is {{$upd}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
