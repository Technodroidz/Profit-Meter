@extends('business_app/common_template/main')

@section('content')
<style>
  @media (min-width:1500px) and (max-width:3000px){
      .planCard{
          height:100%;
      }
      .error{
        color: red;
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
                    <h4 class="text-center">Your Current Plan</h4>
                    <br/>
                    @if(!empty($paid_subscription))
                      <div class="row">
                        <div class="col-md-12 col-xs-12 form-group">
                          <div class="planCard">
                            <p class="planTitle">{{$paid_subscription->plan_name}}</p>
                            <h2 class="planPrice">${{$paid_subscription->plan_amount}}</h2>
                            <p class="prMonth">For {{$paid_subscription->plan_duration}} days</p>
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
                            
                            <a href="{{route('business_setting_upgrade_plan')}}" class="crntPlan">Upgrade Plan </a>
                          </div>
                        </div>
             
                      </div>
                    @else
                      <div class="row">
                        <div class="col-md-12 col-xs-12 form-group">
                          <div class="planCard">
                            <p class="planTitle">{{$trial_subscription->plan_name}}</p>
                            <h2 class="planPrice">${{$trial_subscription->plan_amount}}</h2>
                            <p class="prMonth">For {{$trial_subscription->plan_duration}} days</p>
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
                            
                            <a href="{{route('business_setting_upgrade_plan')}}" class="crntPlan">Upgrade Plan </a>
                          </div>
                        </div>
                      </div>
                    @endif
                  </div>
                </div>
             
           </div>
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