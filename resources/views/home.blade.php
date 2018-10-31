@extends('layouts.app')

<!--<link rel="stylesheet" type="text/css" href="//s1.gismeteo.ua/static/compressed/origin_c9e48b32.css">-->

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">The weather in Zaporizhzhia</div>

                <div class="panel-body">
                        Temperature: {{$temperature or 'Not found'}} &deg;C<br>
                        Wind: {{$wind or 'Not found'}} м/с<br>
                        Precipitation {!!$osadki or 'Not found'!!}<br>
                        Pressure {{$pressure or 'Not found'}} мм рт. ст.<br>
                        Humidity {{$humidity or 'Not found'}} влажн.<br>
                        Update time is {{$upd or 'Not found'}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
