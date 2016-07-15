@if($jobs->count())
    <div class="list-group tight">
        <li class="list-group-item text-center">Recent Jobs</li>
        @foreach($jobs as $job)
            <a href="/jobs/{{$job->slug}}" class="list-group-item {{ $job->is_featured ? 'featured' : ''}}" >
                <div>{{$job->title}}</div>
                <div class="small">{{ $job->location }}</div>
            </a>
        @endforeach
    </div>
@endif