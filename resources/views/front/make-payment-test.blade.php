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
</style>

<style>
    form {
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

.form-row {
  width: 70%;
  height: 100px;
  float: left;
}

#card-element {
  background-color: white;
  width: 400px;
  height: 20px;
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
</style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    

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
                              <!-- <input type="text" class="form-control" placeholder="Paypal email"> -->
                                <!-- <table border="0" cellpadding="10" cellspacing="0" align="center"><tr><td align="center"></td></tr><tr><td align="center"><a href="https://www.paypal.com/in/webapps/mpp/paypal-popup" title="How PayPal Works" onclick="javascript:window.open('https://www.paypal.com/in/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;"><img src="https://www.paypalobjects.com/webstatic/mktg/Logo/pp-logo-200px.png" border="0" alt="PayPal Logo"></a></td></tr></table>-->

                                <a href="{{ route('processTransaction') }}" class="btn btn-success">Pay $1 from Paypal</a>
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
                                <form action="/charge" method="post" id="payment-form">
                                    <div class="form-row">
                                    <label for="card-element">
                                        Credit or debit card
                                    </label>
                                    <div id="card-element">
                                        <!-- a Stripe Element will be inserted here. -->
                                    </div>
                                    <!-- Used to display Element errors -->
                                    <div id="card-errors" role="alert"></div>
                                    </div>
                                    <button class="btn-Stripe">Submit Payment</button>
                                </form>
                                </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- <div class="col-md-6">
               <div class="card">
                  <div class="d-flex justify-content-between p-3">
                     <div class="d-flex flex-column">
                        <span>Pro(Billed Monthly) <i class="fa fa-caret-down"></i></span>
                        <a href="#" class="billing">Save 20% with annual billing</a>
                     </div>
                     <div class="mt-1">
                        <sup class="super-price">$9.99</sup>
                        <span class="super-month">/Month</span>
                     </div>
                  </div>
                  <hr class="mt-0 line">
                  <div class="p-3">
                     <div class="d-flex justify-content-between mb-2">
                        <span>Refferal Bonouses</span>
                        <span>-$2.00</span>
                     </div>
                     <div class="d-flex justify-content-between">
                        <span>Vat <i class="fa fa-clock-o"></i></span>
                        <span>-20%</span>
                     </div>
                  </div>
                  <hr class="mt-0 line">
                  <div class="p-3 d-flex justify-content-between">
                     <div class="d-flex flex-column">
                        <span>Today you pay(US Dollars)</span>
                        <small>After 30 days $9.59</small>
                     </div>
                     <span>$0</span>
                  </div>
                  <div class="p-3">
                     <button class="btn btn-primary w-100 py-3">Try it free for 30 days</button> 
                  </div>
               </div>
            </div> -->
         </div>
      </div>
   </div>
</div>
@endsection

@section('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe('pk_test_6pRNASCoBOKtIshFeQd4XMUh');

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

    // Create an instance of the card Element
    var card = elements.create('card', {style: style});

    // Add an instance of the card Element into the `card-element` <div>
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

    // Handle form submission
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
    event.preventDefault();

        stripe.createToken(card).then(function(result) {
            if (result.error) {
            // Inform the user if there was an error
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
            } else {
            // Send the token to your server
            stripeTokenHandler(result.token);
            }
        });
    });
</script>
@endsection