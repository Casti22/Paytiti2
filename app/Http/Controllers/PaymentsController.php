<?php

namespace App\Http\Controllers;

use App\Order;
use App\PayPal;
use Illuminate\Http\Request;

use Session;

class PaymentsController extends Controller
{
    public function __construct(){
        $this->middleware('shopping_cart');
    }

    public function pay(Request $request){
       $amount = $request->shopping_cart->amount();

       $paypal = new PayPal();

       $response = $paypal->charge($amount);

       $redirectLinks = array_filter($response->result->links, function($link){
           return $link->method == 'REDIRECT';
       });

       $redirectLinks = array_values($redirectLinks);

       return redirect($redirectLinks[0]->href);
    }

    public function execute(Request $request){
        $paypal = new PayPal();
        $response = $paypal->execute($request->paymentId, $request->PayerID);

       if($response->statusCode == 200){

        $order = Order::createFromPaypalResponse($response->result, $request->shopping_cart);

        if($order){
            Session::remove('shopping_cart_id');
            return view('payments.success', ['shopping_cart' => $request->shopping_cart, 'order' => $order]);

        }

       }else{
        return redirect(URL::route('shopping_cart.show'));
       }
    }
}
