<?php
namespace App\Http\Controllers;
use URL;
use Input;
use Session;
use App\User;
use App\Appointment;
use Redirect;
use Validator;
use App\Http\Requests;
use Stripe\Error\Card;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Setting;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;


class MoneySetupController extends Controller
{
    public function postPaymentStripe(Request $request)
    {
        try {
            $email = $request->stripe_email;
            $name = $request->stripe_name;
            $amount = $request->stripe_amount;
            $invoice_number = $request->stripe_invoice_number;
            $setting  = Setting::first();
            \Stripe\Stripe::setApiKey($setting->stripe_secret_key);

            // Get the payment amount and email address from the form.
            $stripe_amount = $amount * 100;
            $customer = \Stripe\Customer::create([
                'source' => $request->stripeToken,
            ]);
            
            // Create a new Stripe charge.
            $charge = \Stripe\Charge::create([
                'customer' => $customer->id,
                'amount' => $stripe_amount,
                'currency' => 'usd',
            ]);
            $this->handlePayment($charge, $email, $name, $amount, $invoice_number);
           return redirect('/success');
        } catch (\Exception $e) {
            return redirect('/error');
        }
    }

    public function handlePayment($data, $email, $name, $amount, $invoice_number)
    {
        try {
            $transactionId = $data->id;
            $amount = $data->amount / 100;
            $currency = $data->currency;
            $paymentMethodId = 'stripe';
            $createdAt = date('Y-m-d H:i:s', $data->created);

            $cardBrand = $data->payment_method_details->card->brand;
            $last4 = $data->payment_method_details->card->last4;
            $expMonth = $data->payment_method_details->card->exp_month;
            $expYear = $data->payment_method_details->card->exp_year;
            
            // Construct payer details array including card details
            $payerDetails = [
                'cardBrand' => $cardBrand,
                'last4' => $last4,
                'expMonth' => $expMonth,
                'expYear' => $expYear,
                'transactionId' => $transactionId
            ];
            
            // Save the extracted data into the appointments table
            $appointment = new Appointment();
            $appointment->transactionId = $transactionId;
            $appointment->amount = $amount;
            $appointment->name = $name;
            $appointment->email = $email;
            $appointment->invoice_number = $invoice_number;
            $appointment->status = $data->status;
            $appointment->currency = $currency;
            $appointment->payerDetails = json_encode($payerDetails); // Convert array to JSON before storing
            $appointment->paymentMethod = $paymentMethodId;
            $appointment->created_at = $createdAt; // Set created_at field
            
            if($appointment->save()){
                // $this->sendEmail($appointment);
                return $appointment;
            }
        } catch (\Exception $e) {
            echo 'Payment was successful but there was an error while saving data!';
        }
    }


    /**
     * process transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function processTransaction(Request $request){
        $payload = $request->all();
        $data = $payload['data'];
        // Extracting relevant data from the JSON response
        $transactionId = $data['id'];
        $amount = $data['transactions'][0]['amount']['total'];
        $currency = $data['transactions'][0]['amount']['currency'];
        $payerDetails = $data['payer']['payer_info']; // Already an array, no need to decode
        $paymentMethod = $data['payer']['payment_method'];
        $create_time = $data['create_time'];

        $payerDetails['transactionId'] = $transactionId;
    
        // Check if shipping_address exists before unsetting it
        if (isset($payerDetails['shipping_address'])) {
            unset($payerDetails['shipping_address']);
        }
    
        // Encode the modified payerDetails back to JSON
        $payerDetailsJson = json_encode($payerDetails);
    
        // Save the extracted data into the appointments table
        $appointment = new Appointment();
        $appointment->transactionId = $transactionId;
        $appointment->amount = $amount;
        $appointment->name = $payload['name'];
        $appointment->email = $payload['email'];
        $appointment->invoice_number = $payload['invoice_number'];
        $appointment->status = $data['state'];
        $appointment->currency = $currency;
        $appointment->payerDetails = $payerDetailsJson;
        $appointment->paymentMethod = $paymentMethod;
        $appointment->created_at = $create_time;
        $appointment->save();

        // Send email upon successful payment
        // $this->sendEmail($appointment);
    
        // Optionally, return a response indicating success
        return response()->json(['message' => 'Transaction processed successfully'], 200);
    }

    public function sendEmail($data)
    {
        Mail::to($data->email)->send(new WelcomeEmail($data->name));
    }
    public function testEmail()
    {
        Mail::to('ab.pk012@gmail.com')->send(new WelcomeEmail('Abdul Basit'));
    }
}