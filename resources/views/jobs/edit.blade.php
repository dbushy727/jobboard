@extends('layout')

@section('content')
    <div class="container">
        @include('welcome')
        <div class="job tight">
            <h2>Post a Job</h2>
            <div class="panel panel-default">
                <div class="panel-body">
                    @if($job->is_active)
                        <form action="/jobs" method="POST" name="editJob" id="editJob" enctype="multipart/form-data">
                        <input type="input" name="replacement_id" class="hidden" value="{{$job->id}}">
                    @else
                        <form action="/jobs/{{$job->id}}/update" method="POST" name="editJob" id="editJob" enctype="multipart/form-data">
                    @endif
                        {!! csrf_field() !!}
                        <div class="form-group col-sm-12 text-right">* Required fields</div>
                        <div class="form-group col-sm-12">
                            <label for="title">Title*</label>
                            <input type="text" name="title" class="form-control" value="{{$job->title}}" required>
                            <span class="help-block">Example: "DevOps Engineer, Jenkins Genius, etc."</span>
                        </div>

                        <div class="form-group col-sm-6">
                            <img src="{{ env('S3_BASEPATH') . $job->logo}}" class="job-posting-logo-edit pull-right">
                            <label for="logo">Logo <span class="small">(100px wide)</span></label>
                            <input type="file" name="logo" id="logo" class="hidden">
                            <div class="upload-logo">
                                <button type="button" class="btn-sm btn btn-info"><label for="logo">Click to Upload</label></button>
                                <label id="uploadedFile"></label>
                            </div>
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="company_name">Company</label>
                            <input type="text" name="company_name" class="form-control" value="{{$job->company_name}}">
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="location">Location*</label>
                            <input type="text" name="location" class="form-control" value="{{$job->location}}" required>
                            <span class="help-block">Example: "New York, NY"</span>
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="url">URL</label>
                            <input type="text" name="url" class="form-control" value="{{$job->url}}">
                        </div>

                        <div class="form-group col-sm-12">
                            <div class="checkbox">
                                <label>
                                    @if($job->is_featured)
                                        <input type="checkbox" id="featured" name="featured" checked="checked">
                                    @else
                                        <input type="checkbox" id="featured" name="featured">
                                    @endif
                                    <b>Remote</b>
                                </label>
                            </div>
                            <span class="help-block">Work from anywhere</span>
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="description">Description*</label>
                            <textarea name="description" id="description-editor" cols="30" rows="10" class="form-control" required>{{$job->description}}</textarea>
                            <script>
                                CKEDITOR.replace( 'description-editor' );
                            </script>
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="application_method">How to apply*</label>
                            <input type="text" name="application_method" class="form-control" value="{{$job->application_method}}" required>
                            <span class="help-block">Example: Email your CV to jobs@example.com</span>
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="email">Email*</label>
                            <input type="email" name="email" class="form-control" value="{{$job->email}}" required>
                            <span class="help-block">Where you will receive your receipt</span>
                        </div>

                        <div class="form-group col-sm-12">
                            <hr>
                            <div class="checkbox">
                                <label>
                                    @if($job->is_featured)
                                        <input type="checkbox" id="featured" name="featured" checked="checked">
                                    @else
                                        <input type="checkbox" id="featured" name="featured">
                                    @endif
                                    <b>Featured</b>
                                </label>
                            </div>
                            <span class="help-block">For an extra $50, you can have your post highlighted and sitting at the top of the list.</span>
                        </div>

                        <div class="form-group col-sm-12">
                            <hr>
                            <input type="submit" class="btn btn-success pull-right btn-lg btn-block">
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

@endsection