

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
<form method="POST" class="form-horizontal reding-form" id="addSocialIconsForm1" action="{{asset('report-submit')}}">
                @csrf

  <div class="container">
    <h1>Add Report </h1>
    <p>Please fill in this form to create an account.</p>
    <hr>
    <label for="name"><b>Name</b></label>
    <input type="text" placeholder="Enter Name" value="{{old('first_name')}}" name="first_name" id="first_name" required>

    <label for="last_name"><b>Last Name</b></label>
    <input type="text" placeholder="Last name" value="{{old('last_name')}}" name="last_name" id="last_name" required>


    <label for="number"><b>Number</b></label>
    <input type="text" placeholder="Number" value="{{old('contact')}}" name="contact" id="contact" required>
    <hr>
    <label for="plan_name"><b>Plan Name</b></label>
    <input type="text" placeholder="Plan Name" value="{{old('plan_name')}}" name="plan_name" id="bussiness_name" required>

    <label for="psw"><b>Plan Duration</b></label>
    <input type="text" placeholder="Plan Duration" value="{{old('plan_duration')}}" name="plan_duration" id="psw" required>
    <label for="psw"><b>Plan Amount</b></label>
    <input type="text" placeholder="Plan Amount" value="{{old('plan_amount')}}" name="plan_amount" id="plan_amount" required>
    <hr>
 
    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" value="{{old('email')}}" name="email" id="email" required>
    <label for="email"><b>Start Plan Date</b></label>
    <input type="date" placeholder="Enter Email" value="{{old('creation_date')}}" name="creation_date" id="creation_date" required>
    <label for="email"><b>End Plan Date</b></label>
    <input type="date" placeholder="Enter Email" value="{{old('expiry_date')}}" name="expiry_date" id="expiry_date" required>

    <hr>

    <button type="submit" class="registerbtn">Add Report</button>
  </div>

</form>
@section('custom_script')
  
@endsection

 
