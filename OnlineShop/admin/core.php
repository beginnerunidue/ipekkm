<?php
$action = $_POST['action'];
// echo ' -- Als $action bekam ich : ' .$action;

require_once 'function.php';

switch ($action) {
    case 'init':
        // echo "STARTE init()"; 
        init();        
        break;    
}

?>