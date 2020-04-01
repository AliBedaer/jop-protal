<div class="col-md-6 col-lg-3">
    <div class="single_candidates text-center">
        <div class="thumb">
            <img src="{{ $seeker->imagePath }}" alt="{{ $seeker->name }}">
        </div>
        <a href="{{ route('seekers.show', ['id' => $seeker->id,'slug' => str_slug($seeker->name)]) }}">
            <h4>{{ $seeker->name }}</h4>
        </a>
        <p>{{ $seeker->profile->position }}</p>
    </div>
</div>