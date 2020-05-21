<?php
// lesen json file
$json = file_get_contents('../goods.json');
$json = json_decode($json, true);
// email zusammenstellen
$message = '';
$message .= '<h1>order in eshop</h1>';
$message .= '<p>phone: '.$_POST['ephone'].'</p>';
$message .= '<p>email: '.$_POST['email'].'</p>';
$message .= '<p>name: '.$_POST['ename'].'</p>';

$cart = $_POST['cart'];
$sum = 0;

foreach ($cart as $id=>$count) {
   $message .='Art. Nr.: '.$id.' - ';
   $message .=$json[$id]['name'].' - ';
   $message .=$count.' -kg- ';
   $message .=$count*$json[$id]['cost']. ' €<br>';
   $sum += $count*$json[$id]['cost'];    
}
print_r($message);
print_r('Summe: '.$sum.' €<br>');

$to = 'iouri.kamenskikh@uni-due.de'.',';
$to .=$_POST['email'];
$spectext = '<!DOCTYPE HTML><html><head>
<title>Bestellung</title></head>
<body>';
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

$m = mail($to, 'Online-Bestellung', $spectext.$message.'</body></html>', $headers);

if ($m) {echo 1;} else {echo 0;}

?>