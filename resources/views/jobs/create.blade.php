@extends('new_home')

@section('content')
    <div class="col-sm-12">
        <h2>Post a Job</h2>
    </div>
    <div class="col-sm-8">
        <div class="job tight">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="/posts" method="POST" name="createJob" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="form-group col-sm-12 text-right">* Required fields</div>
                        <div class="form-group col-sm-12">
                            <label for="title">Title*</label>
                            <input type="text" name="title" class="form-control" required>
                            <span class="help-block">Example: "DevOps Engineer, Jenkins Genius, etc."</span>
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="logo">Logo <span class="medium">(Square, 120x120px minimum)</span></label>
                            <input type="file" name="logo" id="logo" class="hidden">
                            <div class="upload-logo">
                                <button type="button" class="btn-sm btn btn-red"><label for="logo">Click to Upload</label></button>
                                <label class="uploadedFile"></label>
                            </div>
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="company_name">Company*</label>
                            <input type="text" name="company_name" class="form-control" required>
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="location">Location*</label>
                            <input type="text" name="location" class="form-control" required>
                            <span class="help-block">Example: "New York, NY"</span>
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="url">URL</label>
                            <input type="text" name="url" class="form-control">
                        </div>

                        <div class="form-group col-sm-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="1" id="is_remote" name="is_remote">
                                    <b>Remote</b>
                                </label>
                            </div>
                            <span class="help-block">Work from anywhere</span>
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="description">Description*</label>
                            <textarea name="description" id="description-editor" cols="30" rows="10" class="form-control" required></textarea>
                            <script>
                                CKEDITOR.replace( 'description-editor' );
                            </script>
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="application_method">How to apply*</label>
                            <input type="text" name="application_method" class="form-control" required>
                            <span class="help-block">Example: Email your CV to jobs@example.com</span>
                        </div>

                        <div class="form-group col-sm-12">
                            <hr>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="1" id="is_featured" name="is_featured">
                                    <b>Featured</b>
                                </label>
                            </div>
                            <span class="help-block">For an extra $50, you can have your post highlighted and keep it sitting at the top of the list.</span>
                        </div>

                        <div class="form-group col-sm-12">
                            <hr>
                            <input type="submit" class="btn btn-success btn-lg btn-block" value="Preview">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        @include('jobs.partials.explanation')
    </div>
@endsection