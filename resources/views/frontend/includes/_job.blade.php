<!-- Single Job -->
             <div class="col-lg-12 col-md-12">
                                <div class="single_jobs white-bg d-flex justify-content-between">
                                    <div class="jobs_left d-flex align-items-center">
                                        <div class="thumb">
                                            <img class="img-fluid" src="{{ $job->imagepath }}" alt="">
                                        </div>
                                        <div class="jobs_conetent">
                                            <a href="{{ $job->showUrl }}"><h4>{{ $job->title }}</h4></a>
                                            <div class="links_locat d-flex align-items-center">
                                                <div class="location">
                                                    <p> <i class="fa fa-map-marker"></i> {{ $job->country->name }}</p>
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
                                            <a class="heart_mark {{ auth()->user()->hasSavedJob($job) ? 'bg-green' : ''  }}" data-url="{{ route('jobs.show',$job->slug) }}" href="{{ route('jobs.save',$job->slug) }}"> <i class="fa fa-heart"></i> </a>
                                            <a data-url="{{ route('jobs.apply',$job->slug) }}" href="{{ route('jobs.apply',$job->slug) }}" class="boxed-btn3 apply_job {{ auth()->user()->hasAppliedJob($job) ? 'bg-blue' :''  }}">
                                                {{ auth()->user()->hasAppliedJob($job) ? 'Applied' : 'Apply Now' }}
                                            </a>
                                            @endrole

                                            @hasRoleAndOwns('company',$job)
                                            <a href="{{ route('jobs.edit',$job->id) }}" class="btn">
                                                <i class="fa fa-edit fa-2x text-primary"></i>
                                            </a>
                                            <form class="d-inline-block" method="POST" action="{{ route('jobs.destroy',$job->id) }}">
                                                @method('DELETE')
                                                @csrf
                                            <a class="btn confirm">
                                                <i class="fa fa-trash fa-2x text-danger"></i>
                                            </a>
                                           </form>
                                            @endOwns
                                        </div>
                                        <div class="date">
                                            <p>{{ $job->created_at }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            

                            

                           <!-- Single Job End-->


          
