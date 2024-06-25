@extends('layouts.front-app')
@section('content')
<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:weight@100;200;300;400;500;600;700;800&display=swap");
    .card{
        border: none;
    }
    .card-header {
        padding: .5rem 1rem;
        margin-bottom: 0;
        background-color: rgba(0,0,0,.03);
        border-bottom: none;
    }
    .btn-light:focus {
        color: #212529;
        background-color: #e2e6ea;
        border-color: #dae0e5;
        box-shadow: 0 0 0 0.2rem rgba(216,217,219,.5);
    }
    .form-control{
        height: 50px;
        border: 2px solid #eee;
        border-radius: 6px;
        font-size: 14px;
    }
    .form-control:focus {
        color: #495057;
        background-color: #fff;
        border-color: #039be5;
        outline: 0;
        box-shadow: none;
    }

    .input{
        position: relative;
    }
    .input i{
        position: absolute;
        top: 16px;
        left: 11px;
        color: #989898;
    }

    .input input{
        text-indent: 25px;
    }
    .card-text{
        font-size: 13px;
        margin-left: 6px;
    }
    .certificate-text{
        font-size: 12px;
    }
    .billing{
        font-size: 11px;
    }  
    .super-price{
        top: 0px;
        font-size: 22px;
    }
    .super-month{
        font-size: 11px;
    }
    .line{
        color: #bfbdbd;
    }
    .free-button{
        background: #1565c0;
        height: 52px;
        font-size: 15px;
        border-radius: 8px;
    }
    .payment-card-body{
        flex: 1 1 auto;
        padding: 24px 1rem !important;
    }
    .mt-5 {
        margin-top: 0 !important;
    }
    .pay-btn{
        width: 100%;
    }
    .submit-button {
        margin-top: 10px;
    }
    .stripe-form {
        padding: 30px;
        height: 120px;
        margin-bottom: 20px;
        margin-left: auto;
        margin-right: auto;
        width: 600px;
    }

    label {
        font-weight: 500;
        font-size: 14px;
        display: block;
        margin-bottom: 8px;
    }

    #card-errors {
        height: 20px;
        padding: 4px 0;
        color: #fa755a;
    }

    .token {
        color: #32325d;
        font-family: 'Source Code Pro', monospace;
        font-weight: 500;
    }

    .wrapper {
        width: 90%;
        margin: 0 auto;
        height: 100%;
    }

    #stripe-token-handler {
        position: absolute;
        top: 0;
        left: 25%;
        right: 25%;
        padding: 20px 30px;
        border-radius: 0 0 4px 4px;
        box-sizing: border-box;
        box-shadow: 0 50px 100px rgba(50, 50, 93, 0.1),
            0 15px 35px rgba(50, 50, 93, 0.15),
            0 5px 15px rgba(0, 0, 0, 0.1);
        -webkit-transition: all 500ms ease-in-out;
        transition: all 500ms ease-in-out;
        transform: translateY(0);
        opacity: 1;
        background-color: white;
    }

    #stripe-token-handler.is-hidden {
        opacity: 0;
        transform: translateY(-80px);
    }

    .form-row-stripe {
        width: 70%;
        height: 100px;
        float: left;
    }

    #card-element {
        background-color: white;
        width: 400px;
        height: 38px;
        padding: 10px 12px;
        border-radius: 4px;
        border: 1px solid transparent;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }

    .btn-Stripe {
        border: none;
        border-radius: 4px;
        outline: none;
        text-decoration: none;
        color: #fff;
        background: #32325d;
        white-space: nowrap;
        display: inline-block;
        height: 40px;
        line-height: 40px;
        padding: 0 14px;
        box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08);
        border-radius: 4px;
        font-size: 15px;
        font-weight: 600;
        letter-spacing: 0.025em;
        text-decoration: none;
        -webkit-transition: all 150ms ease;
        transition: all 150ms ease;
        float: left;
        margin-left: 12px;
        margin-top: 28px;
    }

    .btn-Stripe:hover {
        transform: translateY(-1px);
        box-shadow: 0 7px 14px rgba(50, 50, 93, .10), 0 3px 6px rgba(0, 0, 0, .08);
        background-color: #43458b;
    }

    #card-element--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }

    #card-element--invalid {
        border-color: #fa755a;
    }

    #card-element--webkit-autofill {
        background-color: #fefde5 !important;
    }

    #paypal-button-container {
        position: absolute;
        top: 80%;
        left: 50%;
        margin-top: -20px;
        margin-left: -75px;
    }
    #collapseTwo{
        height: 50px;
    }
    .errorMessage{
        display: none;
    }
    .successMessage{
        display: none;
    }
</style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">   
    <script src="https://www.paypalobjects.com/api/checkout.js"></script> 

<div style="background: #13C5DD" class="container-fluid py-5">
   <div class="container">
    @if(Session::has('message'))
        <div class="alert alert-{{session('message')['type']}}">
            {{session('message')['text']}}
        </div>
    @endif
    @if (count($errors) > 0)
        <div class = "alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="d-flex justify-content-center align-items-center">
        <div class="row g-3">
            <div class="col-md-12">
               <div class="card">
                <div class="alert alert-danger errorMessage">
                </div>
                <div class="alert alert-success successMessage">
                </div>
                    <div class="card-body payment-card-body">
                        <form>
                            <div class="mb-3">
                                <label for="fullName" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Enter your full name">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                            </div>
                            <div class="mb-3">
                                <label for="text" class="form-label">Amount</label>
                                <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter your amount">
                            </div>
                            <div class="mb-3">
                                <label for="invoice_number" class="form-label">Invoice Number</label>
                                <input type="text" class="form-control" id="invoice_number" name="invoice_number" placeholder="Enter your Invoice Number">
                            </div>
                        </form>
                     </div>
               </div>
            </div>
            <div class="col-md-12">
               <div class="card">
                  <div class="accordion" id="accordionExample">
                     <div class="card">
                        <div class="card-header p-0" id="headingTwo">
                           <h2 class="mb-0">
                              <button class="pay-btn btn btn-light btn-block text-left collapsed p-3 rounded-0 border-bottom-custom" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                 <div class="d-flex align-items-center justify-content-between">
                                    <span>Paypal</span>
                                    <img src="{{ asset('icons/paypal.png') }}" width="30">
                                 </div>
                              </button>
                           </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                           <div class="card-body">
                                <div id="paypal-button-container"></div>
                           </div>
                        </div>
                     </div>
                     <div class="card">
                        <div class="card-header p-0">
                           <h2 class="mb-0">
                              <button class="pay-btn btn btn-light btn-block text-left p-3 rounded-0" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                 <div class="d-flex align-items-center justify-content-between">
                                    <span>Credit card</span>
                                    <div class="icons">
                                       <img src="{{ asset('icons/s1.png') }}" width="30">
                                       <img src="{{ asset('icons/s2.png') }}" width="30">
                                       <img src="{{ asset('icons/s3.png') }}" width="30">
                                       <img src="{{ asset('icons/s4.png') }}" width="30">
                                    </div>
                                 </div>
                              </button>
                           </h2>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body payment-card-body">
                                <div class="wrapper">
                                    <form action="{{ route('stripe') }}" method="post" class="stripe-form" id="payment-form">
                                        {{ csrf_field() }}
                                        <div class="form-row-stripe">
                                            <label for="card-element">
                                                Credit or debit card
                                            </label>
                                            <div id="card-element"></div>
                                            <div id="card-errors" role="alert"></div>
                                            <input type="hidden" name="stripe_email" id="stripe_email">
                                            <input type="hidden" name="stripe_name" id="stripe_name">
                                            <input type="hidden" name="stripe_amount" id="stripe_amount">
                                            <input type="hidden" name="stripe_invoice_number" id="stripe_invoice_number">
                                        </div>
                                        <button type="submit" class="btn-Stripe" id="submit-button">Submit Payment</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('scripts')
<!-- Strip Payment -->
<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe("<?php echo $setting->stripe_key?>");

    var elements = stripe.elements();

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
    var card = elements.create('card');

    card.mount('#card-element');

    card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    var form = document.getElementById('payment-form');
    var submitButton = document.getElementById('submit-button');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        if(!validateFields()){
            return;
        }

        submitButton.disabled = true;

        stripe.createToken(card).then(function(result) {
            if (result.error) {
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;

                submitButton.disabled = false;
            } else {
                var tokenInput = document.createElement('input');
                tokenInput.setAttribute('type', 'hidden');
                tokenInput.setAttribute('name', 'stripeToken');
                tokenInput.setAttribute('value', result.token.id);
                form.appendChild(tokenInput);

                $('#stripe_name').val(document.getElementById('fullName').value);
                $('#stripe_email').val(document.getElementById('email').value);
                $('#stripe_amount').val(document.getElementById('amount').value);
                $('#stripe_invoice_number').val(document.getElementById('invoice_number').value);

                form.submit();
            }
        });
    });
</script>

<!-- Paypal Payment -->
<script>
    (function() {
        paypal.Button.render({
            env: "{{ $setting->paypal_env == 1 ? 'production' : 'sandbox' }}",
            client: {
                @if ($setting->paypal_env == 1)
                    production: "{{ $setting->paypal_key }}",
                @else
                    sandbox: "{{ $setting->paypal_key }}",
                @endif
            },
            payment: function() {
            
            if(!validateFields()){
                throw new Error('Validation failed');
            }

            return paypal.rest.payment.create(this.props.env, this.props.client, {
                transactions: [
                {
                    amount: {
                        total: document.getElementById('amount').value,
                        currency: 'USD'
                    }
                }
                ]
            });
            },
            onAuthorize: function(data, actions) {
                return actions.payment.execute().then(function(data) {
                processPaypalTransaction(data);
                document.querySelector('#paypal-button-container').innerText = 'Payment Complete!';
            });
            }
        }, '#paypal-button-container');

    }).call(this);
    function processPaypalTransaction(data) {
        console.log(data)
        $.ajax({
            type: 'POST',
            url: '{{ route("processTransaction") }}',
            data: {
                name: document.getElementById('fullName').value,
                email: document.getElementById('email').value,
                amount: document.getElementById('amount').value,
                invoice_number: document.getElementById('invoice_number').value,
                data: data,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                window.location.href = "/success";
            },
            error: function(error) {
                window.location.href = "/error";
            }
        });
    }
</script>
<script>
    function validateFields() {
        var fullName = document.getElementById('fullName');
        var email = document.getElementById('email');
        var amount = document.getElementById('amount');
        var invoice_number = document.getElementById('invoice_number');
        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        var errorMessage = document.getElementsByClassName('errorMessage')[0];

        // Reset border color
        fullName.style.borderColor = '';
        email.style.borderColor = '';
        amount.style.borderColor = '';
        invoice_number.style.borderColor = '';

        // Reset error message
        errorMessage.innerText = '';

        if (!fullName.value.trim()) {
            errorMessage.style.display='block';
            fullName.style.borderColor = 'red';
            errorMessage.innerText = 'Please enter your full name.';
            scrollToTop();
            return false;
        }

        if (!email.value.trim()) {
            errorMessage.style.display='block';
            email.style.borderColor = 'red';
            errorMessage.innerText = 'Please enter your email.';
            scrollToTop();
            return false;
        }
        
        // Check if amount is not empty and is a valid number
        if (!amount.value.trim() || isNaN(parseFloat(amount.value.trim())) || !/^\d+(\.\d+)?$/.test(amount.value.trim())) {
            errorMessage.style.display='block';
            amount.style.borderColor = 'red';
            errorMessage.innerText = 'Please enter a valid amount.';
            scrollToTop();
            return false;
        }

        
        if (!invoice_number.value.trim()) {
            errorMessage.style.display='block';
            invoice_number.style.borderColor = 'red';
            errorMessage.innerText = 'Please enter your Invoice Number.';
            scrollToTop();
            return false;
        }

        if (!emailPattern.test(email.value.trim())) {
            errorMessage.style.display='block';
            email.style.borderColor = 'red';
            errorMessage.innerText = 'Please enter a valid email address.';
            scrollToTop();
            return false;
        }

        errorMessage.style.display='none';
        return true;
    }
    function scrollToTop() {
        window.scrollTo(0, 0);
    }
</script>
@endsection