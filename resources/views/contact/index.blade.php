@extends('new_home')
@section('content')
    <h1 class="text-center">Contact Us</h1>
    <div class="text-center col-sm-6 col-md-offset-3">
      Thanks for your interest in {{env('APP_NAME')}}. Please
      use this form to send us a message and we'll get back
      to you as soon as possible.
    </div>

    <div class="panel panel-default col-sm-12 col-md-6 col-md-offset-3">
        <form
            action="/contact/submit"
            method="POST"
            class="contact-form">
            @if($errors->count())
            <h3 class="text-danger text-center">Oh no! Looks like something went wrong.</h3>
            @endif
          <div class="form-group">
            <label for="name">Name*</label>
            @foreach($errors->get('name') as $error)
              <div class="text-danger">{{ $error }}</div>
            @endforeach
            <input type="text" class="form-control" id="name" name="name">
          </div>
          <div class="form-group">
            <label for="email">Email address*</label>
            @foreach($errors->get('email') as $error)
              <div class="text-danger">{{ $error }}</div>
            @endforeach
            <input type="text" class="form-control" id="email" name="email">
          </div>
          <div class="form-group">
            <label for="message">Message*</label>
            @foreach($errors->get('body') as $error)
              <div class="text-danger">{{ $error }}</div>
            @endforeach
            <textarea class="form-control" rows="3" name="body"></textarea>
          </div>
          {{ csrf_field() }}
          <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>

@endsection