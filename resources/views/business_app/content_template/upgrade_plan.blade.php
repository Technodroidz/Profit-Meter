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
                 <h3 class="mb-0" >Plans <a class="white_btn mb_10" data-toggle="modal" data-target="#confirm-mail">Learn</a></h3>
              </div>
           </div>
           <hr>
           <div class="white_card pad-16 br-16 mt_30 mb_30">
              <h4>Upgrade Your Plan</h4>
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
                                        
                  @foreach ($subscription_plans as $plan)
                    <div class="col-md-6 col-xs-6 col-sm-4">
                      <h4 class="text-center">{{$plan->package_name}}</h4>
                      <br/>
                      <div class="row">
                        <div class="col-md-8 col-xs-8 form-group">
                          <div class="planCard">
                            <p class="planTitle">{{$plan->package_name}}</p>
                            <h2 class="planPrice">{{$plan->package_amount}}</h2>
                            <p class="prMonth">For {{$plan->package_duration}} days</p>
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
                            
                            <a href="#" class="crntPlan">Upgrade Plan </a>
                          </div>
                        </div>
             
                      </div>
                      
                    </div>
                  @endforeach
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