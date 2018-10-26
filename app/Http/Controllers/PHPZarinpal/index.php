<?php
require_once 'src/PHPZarinpal.php';
$zp = new ffb343\PHPZarinpal("xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx");

$zp->setCallbackURL("http://ffb343.github.io/PHPZarinpal/verify.php");
$zp->setAmount(2200);
$zp->setDescription("Testing Trans");
$zp->setEmail("test@example.io");
$zp->setMobile("9123456789");

$zp->sharedPay([
	'zp1.1' => [
		'amount' => '300',
		'description' => 'Testing Profit Partnership',
	],
	'zp45.86' => [
		'amount' => '500',
		'description' => 'Testing Tax',
	],
]);

$zp->setExpireIn('1800');

$au = $zp->getAuthority();
$zp->refreshAuthority($au, 3600);
$zp->getPaymentURL();
$zp->redirect();