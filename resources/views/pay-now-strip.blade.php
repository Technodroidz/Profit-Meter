<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    </head>
    <body> 
        <form action="{{asset('charge')}}" method="POST">
        {{ csrf_field() }}
            <script
                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                    data-key="pk_test_51HuWQHJRRrJp7PIAIkuAgvuEWXj9CwiwwVl9YPSBPZIp87M0WTFZD8VuAFIhb3thCG0hF5mF6poVsmlt3IEiOftq00CKI0k6WY"
                    data-amount="1999"
                    data-name="Stripe Demo"
                    data-description="Online course about integrating Stripe"
                    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                    data-locale="auto"
                    data-currency="usd">
            </script>
        </form>
    </body>
</html>