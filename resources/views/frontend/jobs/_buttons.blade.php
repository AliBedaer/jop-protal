 <form class="save_job d-inline-block" method="POST" action="{{ route('jobs.save',$job->slug) }}">
     <a class="heart_mark {{ auth()->user()->hasSavedJob($job) ? 'bg-green' : ''  }}" href="#"> <i
             class="fa fa-heart"></i> </a>
 </form>
 <form class="d-inline-block" method="POST" action="{{ route('jobs.apply',$job->slug) }}">
     <a href="#" class="boxed-btn3 apply_job {{ auth()->user()->hasAppliedJob($job) ? 'bg-blue' :''  }}">
         {{ auth()->user()->hasAppliedJob($job) ? 'Applied' : 'Apply Now' }}
     </a>
 </form>