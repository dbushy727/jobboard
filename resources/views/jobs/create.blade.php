@extends('layout')

@section('content')
<div class="job">
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="/jobs" method="POST" name="createJob">
                <div class="form-group col-sm-12">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control">
                    <span class="help-block">Example: "DevOps Engineer, Senior Keyboard Jockey, Jenkins Genius, etc."</span>
                </div>

                <div class="form-group col-sm-6">
                    <label for="logo">Logo <small>(100px wide)</small></label>
                    <input type="file" name="logo" id="logo">
                </div>

                <div class="form-group col-sm-6">
                    <label for="company_name">Company</label>
                    <input type="text" name="company_name" class="form-control">
                </div>

                <div class="form-group col-sm-6">
                    <label for="location">Location</label>
                    <input type="text" name="location" class="form-control">
                    <span class="help-block">Example: "New York, NY"</span>
                </div>

                <div class="form-group col-sm-6">
                    <label for="url">URL</label>
                    <input type="text" name="url" class="form-control">
                </div>

                <div class="form-group col-sm-12">
                    <label for="description">Description</label>
                    <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
                </div>

                <div class="form-group col-sm-12">
                    <label for="application_method">How to apply</label>
                    <input type="text" name="application_method" class="form-control">
                    <span class="help-block">Example: Email your CV at jobs@example.com</span>
                </div>

                <div class="form-group col-sm-12">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control">
                    <span class="help-block">Where you will receive your receipt.</span>
                </div>

                <div class="form-group col-sm-12">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="featured" name="featured">
                            <b>Featured</b>
                        </label>
                    </div>
                    <span class="help-block">For an extra $50, you can have your post highlighted and sitting at the top of the list.</span>
                </div>

                <div class="form-group col-sm-12">
                    <input type="submit" class="btn btn-success pull-right">
                </div>

            </form>
        </div>
    </div>

</div>

@endsection