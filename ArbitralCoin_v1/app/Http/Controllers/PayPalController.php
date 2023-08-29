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
    public function trransactionError()
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
            $user=User::where('username',$username);
            $user->update(['pagante'=> 1]);
            //$user->update(['giorno_paga'=>date('d-m-y')]);
            session()->forget('username');
            return redirect()
                ->route('user.login');
              
                
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

    public function checkUserMail(Request $request)
    {
        $dl= new DataLayer();

        return $dl->checkEmail($request->input('userMail'));

    }

    public function renewAbbo(Request $request)
    {
          
         
        $userName=User::where('email',$request->input('insertMail'))->get('username');
        session(['username'=>$userName]);
        
         return redirect()
        ->route('processTransaction');
    }
}
