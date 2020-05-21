<?php
    $action;

    if ($_POST['action']) {
        $action = $_POST['action'];
    }    

    require_once 'function.php';

    switch ($action) {
        case 'init':
            init();
            break;
        case 'selectOneOfGoods':
            selectOneOfGoods();
            break;  
        case 'updateGoods':
            updateGoods();
            break;      
    }


?>