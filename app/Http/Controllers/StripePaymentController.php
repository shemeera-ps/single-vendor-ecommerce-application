

namespace App\Http\Controllers;
use Stripe\Stripe;
use Illuminate\Http\Request;

class StripePaymentController extends Controller
{
    public function index(){

    }
    public function checkout()
{
   

  $session = Stripe::Checkout::Session.create([
    'line_items'=>$lineItems,
    'mode'=> 'payment',
  
    'success_url'=> 'https://example.com/success',
   ' cancel_url' => 'https://example.com/cancel',
]);

  redirect ($session->url);
}

public function afterpayment(Request $request)
{
    $amount = 100;
    $stripe = Stripe::setApiKey(env('STRIPE_SECRET'));

    $charge = $stripe->charges()->create([
        'amount' => $amount,
        'currency' => 'USD',
        'source' => $request->stripeToken,
        'description' => 'Test Payment',
        'receipt_email' => $request->email,
    ]);

    return redirect()->route('stripe.payment')->with('success', 'Payment successful!');
}

} 
