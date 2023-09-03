<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\DataLayer;
use App\Models\User;

use Srmklive\PayPal\Services\PayPal as PayPalClient;
class PayPalController extends Controller
{
    
    /**
     * create transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function transactionError()
    {
       
        return view('paymentErrorPage');
    }
    /**
     * process transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function processTransaction(Request $request)
    {
        
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('successTransaction'),
                "cancel_url" => route('cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "EUR",
                        "value" => "50.00"
                    ]
                ]
            ]
        ]);
        if (isset($response['id']) && $response['id'] != null) {
            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    
                    
                    return redirect()->away($links['href']);
                }
            }
            return redirect()
                ->route('transactionError')
                ->with('error', 'Something went wrong.');
        } else {
            return redirect()
                ->route('transactionError')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
    /**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function successTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            
            $username=session('username',0);
            $dl=new DataLayer();

            $dl->updatePagamento($username);
            //$user=User::where('username',$username);
            //$user->update(['pagante'=> 1]);
           // $user->update(['giorno_pagato'=>date('y-m-d')]);
            session()->forget('username');
            return redirect()
                ->route('user.success');
              
                
        } else {
            return redirect()
                ->route('transactionError')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelTransaction(Request $request)
    {
        return redirect()
        ->route('transactionError')
        ->with('error', $response['message'] ?? 'Something went wrong.');
    }


    public function renewAbbo(Request $request)
    {
        session_start();
        session_destroy();

        session_start();
         
        $mail=$request->input('insertMail');
        $userName=User::where('email',$mail)->value('username');
       // echo 'this'+$mail;
        session(['username'=>$userName]);
        
         return Redirect::to(route('processTransaction'));
    }

    public function checkUserMail(Request $request)
    {
        $dl= new DataLayer();

        if($dl->checkEmail($request->input('userMail')))
        {
            $response = array('found'=>true);
        } else {
            $response = array('found'=>false);
        }
        return response()->json($response);
       

    }
}
