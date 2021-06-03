

@extends('front.layout.common')

@if ($errors->any())
    <div class="alert alert-danger hiddenError">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
<form method="POST" class="form-horizontal reding-form" id="addSocialIconsForm1" action="{{asset('submit-user-register')}}">
                @csrf

  <div class="container">
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>
    <label for="name"><b>Name</b></label>
    <input type="text" placeholder="Enter Name" value="{{old('name')}}" name="name" id="name" required>

    <label for="last_name"><b>Last Name</b></label>
    <input type="text" placeholder="Last name" value="{{old('last_name')}}" name="last_name" id="last_name" required>


    <label for="number"><b>Number</b></label>
    <input type="text" placeholder="number" value="{{old('number')}}" name="number" id="number" required>
    <hr>
    <label for="bussiness_name"><b>Bussiness Name</b></label>
    <input type="text" placeholder="Enter Business " value="{{old('bussiness_name')}}" name="bussiness_name" id="bussiness_name" required>

    <label for="psw"><b>Shofiy url</b></label>
    <input type="text" placeholder="Shofiy url" value="{{old('ur')}}" name="ur" id="psw" required>
    <hr>
    <hr>
    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" value="{{old('email')}}" name="email" id="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" id="password" required>

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="password_confirmation" id="password_confirmation" required>
    <hr>

    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
    <button type="submit" class="registerbtn">Register</button>
  </div>

  <div class="container signin">
    <p>Already have an account? <a href="#">Sign in</a>.</p>
  </div>
</form>
@section('custom_script')
  
@endsection

 
