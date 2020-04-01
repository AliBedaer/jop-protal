@extends('layouts.dashboard.app')



@section('title', $title )



@section('content')
    <div class="app-title">
        <div>
          <h1><i class="fa fa-home"></i> {{ $title }}</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="{{ aurl("") }}"> {{ $title }}</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-6 col-lg-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
              <h4>{{ trans('dashboard.admins') }}</h4>
              <p><b>{{ $admins_count }}</b></p>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-search fa-3x"></i>
            <div class="info">
              <h4>{{ trans('dashboard.seekers') }}</h4>
              <p><b>{{ $seekers_count }}</b></p>
            </div>
          </div>
        </div>


        <div class="col-md-6 col-lg-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-flag fa-3x"></i>
            <div class="info">
              <h4>{{ trans('dashboard.countries') }}</h4>
              <p><b>{{ $countries_count }}</b></p>
            </div>
          </div>
        </div>
      </div>
        
        
       

    
@endsection