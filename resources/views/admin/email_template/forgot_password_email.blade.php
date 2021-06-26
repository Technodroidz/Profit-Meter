<link rel="stylesheet" href="{{asset('business_app')}}/css/bootstrap.min.css" />

<div class="container">
     <div class="row justify-content-center">
         <div class="col-md-8">
             <div class="card">
             @if(empty($password))
             <div class="card-header"> Your profile Updated successfully</div>
                   <div class="card-body">
                        Profit-Meter  login url is
                    <a href="{{url('business/login')}}">Click Here</a>.
                </div>
             @else
                 <div class="card-header"> Your Acount Passowrd Reset</div>
                   <div class="card-body">
                   {{-- @php
                  $getData  = $getSubscribData['0']['description'];
                  $sourceData = ["{email}", "{link}"];
                  $replaceData   = [$getInsertedData['email'], $getInsertedData['shopify_url']];
                  $orginalData = str_replace($sourceData, $replaceData, $getData);
                  @endphp
                 {!!  $orginalData !!} --}}
                   
                  <div class="alert alert-success" role="alert">
                        Your new password is {{$password}}  ; 
                    </div>
                        Profit-Meter  login url is
                    <a href="{{url('business/login')}}">Click Here</a>.
                </div>
            </div>
            @endif
        </div>
    </div>
</div>