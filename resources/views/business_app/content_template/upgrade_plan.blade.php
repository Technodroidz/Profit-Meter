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
                    <div class="row">                 
                      @foreach ($subscription_plans as $plan)

                        <div class="col-md-4 col-xs-4 col-sm-4">
                          <!-- <h4 class="text-center">{{$plan->package_name}}</h4> -->
                          <br/>
                          <div class="row">
                            <div class="col-md-12 col-xs-12 form-group">
                              <div class="planCard">
                                <p class="planTitle">{{$plan->package_name}}</p>
                                <h2 class="planPrice">${{$plan->package_amount}}</h2>
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
                                
                                @if($plan->subscription_active == true)
                                <a href="javascript:void(0);" class="crntPlan" disabled>Current Plan</a>
                                @else
                                <a href="javascript:void(0);" class="crntPlan upgrade_plan_btn" data-toggle="modal" data-target="#stripeModal" data-subscription_id = "{{$plan->id}}" data-subscription_cost="{{$plan->package_amount}}" data-subscription_name="{{$plan->package_name}}" >Upgrade Plan</a>
                                @endif
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
</div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLongTitle">Choose Your Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <p>Choose Your preferred payment to upgrade your plan.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" data-toggle="modal" data-target="#paypalModal">Pay With Paypal</button>
                <button type="button" class="btn btn-secondary pay_with_stripe" data-dismiss="modal" data-toggle="modal" data-target="#stripeModal" >Pay With Stripe</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade form_modal" id="stripeModal" tabindex="-1" role="dialog" aria-labelledby="stripeModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form role="subscribe_stripe_payment" action="{{ route('subscribe_stripe_payment') }}" method="post" id="stripe-payment-form">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle">Pay with Stripe</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-primary alert-dismissible fade show error_div" role="alert" style="display:none;">
                      <strong id="show_stripe_error" class="show_error_msg">Error</strong>
                      <button type="button" class="close dismiss_alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <!-- <p>Insert Your Card details</p> -->
                    <div class="card">
                        @csrf                    
                        <div class="form-group">
                            <div class="card-header">
                                <label for="card-element">
                                    Enter your credit card information
                                </label>
                            </div>
                            <div class="card-body">
                                <div id="card-element">
                                <!-- A Stripe Element will be inserted here. -->
                                </div>
                                <!-- Used to display form errors. -->
                                <div id="card-errors" role="alert"></div>
                                <input type="hidden" class="subscription_id" name="subscription_id" value="" >
                            </div>
                        </div>
                        <!-- <div class="card-footer">
                            <button class="btn btn-dark" type="submit">Pay</button>
                        </div> -->
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Plan Name</span>
                        </div>
                        <input name="subscription_name" type="text" class="form-control subscription_name" aria-describedby="basic-addon3" value="" readonly="readonly">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Cost($)</span>
                        </div>
                        <input name="subscription_cost" type="text" class="form-control subscription_cost" aria-describedby="basic-addon3" value="" readonly="readonly">
                    </div>

                </div>
                <div class="modal-footer">
                    <button id = "stripe_loader" class="btn btn-primary ajax_loader" type="button" disabled style="display: none;">
                      <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                      <span class="sr-only">Loading...</span>
                    </button>
                    <button type="button" class="btn btn-secondary disable_btn_class" id="generate_stripe_token" >Pay</button>
                    <button type="button" class="btn btn-secondary" data-request="web-ajax-submit" data-target="[role=subscribe_stripe_payment]" data-show_error="#show_stripe_error" style="display:none;" data-disable_element_class=".disable_btn_class" data-loader="#stripe_loader" >Pay</button>
                    <button type="button" class="btn btn-primary disable_btn_class" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade form_modal" id="paypalModal" tabindex="-1" role="dialog" aria-labelledby="paypalModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form role="subscribe_paypal_payment" action="{{ route('initiate_subscribe_stripe_payment') }}" method="post" id="payment-form">
                @csrf                    
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle">Pay with Paypal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-primary alert-dismissible fade show error_div" role="alert" style="display:none;">
                      <strong id="show_paypal_error" class="show_error_msg">Error</strong>
                      <button type="button" class="close dismiss_alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <!-- <p>Insert Your Card details</p> -->
                    
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Plan Name</span>
                        </div>
                        <input name="subscription_name" type="text" class="form-control subscription_name" aria-describedby="basic-addon3" value="" readonly="readonly">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Cost($)</span>
                        </div>
                        <input name="subscription_cost" type="text" class="form-control subscription_cost" aria-describedby="basic-addon3" value="" readonly="readonly">
                        <input type="hidden" class="subscription_id" name="subscription_id" value="" >
                    </div>
                    <p><strong>Click on "Initiate Payment" to pay with your paypal account.</strong></p>
                </div>
                <div class="modal-footer">
                    <button id = "paypal_loader" class="btn btn-primary ajax_loader" type="button" disabled style="display: none;">
                      <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                      <span class="sr-only">Loading...</span>
                    </button>
                    <button type="button" class="btn btn-secondary disable_btn_class" data-request="web-ajax-submit" data-target="[role=subscribe_paypal_payment]" data-show_error="#show_paypal_error" data-disable_element_class=".disable_btn_class" data-loader="#paypal_loader" >Initiate Payment</button>
                    <button type="button" class="btn btn-primary disable_btn_class" data-dismiss="modal">Close</button>
                </div>
            </form>
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

        $(document).on('click','.upgrade_plan_btn',function(){
            
            $('.subscription_id').val($(this).attr('data-subscription_id'));
            $('.subscription_cost').val($(this).attr('data-subscription_cost'));
            $('.subscription_name').val($(this).attr('data-subscription_name'));
        });

    </script>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        // Create a Stripe client.
        var stripe = Stripe('{{ env("STRIPE_KEY") }}');

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
          base: {
            color: '#32325d',
            lineHeight: '18px',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
              color: '#aab7c4'
            }
          },
          invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
          }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {style: style});

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function(event) {
          var displayError = document.getElementById('card-errors');
          if (event.error) {
            displayError.textContent = event.error.message;
          } else {
            displayError.textContent = '';
          }
        });

        // Handle form submission.
        var form = document.getElementById('stripe-payment-form');
        var pay_button = document.getElementById('generate_stripe_token');
        pay_button.addEventListener('click', function(event) {
          // event.preventDefault();

          stripe.createToken(card).then(function(result) {
            
            if (result.error) {
              // Inform the user if there was an error.
              var errorElement = document.getElementById('card-errors');
              errorElement.textContent = result.error.message;
            } else {
              // Send the token to your server.
              stripeTokenHandler(result.token);
            }
          });
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
          // Insert the token ID into the form so it gets submitted to the server
          var form = document.getElementById('stripe-payment-form');
          element = $('input[name="stripeToken"]');
          
            if (element.length > 0)
            {
                element.val(token.id);
            }else{
              var hiddenInput = document.createElement('input');
              hiddenInput.setAttribute('type', 'hidden');
              hiddenInput.setAttribute('name', 'stripeToken');
              hiddenInput.setAttribute('value', token.id);
              form.appendChild(hiddenInput);
            }
          $('#stripe-payment-form').find('[data-request="web-ajax-submit"]').trigger('click');
          // Submit the form
          // form.submit();
        }
    </script>

@endsection