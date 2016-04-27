@if($jobs->count())
    <div class="list-group tight">
        @foreach($jobs as $job)
            <a href="/jobs/{{$job->id}}" class="list-group-item {{ $job->is_featured ? 'featured' : ''}}" >
                <div>{{$job->title}}</div>
                <div class="small">{{ $job->location }}</div>
            </a>
        @endforeach
    </div>
@endif