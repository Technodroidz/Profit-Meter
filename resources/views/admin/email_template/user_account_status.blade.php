<link rel="stylesheet" href="{{asset('business_app')}}/css/bootstrap.min.css" />

<div class="container">
     <div class="row justify-content-center">
         <div class="col-md-8">
             <div class="card">
             <div class="card-"> Hey {{$userData['name']}} ,</div>
                   <div class="card-body">
                   <?php 
                   if($userData['status']==1){
                       $status="Active";
                   }
                   else{
                   $status="Inactive";
                   }
                  ?>
                   Thanks for trying Profit Meter. I'm Idriss Tiam, President of Profit Meter, and I noticed you recently {{$status}} your account.
                 
                    We love your feedback and are more than happy to develope new features to make Profit Meter a better fit for your business.
                    Hit reply and let me know what’s on your mind.
                    <br>
                    Thanks!
                    Idriss (Founder/Owner of  <a href="{{url('')}}">Profit Meter</a>)
                    
                </div>
           
        </div>
    </div>
</div>
