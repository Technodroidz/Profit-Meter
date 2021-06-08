<html>
<head>
	<meta charset="utf-8">
	<title>How to integrate paypal payment in Laravel - websolutionstuff.com</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
    <div class="row">    	
    <div class="container">
  <div class="row">
   <div class="col-md-8 col-md-offset-2">

    @if (Session::has('message'))
     <div class="alert alert-{{ Session::get('code') }}">
      <p>{{ Session::get('message') }}</p>
     </div>
    @endif

    <div class="panel panel-default">
     <div class="panel-heading">Express checkout</div>
     <div class="panel-body">
      Pay $20 via:
      <a href="{{ route('paypal.express-checkout') }}" class='btn-info btn'>PayPal</a>
     </div>
    </div>
   
    <div class="panel panel-default">
     <div class="panel-heading">Recurring payments</div>
     <div class="panel-body">
      Pay $20/month:
      <a href="{{ route('paypal.express-checkout', ['recurring' => true]) }}" class='btn-info btn'>PayPal</a>
     </div>
    </div>

   </div>
  </div>
 </div>
    </div>
</div>
</body>
</html>