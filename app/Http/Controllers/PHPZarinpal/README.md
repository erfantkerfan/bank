# ![logo](https://cdn.pbrd.co/images/HvKaXwC.png) PHPZarinpal 
This is a PHP wrapper for [Zarinpal's Web API](https://zarinpal.com/). This library will help you to use Zarinpal API in an easy and simple case.

## Requirements
* PHP 5.4 or later.
* PHP [cURL extension](http://php.net/manual/en/book.curl.php) (Usually included with PHP).

##  Installation
Just download and include (src/PHPZarinpal.php) in your files.
```php
require_once("src/PHPZarinpal.php");
```
## 🕹 Usage
It's even easier than drinking a cup of coffe!
### Request Authority:
```php
require_once("src/PHPZarinpal.php");
$zp = new ffb343\PHPZarinpal('xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx'); // Just pass your Merchant ID

$zp->setCallbackURL("http://ffb343.github.io/PHPZarinpal/example/verify.php"); //Requerd
//The address that user should be directed to after payment. For example your verify.php file

$zp->setAmount("5500"); //Requerd
//Amount to be paid by the user based on IRI Tooman

$zp->setDescription("Testing Trans"); //Requerd
//Transaction description

$zp->setEmail("test@example.io"); //Optionalal
//Buyer's email

$zp->setMobile("9123456789"); //Optionalal
//Buyer's Mobile Number

$authority = $zp->getAuthority(); //Request Authority ke
$zp->getPaymentURL(); // Get payment Gateway URL
$zp->redirect(); // Redirect to Payment Gateway URL
```
### Verify transaction (verify.php)
```php
require_once 'src/PHPZarinpal.php';
$zp = new ffb343\PHPZarinpal('xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx');

$zp->setAmount("5500"); //The amount paid by the user

$resault = $zp->verify($_GET['Authority']);
if ($resault['ok'] == 'true') {
	echo "Transaction Success! RefID: " . $resault['refID'];
} else {
	echo "Transaction failed!! " . $resault['message'];
}
```
An example of ``verify()`` result on successful payments:
```php
Array ( 
	[ok] => true 
	[status] => 100 
	[message] => Operation was successful 
	[refID] => 57525784891 
	[extraDetail] => Array ( 
						  [Transaction] => Array ( 
											   [CardPanHash] => 7549EE67xxxxxxxxxxxxxxxB4099DAC 
											   [CardPanMask] => 632524******7037 
											   ) 
						   ) 
)
```
or on unsuccessful payments:
```php
Array ( 
	[ok] => false 
	[status] => 101 
	[message] => Operation was successful but PaymentVerification operation on this transaction have already been done
)
```
It was all that you need to get started!
If you want, you can also use below methods (Special features)

### Shared pay off
This method is suitable for those sellers whose benefit from entered price must be distributed in a special way. For example you own a web site that presents ceremony services and you have some contributions with several contractors. In this way you would keep some money and settle the rest of it to the contractors' account.
```php
$zp->sharedPay([
	'zp.1.1' => [
		'amount' => '1200',
		'description' => 'Testing Profit Partnership',
	],
	'zp.4555.3' => [
		'amount' => '5500',
		'description' => 'Testing Tax',
	],
]);
```
The line above means that if the transaction was successful amount of 1200 Toman from the main transaction is sent to 1st account (zp.1.1) and amount of 5500 Toman is sent to 2nd account (zp.4555.3) and all the procedure is explained and saved.
### Create Authority with Long Lifetime
```php
$zp->setExpireIn('1800'); //Set expire time (in second)
```
### Refresh Authority
Refresh Authority key (Extending expiration time)
```php
$zp->refreshAuthority($authority, 3600); //1st parameter [YourAuthority] and 2nd parameter [TimeInSecond]
```
### Get Unverified Transactions
Get a list of Transactions that ``verify() ``was not used for them
```php
$zp->getUnverifiedTransactions();
```
### Using Sandbox
Sandbox is a service to test the program.
Similarly, you can send fake requests and simulate the status of a successful or unsuccessful payment.
To use it, set 2nd parameter to ``sandbox`` in ``construct()``
```php
$zp = new ffb343\PHPZarinpal('xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx','sandbox');
```
### Using ZarinGate, MobileGate
These two special services are used to personalize the payment URL.
For example, ZarinGate, redirects user directly to the payment page without intermediary.
in ```getPaymentURL()``` Just pass ``zaringate`` to use ZarinGate or ``mobilegate`` to use MobileGate or Leave it blank to use Zarinpal's web gate.
```php
$zp->getPaymentURL('zaringate'); //use ZarinGate
$zp->getPaymentURL('mobilegate'); //use MobileGate
$zp->getPaymentURL(); //use MZarinpal's web gate
```
## Full Documents
Unfortunately, I did not have time to do this. But the documents will be completed soon. by looking at the codes, you can also see how they are used.

## Contributing
Contributions are more than welcome! See [CONTRIBUTING.md](https://github.com/ffb343/PHPZarinpal/blob/master/CONTRIBUTING.md) for more info. 
Please submit PRs or just file an issue if you see something broken or in need of improving.
## License
MIT license. Please see [LICENSE.md](https://github.com/ffb343/PHPZarinpal/blob/master/LICENSE) for more info.
