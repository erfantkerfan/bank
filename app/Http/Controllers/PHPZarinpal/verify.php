<?php
require_once 'src/PHPZarinpal.php';
$zp = new ffb343\PHPZarinpal('xxxxxxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxxx');

$zp->setAmount("100");
$resault = $zp->verify($_GET['Authority']);
print_r($resault);

if ($resault['ok'] == 'true') {
	echo "Transaction Success! RefID: " . $resault['refID'];
} else {
	echo "Transaction failed!! " . $resault['message'];
}