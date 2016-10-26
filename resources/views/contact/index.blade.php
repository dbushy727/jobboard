@extends('new_home')
@section('content')
    <h1 class="text-center">Contact Form</h1>

    <div class="panel panel-default">
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
            <input type="text" class="form-control" id="name" placeholder="Johnny Doe" name="name">
          </div>
          <div class="form-group">
            <label for="email">Email address*</label>
            @foreach($errors->get('email') as $error)
              <div class="text-danger">{{ $error }}</div>
            @endforeach
            <input type="text" class="form-control" id="email" placeholder="email@example.com" name="email">
          </div>
          <div class="form-group">
            <label for="message">Message*</label>
            @foreach($errors->get('body') as $error)
              <div class="text-danger">{{ $error }}</div>
            @endforeach
            <textarea class="form-control" rows="3" placeholder="Site looks awesome!! I would love to learn more about {{env('APP_NAME')}}." name="body"></textarea>
          </div>
          {{ csrf_field() }}
          <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>

@endsection