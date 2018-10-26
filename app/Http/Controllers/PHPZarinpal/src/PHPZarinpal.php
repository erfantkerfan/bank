<?php
namespace ffb343;
class PHPZarinpal {
	private $APIEndpoint = "https://www.zarinpal.com/pg/rest/WebGate/";
	private $gateEndpoint = "https://www.zarinpal.com/pg/StartPay/";
	private $merchantID = null;
	private $callbackURL = null;
	private $amount = null;
	private $description = null;
	private $email = null;
	private $mobile = null;
	public $additionalData = [];
	private $authority = null;
	private $gatewayURL = null;
	private $isSandBox = false;

	/**
	 * Construct
	 * @param string       $merchantID   Your Merchant ID
	 * @param type|string  $method       Just don't pass anything, or pass sandbox to use sandbox
	 * @return type
	 */
	public function __construct($merchantID, $method = 'dafault') {
		if ($method == 'sandbox') {
			$this->APIEndpoint = "https://sandbox.zarinpal.com/pg/rest/WebGate/";
			$this->gateEndpoint = "https://sandbox.zarinpal.com/pg/StartPay/";
			$this->isSandBox = true;
		}
		if (!isset($merchantID)) {
			throw new PZE("merchantID can not be empty", 1);
		}
		$this->merchantID = $merchantID;
	}
	/**
	 * Contact with Zarrin Pal Web Service
	 * @param string $method Which should be called (specified by Zarrinpal Web Services)
	 * @param array $data Required information for the called method
	 * @return string
	 */
	private function cURL($method, $data) {
		$data = json_encode($data);
		$ch = curl_init($this->APIEndpoint . '' . $method . '.json');
		curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($data),
		));
		$result = curl_exec($ch);
		$err = curl_error($ch);
		$result = json_decode($result, true);
		curl_close($ch);
		if ($err) {
			throw new PZE("cURL ERR:" . $err, 1);
			return "cURL ERR:" . $err;
		} else {
			return $result;
		}
	}

	/**
	 * Add Additional Data to Zarinpal Webservice Request
	 * @param array $arr containing some data in valid format
	 */
	private function addAdditionalData($arr) {
		$this->additionalData = array_merge($this->additionalData, $arr);
	}

	/**
	 * Get error code as human-readable string
	 * @param string $err
	 * @return string|null The human-readable Error message or null if error's code not found
	 */
	public function getResultMessage($err) {
		$errors = [
			'-1' => 'Information submitted is incomplete',
			'-2' => 'Merchant ID or Acceptor IP is not correct',
			'-3' => 'Amount should be above 100 Toman',
			'-4' => 'Approved level of Acceptor is Lower than the silver',
			'-11' => 'Bad Request',
			'-21' => 'Financial operations for this transaction was not found',
			'-22' => 'Transaction is unsuccessful',
			'-33' => 'Transaction amount does not match the amount paid',
			'-34' => 'Limit the number of transactions or number has crossed the divide',
			'-40' => 'There is no access to the method',
			'-41' => 'Additional Data related to information submitted is invalid',
			'-54' => 'Request archived',
			'100' => 'Operation was successful',
			'101' => 'Operation was successful but PaymentVerification operation on this transaction have already been done',
		];
		return isset($errors[$err]) ? $errors[$err] : null;
	}

	/**
	 * Set CallBack URL To get the result after transaction
	 * @param string $url For example verification.php
	 * @return bool true, if the url is valid
	 */
	public function setCallbackURL($url) {
		if (filter_var($url, FILTER_VALIDATE_URL)) {
			$this->callbackURL = $url;
			return true;
		} else {
			throw new PZE("CallBack URL should be a valud URL", 1);
		}
	}

	/**
	 * Set amount that user should pay
	 * @param string $amount
	 * @return bool true, always!
	 */
	public function setAmount($amount) {
		$this->amount = $amount;
		return true;
	}

	/**
	 * Set payment descriptions
	 * @param string $description
	 * @return bool true, if description is not null or empty
	 */
	public function setDescription($description) {
		if (!is_null($description) && $description != '' && !empty($description)) {
			$this->description = $description;
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Set user email (Who wants to pay)
	 * @param string $email
	 * @return bool true, always!
	 */
	public function setEmail($email) {
		$this->email = $email;
		return true;
	}

	/**
	 * Set user mobile (Who wants to pay)
	 * @param string $phoneNumber ex: 09123456789
	 * @return bool true, if $phoneNumber is a valid iranian phone number
	 */
	public function setMobile($phoneNumber) {
		if (!preg_match("/^09[0-9]{9}$/", $phoneNumber)) {
			return false;
		}

		$this->mobile = $mobile;
		return true;
	}

	/**
	 * Add shared pay off to the current transaction
	 * @param array $arr containing Zarinpal user IDs and amount and description for each Zarinpal user ID
	 * @return bool true, always!
	 */
	public function sharedPay($arr) {
		$this->addAdditionalData([
			'Wages' => $arr,
		]);
		return true;
	}

	/**
	 * Create Authority key with Long lifetime (or Custom life span)
	 * @param int $seconds in seconds, between 1800 and 3888000
	 * @return bool true if your $seconds is in a valid format (int, 1800 < seconds < 3888000)
	 */
	public function setExpireIn($seconds) {
		if (!is_numeric($seconds) || $seconds < 1800 || $seconds > 3888000) {
			return false;
		}

		$this->addAdditionalData([
			'expireIn' => $seconds,
		]);
		return true;
	}

	/**
	 * Refresh Authority key (Extending expiration time)
	 * @param int $authority Your Transaction's Specfic Authority
	 * @param int $seconds The time you need to extend the Authority key in seconds
	 * @return bool true if your $seconds is in a valid format (int, 1800 < seconds < 3888000) and action successful
	 */
	public function refreshAuthority($authority, $seconds = 1800) {
		if (!is_numeric($seconds) || $seconds < 1800 || $seconds > 3888000) {
			return false;
		}
		$this->cURL('RefreshAuthority', [
			'MerchantID' => $this->merchantID,
			'Authority' => $authority,
			'ExpireIn' => $seconds,
		]);
		return true;
	}

	/**
	 * Get list of Transactions that verify() is not used for them
	 * @return array of Transactions and data
	 */
	public function getUnverifiedTransactions() {
		$result = $this->cURL('GetUnverifiedTransactions', [
			'MerchantID' => $this->merchantID,
		]);
		return $result;
	}

	/**
	 * Get Authority key (36-digit number)
	 * @return string Authority key or an error message if there is some errors (should store in a safe 460606)
	 */
	public function getAuthority() {
		if (!isset($this->amount)) {
			throw new PZE("You should enter a valid Amount", 1);
		}

		if (!isset($this->callbackURL)) {
			throw new PZE("You should enter a valid CallBack URL", 1);
		}

		if (!isset($this->description)) {
			throw new PZE("You should enter a valid Description", 1);
		}
		$method = 'PaymentRequest';
		$data = [
			'MerchantID' => $this->merchantID,
			'Amount' => $this->amount,
			'CallbackURL' => $this->callbackURL,
			'Description' => $this->description,
		];
		if (isset($this->email)) {
			$data['Email'] = $this->email;
		}

		if (isset($this->email)) {
			$data['Mobile'] = $this->mobile;
		}

		if (!empty($this->additionalData)) {
			$jsonEncodedAdditionalData = json_encode($this->additionalData);
			$additionalDataArray = [
				'AdditionalData' => "$jsonEncodedAdditionalData",
			];
			$data = array_merge($data, $additionalDataArray);
			$method = 'PaymentRequestWithExtra';
		}
		$result = $this->cURL($method, $data);
		if ($result["Status"] == 100) {
			$this->authority = $result["Authority"];
			return $result["Authority"];
		} else {
			throw new PZE($result["Status"] . " " . $this->getResultMessage($result["Status"]), 1);
			return 'ERR: ' . $result["Status"] . ' ' . $this->getResultMessage($result["Status"]);
		}
	}

	/**
	 * Check whether the transaction has been successfully completed
	 * @param int $authority the Authortiy key ( that was created with getAuthority() )
	 * @param int|null $amount The amount paid by the user (in IRI Tooman)
	 * @return array Array containing the status ('ok'), and ('refID') if transaction has been successfully completed or ('status') if there is an error
	 */
	public function verify($authority, $amount = null) {
		if (!isset($_GET['Status']) || $_GET['Status'] != 'OK') {
			return ['ok' => 'false', 'status' => '-22', 'message' => $this->getResultMessage('-22')];
		}

		$result = $this->cURL("PaymentVerificationWithExtra", [
			'MerchantID' => $this->merchantID,
			'Authority' => $authority,
			'Amount' => isset($this->amount) ? $this->amount : $amount,
		]);
		if ($result['Status'] == 100) {
			return [
				'ok' => 'true',
				'status' => $result['Status'],
				'message' => $this->getResultMessage($result['Status']),
				'refID' => $result['RefID'],
				'extraDetail' => $result['ExtraDetail'],
			];
		} else {
			return [
				'ok' => 'false',
				'status' => $result['Status'],
				'message' => $this->getResultMessage($result['Status']),
			];
		}
	}

	/**
	 * Get payment gateway URL
	 * @param int $authority
	 * @param string $method Can be (default,zaringate,mobilegate), for default, just don't pass any value
	 * @return string Zarinpal gateway URL
	 */
	public function getPaymentURL($method = 'default') {
		$allowedMethod = [
			'default' => '',
			'zaringate' => 'ZarinGate',
			'mobilegate' => 'MobileGate',
		];
		$gatewayURL = $this->gateEndpoint . '' . $this->authority . '/' . $allowedMethod[$method];
		$this->gatewayURL = $gatewayURL;
		if (isset($allowedMethod[$method])) {
			return $this->gatewayURL;
		} else {
			throw new PZE("'$method' Not found", 1);
		}
	}

	/**
	 * Redirect user to gateway
	 * @param string $url
	 * @return bool
	 */
	public function redirect() {
		header("Location: " . $this->gatewayURL);
		return true;
	}

}

class PZE extends \Exception {}