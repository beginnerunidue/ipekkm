<?php
    // lesen json file
    $json = file_get_contents('../goods.json');
    $json = json_decode($json, true);

    // message prepare
    $message = '';
    $summe = '';
    $message .= '<h1>Bestellung</h1>';
    $message .='<p>Phone: '.$_POST['ephone'].'</p>';
    $message .='<p>EMail: '.$_POST['email'].'</p>';
    $message .='<p>Name: '.$_POST['ename'].'</p>';

    $cart = $_POST['cart'];

    foreach($cart as $id=>$count) {
        $message .=$json[$id]['name'].' --- ';
        $message .=$count.' kg ';
        $message .=$json[$id]['cost'].' € * '. $count. ' = ';
        $preis = number_format($json[$id]['cost'], 2);
        $einheiten = number_format($count, 2);
        $kosten = (float)$preis*(float)$einheiten;
        
        echo var_dump($kosten);
        $summe = (float)$summe;
        $summe +=$kosten;
        $message .=$kosten. ' € <br>';
        
    }
    $message .='<br> Summe : '.$summe.' €';

    // print_r($message);

    $to = 'iouri.kamenskikh@uni-due.de'.',';
    $to .=$_POST['email'];
    $spectext = '<!DOCTYPE html><html><head>
    <title>Bestellung</title></head><body>';
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

    $m = mail($to, 'Bestellung im online shop', $spectext.$message.'</body></html>', $headers);

    if ($m) {echo 1;} else {echo 0;}

?>