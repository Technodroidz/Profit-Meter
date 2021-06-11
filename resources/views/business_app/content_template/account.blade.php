@extends('business_app/common_template/main')

@section('content')
<style>
  @media (min-width:1500px) and (max-width:3000px){
      .planCard{
          height:100%;
      }
  }
</style>

<div class="container-fluid p-0 ">
         <!-- page title  -->
    <div class="row">
        <div class="col-12 col-md-12">
           <div class="page_title_box ">
              <div class="page_title_left">
                 <h3 class="mb-0" >Account Settings <a class="white_btn mb_10" data-toggle="modal" data-target="#confirm-mail">Learn</a></h3>
              </div>
           </div>
           <hr>
           <div class="white_card pad-16 br-16 mt_30 mb_30">
              <h4>Your profile</h4>
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
              <br>
              <form action="{{asset('user-profile-update')}}" method="POST" id="userFormValidation" enctype='multipart/form-data'>
                                                       @csrf
                <div class="row">
                  <div class="col-md-6 col-xs-12">
                    <div class="row">
                      <div class="col-md-6 form-group">
                        <label>First name</label>
                        <input type="text" name="firstname" value="{{@$getUserData['name']}}" class="form-control" placeholder="First Name">
                      </div>
                      <div class="col-md-6 form-group">
                        <label>Last name</label>
                        <input type="text" name="lastname"  value="{{@$getUserData['last_name']}}" class="form-control" placeholder="Last Name">
                      </div>
                      <div class="col-md-12 form-group">
                        <label>Email address</label>
                        <input type="email" name="email"  value="{{@$getUserData['email']}}" class="form-control" placeholder="example@gmail.com">
                      </div>
                      <div class="col-md-12 form-group">
                        <label>Phone number</label>
                        <input type="text" name="phone"  value="{{@$getUserData['number']}}" class="form-control" placeholder="+918754632514">
                      </div>
                      <div class="col-md-12 form-group">
                        <label>Company name</label>
                        <input type="text" name="company" id ="company" value="{{@$getUserData['company']}}" class="form-control" placeholder="Company Name">
                      </div>
                      <div class="col-md-12 form-group">
                        <label>What industry do you work in?</label>
                        <select class="form-control" name="company_type">
                          <option>Please select</option>
                          <option>Company 1</option>
                          <option>Company 2</option>
                          <option>Company 3</option>
                          <option>Company 4</option>
                        </select>
                      </div>
                      <div class="col-md-12 form-group">
                        <label>Image</label>
                        <input type="file" name="profile_pick"  value="{{@$getUserData['profile_pick']}}" >
                        &nbsp; &nbsp; &nbsp; &nbsp; <input type="hidden" class="form-control" value="{{@$getUserData['id']}}" name="id" id="id">
                            @if(!empty($getUserData['profile_pick']))
                            <img src="{{asset('images/'.$getUserData['profile_pick'])}}" class="img-circle" hight="120px" width="100px" alt="User Image">
                            @else
                            <img src="{{asset('')}}admin/dist/img/user2-160x160.jpg" class="img-circle " alt="User Image">
                            @endif
                      </div>
                      <div class="col-md-12 form-group">
                        <button class="updateProfile">Update Profile</button>
                      </div>                        
                    </div>  
                    </form>
                      <br/>
                      <br/>                        
                    <h4>Change Password</h4>
                   
                    <form action="{{asset('user-password-update')}}" method="POST" id="userFormValidationPassword" enctype='multipart/form-data'>
                     @csrf
                     <div class="row">
                      <div class="col-md-6 col-xs-12 form-group">
                        <label>Old password</label>
                        <input type="password" name="current_password" value="" class="form-control" placeholder="Old password">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-xs-12 form-group">
                        <label>New password</label>
                        <input type="password" name="new_password" value="" class="form-control" placeholder="Old password">
                      </div>
                      <div class="col-md-6 col-xs-12 form-group">
                        <label>Confirm password</label>
                        <input type="password" name="new_confirm_password" value="" class="form-control" placeholder="Confirm password">
                      </div>
                      <div class="col-md-12 form-group">
                        <button class="updateProfile">Update Password</button>
                      </div>
                    </div>
                  </div>
                  </form>
                  <div class="col-md-6 col-xs-12">
                    <h4 class="text-center">Your Plan</h4>
                    <br/>
                    <div class="row">
                      <div class="col-md-12 col-xs-12 form-group">
                        <div class="planCard">
                          <p class="planTitle">BASIC</p>
                          <h2 class="planPrice">$9</h2>
                          <p class="prMonth">per month</p>
                          <h4>Unlimited history data:</h4>
                          <ul>
                            <li>
                              <span class="iconRight"><i class="fas fa-check"></i></span>
                              <span class="textPlan">Profit Dashboard</span>
                            </li>
                            <li>
                              <span class="iconRight"><i class="fas fa-check"></i></span>
                              <span class="textPlan">Simulate Your Potential Revenue and Profit</span>
                            </li>
                            <li>
                              <span class="iconRight"><i class="fas fa-check"></i></span>
                              <span class="textPlan"> Pull your spending from Facebook, Google Ads and Snapchat</span>
                            </li>
                            <li>
                              <span class="iconRight"><i class="fas fa-check"></i></span>
                              <span class="textPlan"> Import your Disputes data from Stripe and PayPal</span>
                            </li>
                            <li>
                              <span class="iconRight"><i class="fas fa-check"></i></span>
                              <span class="textPlan"> Track all your Expenses</span>
                            </li>
                            <li>
                              <span class="iconRight"><i class="fas fa-check"></i></span>
                              <span class="textPlan"> Self-serve knowledge base</span>
                            </li>
                            <li>
                              <span class="iconRight"><i class="fas fa-check"></i></span>
                              <span class="textPlan"> Lifetime Value Analysis</span>
                            </li>
                            <li>
                              <span class="iconRight"><i class="fas fa-check"></i></span>
                              <span class="textPlan">Priority 7/7 support</span>
                            </li>
                          </ul>
                          <a href="#" class="crntPlan">Current plan</a>
                        </div>
                      </div>
           
                    </div>
                    
                  </div>
                </div>
             
           </div>
        </div>
    </div>
</div>

<div id="confirm-mail" class="modal" role="dialog">
    <div class="modal-dialog">
        <div class="login-card card-block login-card-modal">
            <form class="md-float-material">
                <div class="text-center">
                    <img src="img\logo.png" alt="logo.png">
                </div>
                <div class="card m-t-15">
                    <div class="auth-box card-block">
                        <div class="row m-b-20">
                            <div class="col-md-12 confirm">
                                <h3 class="text-center txt-primary"><i class="icofont icofont-check-circled text-primary"></i>
                                    Confirmation</h3>
                            </div>
                        </div>
                        <p class="text-inverse text-left m-t-15 f-16"><b>Dear
                                Username</p>
                        <p class="text-inverse text-left m-b-0">Welcome to our
                            website. Really Exciting to have you here!</p>
                        <p class="text-inverse text-left m-b-20">Please click the
                            link below to verify that this is your email address.
                        </p>
                        <p class="text-inverse text-left m-b-30">Thank you and enjoy
                            our website.</p>
                    </div>
                </div>
            </form>
            <!-- end of form -->
        </div>
    </div>
</div>

@endsection

@section('script')

    <script>
        $(document).ready(function () { 
                $('form#userFormValidation').validate({
                    rules: {
                      firstname: {
                            required: true,
                        },
                      
                        phone: {
                            required: true,
                            maxlength:16,
                            minlength:7,
                            number:true,
                        },
                        lastname: {
                            required: true,
                        },
                       
                        email:{
                            required: true,
                          
                         },
                        company_type:{
                            required: true,
                        },
                        company:{
                            required: true,
                        }
                      
                
                    },
                    messages: {
                        name: {
                            required: 'This field is required',
                        },
                        email: {
                            required: 'This field is required',
                        },
                        phone: {
                            required: 'This field is required ',
                        },
                        lastname: {
                            required: 'This field is required ',
                        },
                     
                        company_type: {
                            required: 'This field is required ',
                        },
                        company: {
                            required: 'This field is required ',
                        },
                    
                    },
                    
                });

               
      


                $('form#userFormValidationPassword').validate({
                  rules: {
                    current_password: {
                            required: true,
                            minlength:6,
                        },


                        new_password: {
                            required: true,
                            minlength:6,
                        },
                       
                      
                        new_confirm_password:{
                            required: true,
                            minlength:6,
                          
                         },
                        
                      
                
                    },
                    messages: {
                      current_password: {
                            required: 'This field is required',
                        },
                        new_password: {
                            required: 'This field is required',
                        },
                        new_confirm_password: {
                            required: 'This field is required ',
                        },
                   
                     
                 
                    
                    },
                    
                });

               
            });
    </script>
@endsection