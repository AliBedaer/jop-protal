@extends('layouts.dashboard.app')



@section('title', $title )



@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-home"></i> {{ $title }}</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><i class="fa fa-users fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="{{ aurl("") }}"> {{ $title }}</a></li>
    </ul>
</div>

<!-- Form Section -->

<div class="row">

    <div class="col-md-9 mx-auto">

        <div class="tile">

            <h3 class="tile-title">{{ $title }}</h3>

            <!-- Error Messages -->

            @include('dashboard.includes._messages')


            <div class="tile-body">

                {!! Form::open(['route' => ['dashboard.comments.update',$comment->id]]) !!}

                @method('PUT')


                <div class="form-group">
                    {{ Form::textarea('content',$comment->content,['placeholder' => trans('dashboard.content'),'class'=> 'form-control ','autocomplete' => 'off']) }}
                </div>


                <div class="form-group">
                    {!! Form::label(trans('dashboard.post')) !!}
                    {!! Form::select('post_id',
                    \App\Models\Post::pluck('title','id'),
                    $comment->post_id,
                    ['class' => 'form-control','placeholder' => '....']
                    ) !!}
                </div>


                <div class="form-group">
                    {!! Form::label(trans('dashboard.user')) !!}
                    {!! Form::select('user_id',
                    \App\Models\User::pluck('name','id'),
                    $comment->user_id,
                    ['class' => 'form-control','placeholder' => '....']
                    ) !!}
                </div>











                <div class="tile-footer">
                    <button class="btn btn-primary" type="submit"><i
                            class="fa fa-fw fa-lg fa-check-circle"></i>{{ trans('dashboard.save') }}</button>&nbsp;&nbsp;&nbsp;
                    <a class="btn btn-secondary" href="{{ route('dashboard.comments.index') }}"><i
                            class="fa fa-fw fa-lg fa-times-circle"></i>{{ trans('dashboard.cancel') }}</a>
                </div>


                {!! Form::close() !!}

            </div>

        </div>

    </div>

</div>

@endsection