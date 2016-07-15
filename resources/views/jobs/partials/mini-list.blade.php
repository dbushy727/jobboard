@if($jobs->count())
    <div class="list-group tight">
        <li class="list-group-item text-center">Recently Listed</li>
        @foreach($jobs as $job)
            <a href="/jobs/{{$job->id}}" class="list-group-item {{ $job->is_featured ? 'featured' : ''}}" >
                <div>{{$job->title}} at {{$job->company_name}}</div>
                <div class="small">{{ $job->location }}</div>
            </a>
        @endforeach
    </div>
@endif