@extends('layouts.frontend.app')


@section('title','Notitfications')



@section('content')

@include('frontend.includes._bradcam',['title' => 'Notitfications'])


<div class="Notitfications p-5 text-center">
    

    @forelse(auth()->user()->unreadNotifications as $not)

        <p> <b>{{ $not->data['seeker_name'] }}</b> apply on You Job <b>{{ $not->data['job_title'] }}</b> </p>

    @empty 

     <p>No New Notifications</p>

    @endforelse


</div>


@endsection
