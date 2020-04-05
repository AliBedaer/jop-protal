@extends('layouts.frontend.app')



@section('title',$job->title)





@section('content')


@include('frontend.includes._bradcam',['title' => $job->title])

<div class="job_details_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="job_details_header">
                    <div class="single_jobs white-bg d-flex justify-content-between">
                        <div class="jobs_left d-flex align-items-center">
                            <div class="thumb">
                                <img class="img-fluid" src="{{ $job->imagePath }}" alt="">
                            </div>
                            <div class="jobs_conetent">
                                <a href="#">
                                    <h4>{{ $job->title }}</h4>
                                </a>
                                <div class="links_locat d-flex align-items-center">
                                    <div class="location">
                                        <p> <i class="fa fa-map-marker"></i>{{ $job->country->name }}</p>
                                    </div>
                                    <div class="location">
                                        <p> <i class="fa fa-clock-o"></i> {{ $job->type->name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="jobs_right">
                            <div class="apply_now">
                                @role('seeker')

                                <a data-url="{{ route('jobs.show',$job->slug) }}"
                                    class="heart_mark {{ auth()->user()->hasSavedJob($job) ? 'bg-green' : '' }}"
                                    href="{{ route('jobs.save',$job->slug) }}"> <i class="ti-heart"></i> </a>

                                <a data-url="{{ route('jobs.apply',$job->slug) }}"
                                    href="{{ route('jobs.apply',$job->slug) }}"
                                    class="boxed-btn3 apply_job {{ auth()->user()->hasAppliedJob($job) ? 'bg-blue' :''  }}">
                                    {{ auth()->user()->hasAppliedJob($job) ? 'Applied' : 'Apply Now' }}
                                </a>

                                @endrole
                                @hasRoleAndOwns('company',$job)
                                <a href="{{ route('jobs.edit',$job->id) }}" class="btn">
                                    <i class="fa fa-edit fa-2x text-primary"></i>
                                </a>
                                <form class="d-inline-block" method="POST"
                                    action="{{ route('jobs.destroy',$job->id) }}">
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn confirm">
                                        <i class="fa fa-trash fa-2x text-danger"></i>
                                    </a>
                                </form>
                                @endOwns

                            </div>
                        </div>
                    </div>
                </div>
                <div class="descript_wrap white-bg">
                    <div class="single_wrap">
                        {!! $job->description !!}
                    </div>
                </div>

                @hasRoleAndOwns('company',$job)

                <div class="my-5 white-bg mx-auto">
                    <h2 class="text-center p-2">Applicants</h2>
                    <table class="table table-borderd">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Seeker</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>

                        @foreach( $job->applicants as $seeker )

                        <tbody>

                            <tr>

                                <th scope="row">{{ $seeker->id }}</th>
                                <td><a href="#">{{ $seeker->name }}</a></td>
                                <td>
                                    <a data-url="{{ route('companies.cancel',['job' => $job->id,'seeker' => $seeker->id,'company' => $job->user->id]) }}"
                                        href="{{ route('companies.cancel',['job' => $job->id,'seeker' => $seeker->id,'company' => $job->user->id]) }}"
                                        class="btn btn-danger text-white cancel">
                                        <i class="fa fa-trash"></i>
                                        Cancel
                                    </a>
                                </td>

                            </tr>

                        </tbody>

                        @endforeach

                    </table>
                </div>

                @endOwns




            </div>
            <div class="col-lg-4">
                <div class="job_sumary">
                    <div class="summery_header">
                        <h3>Job Summery</h3>
                    </div>
                    <div class="job_content">
                        <ul>
                            <li>Published on: <span>{{ $job->created_at->format('d M, Y') }}</span></li>
                            <li>Company: <span>{{ $job->user->name }}</span></li>
                            <li>Salary: <span>{{ $job->salary }} ($)</span></li>
                            <li>Location: <span>{{ $job->country->name }}</span></li>
                            <li>Job Nature: <span> {{ $job->type->name }}</span></li>
                        </ul>
                    </div>
                </div>

                <div class="job_sumary mt-4">
                    <div class="summery_header">
                        <h3>Related Jobs</h3>
                    </div>
                    <div class="job_content">
                        <ul>
                            @forelse( $r_jobs as $job )
                            <li>
                                <a href="{{ $job->showUrl }}">{{ $job->title }}</a> at <a
                                    href="#">{{ $job->country->name }}</a>
                            </li>
                            @empty
                            <p>No related jobs for now</p>
                            @endforelse
                        </ul>
                    </div>
                </div>


                <div class="job_sumary mt-4">
                    <div class="summery_header">
                        <h3>Skills</h3>
                    </div>
                    <div class="job_content">
                        @foreach($job->skills as $skill)
                        <a href="{{ route('skills.show',$skill->slug) }}">
                            <span class="badge badge-success">
                                <i class="fa fa-bolt"></i>
                                {{ $skill->name }}
                            </span>
                        </a>
                        @endforeach
                    </div>
                </div>


                <div class="job_sumary mt-4">
                    <div class="summery_header">
                        <h3>Tags</h3>
                    </div>
                    <div class="job_content">
                        @foreach($job->tags as $tag)
                        <a href="{{ route('tags.jobs.show',$tag->slug) }}">
                            <span class="badge badge-primary">
                                <i class="fa fa-tag"></i>
                                {{ $tag->name }}
                            </span>
                        </a>
                        @endforeach
                    </div>
                </div>



                <div class="share_wrap d-flex">
                    <span>Share:</span>
                    {!!

                    Share::currentPage()
                    ->facebook()
                    ->twitter()
                    ->linkedin('description')
                    ->whatsapp()

                    !!}
                </div>
            </div>
        </div>
    </div>
</div>









@endsection



@push('js')

<script src="{{ asset('js/share.js') }}"></script>


@endpush