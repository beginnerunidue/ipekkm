<?php
$action = $_POST['action'];
// echo ' -- Als $action bekam ich : ' .$action;

require_once 'function.php';

switch ($action) {
    case 'init':
        // echo "STARTE init()"; 
        init();        
        break;
    case 'selectOneOfGoods':
        // echo "STARTE selectOneOfGoods()"; 
        selectOneOfGoods();        
        break;     
    case 'updateGoods':
        // echo "STARTE updateGoods()"; 
        updateGoods();        
        break;
    case 'newGoods':
        // echo "STARTE newGoods()";
        newGoods();


    }


?>