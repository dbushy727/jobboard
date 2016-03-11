@extends('layout')

@section('content')
<h2>Jobs</h2>
<div class="jobs">
    <table class="table table-striped">
        <thead>
            <th>Location</th>
            <th>Company</th>
            <th>Title</th>
            <th>Date</th>
        </thead>
        <tbody>
            @foreach($jobs as $job)
            <tr>
                <td>{{ $job->location }}</td>
                <td>{{ $job->company_name }}</td>
                <td>{{ $job->title}}</td>
                <td>{{ $job->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection