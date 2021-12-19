<?php

namespace App\Traits;

use App\Models\Setting;
use Illuminate\Http\Request;
use Stripe\StripeClient;
use Stripe\Exception\CardException;
use Stripe\Exception\RateLimitException;
use Stripe\Exception\InvalidRequestException;
use Stripe\Exception\AuthenticationException;
use Stripe\Exception\ApiConnectionException;
use Stripe\Exception\ApiErrorException;
use Illuminate\Support\Facades\Log;
use Exception;
use Auth;

trait StripeTrait {
	public function stripePayment($request, $total, $subject, $currency) {
		try {
			$data=$this->stripeTransaction($request, $total, $subject, $currency);
			$result=array('status' => 'success', 'data' => $data);
		} catch(CardException $e) {
			Log::error('Pago con Stripe: El estado es:'.$e->getHttpStatus().'\n'.'El tipo es: '.$e->getError()->type.'\n'.'El codido es: '.$e->getError()->code.'\n'.'El parametro es: '.$e->getError()->param.'\n'.'El mensaje es: '.$e->getError()->message);
			$result=array('status' => 'error', 'message' => 'El estado es:'.$e->getHttpStatus().', El tipo es: '.$e->getError()->type.', El codido es: '.$e->getError()->code.', El parametro es: '.$e->getError()->param.', El mensaje es: '.$e->getError()->message);
		} catch (RateLimitException $e) {
			Log::error("Pago con Stripe: ".$e->getMessage());
			$result=array('status' => 'error', 'message' => $e->getMessage());
		} catch (InvalidRequestException $e) {
			Log::error("Pago con Stripe: ".$e->getMessage());
			$result=array('status' => 'error', 'message' => $e->getMessage());
		} catch (AuthenticationException $e) {
			Log::error("Pago con Stripe: ".$e->getMessage());
			$result=array('status' => 'error', 'message' => $e->getMessage());
		} catch (ApiConnectionException $e) {
			Log::error("Pago con Stripe: ".$e->getMessage());
			$result=array('status' => 'error', 'message' => $e->getMessage());
		} catch (ApiErrorException $e) {
			Log::error("Pago con Stripe: ".$e->getMessage());
			$result=array('status' => 'error', 'message' => $e->getMessage());
		} catch (Exception $e) {
			Log::error("Pago con Stripe: ".$e->getMessage());
			$result=array('status' => 'error', 'message' => $e->getMessage());
		}

		return $result;
	}

	public function stripeTransaction($request, $total, $subject, $currency) {
		$setting=Setting::first();
		$stripe=new StripeClient($setting->stripe_secret);

		$user=Auth::user();
		if (is_null($user->stripe_id)) {
			$user->createOrGetStripeCustomer();
			$customer=$user->updateStripeCustomer(
				['name' => $user->name." ".$user->lastname, 'phone' => $user->phone, 'address' => $user->address, 'source' => $request->stripeToken]
			);
		}

		$amount=str_replace(".", "", number_format($total, 2, '.', ''));
		$amount=(int)$amount;

		$charge=$stripe->charges->create([
			'amount' => $amount,
			'currency' => $currency,
			'description' => $subject,
			'source' => $request->stripeToken
		]);
		$balance_transaction=$stripe->balanceTransactions->retrieve($charge->balance_transaction);

		$data=array('charge' => $charge, 'balance_transaction' => $balance_transaction);
		return $data;
	}

	public function stripeFee($balance_transaction) {
		if (strlen($balance_transaction->fee)>=3) {
			$decimals=substr($balance_transaction->fee, -2);
			$integers=substr($balance_transaction->fee, 0, -2);
			$fee=$integers.".".$decimals;
		} elseif (strlen($balance_transaction->fee)==2) {
			$fee="0.".$balance_transaction->fee;
		} elseif (strlen($balance_transaction->fee)==1) {
			$fee="0.0".$balance_transaction->fee;
		} else {
			$fee=0.00;
		}
		return $fee;
	}
}