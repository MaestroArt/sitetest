@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Feedbacks</div>

                <div class="panel-body">
                    <table class="table table-bordered">
                     <thead>
                     <tr>
                     <th>Date</th>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Message</th>
                     </tr>
                     </thead>
                     <tbody>
                     @foreach ( $msgs as $msg )
                     <tr>
                     <td> {{\Carbon\Carbon::parse($msg->created_at)->format('d.m.Y H:i:s')}} </td>
                     <td> {{$msg->name}} </td>
                     <td> {{$msg->email}} </td>
                     <td> {{$msg->msg}} </td>
                     </tr>
                     @endforeach
                     </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
