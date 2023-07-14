@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <h1>Looking for an employee?</h1>
            <h3>Please create an account</h3>
            <img src="{{ asset('image/register.png') }}">
        </div>

        <div class="col-md-6">
            <div class="card" id="card">
                <div class="card-header">Employer Registration</div>
                <form action="#" method="post" id="registrationForm">
                @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Company name</label>
                            <input type="text" name="name" class="form-control" required>
                            @if($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control" required>
                            @if($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="text" name="password" class="form-control" required>
                            @if($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <br>
                        <div class="form-group">
                            <button class="btn btn-primary" id="btnRegister">Register</button>
                        </div>
                    </div>
                </form>
            </div>
            <div id="message"></div>
        </div>
    </div>
</div>

<script>
var url = "{{route('store.employer')}}";

$(document).ready(function() {
  $("#btnRegister").on("click", function(event) {
    event.preventDefault();
    var form = $("#registrationForm")[0];
    var card = $("#card");
    var messageDiv = $("#message");
    messageDiv.html('');
    var formData = new FormData(form);

    var button = $(this);
    button.prop("disabled", true);
    button.html('Sending email....');

    $.ajax({
      url: url,
      type: "POST",
      headers: {
        'X-CSRF-TOKEN': '{{csrf_token()}}'
      },
      data: formData,
      processData: false,
      contentType: false,
      success: function(data) {
        button.html('Register');
        button.prop("disabled", false);
        messageDiv.html('<div class="alert alert-success">Registration was successful. Please check your email to verify it</div>');
        card.css('display', 'none');
      },
      error: function(error) {
        button.html('Register');
        button.prop("disabled", false);
        messageDiv.html('<div class="alert alert-danger">Something went wrong. Please try again</div>');
      }
    });
  });
});

</script>

@endsection
