<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eshop";

function connect() {
    $conn = mysqli_connect("localhost", "root", "", "eshop");
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}

function init() {
    // Ausgabe der Warenliste
    // echo "init erreicht!!!";
    $conn = connect();
    $sql = "SELECT id, name FROM goods";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $out = array();
        while($row = mysqli_fetch_assoc($result)) {
            $out[$row["id"]] = $row;
        }
        echo json_encode($out);
    } else {
        echo "0";
    }

    mysqli_close($conn);
}

function selectOneOfGoods() {
    // Den ausgewählten Artikel aus DB auslesen
    $conn = connect();
    $id = $_POST['gid'];
    $sql = "SELECT * FROM goods WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);                
        echo json_encode($row);
    } else {
        echo "0";
    }

    mysqli_close($conn);
}

function updateGoods() {
    // Daten in DB schreiben
    $conn = connect();
    $id = $_POST['gid'];
    $name = $_POST['gname'];
    echo $name;
    $cost = $_POST['gcost'];
    $description = $_POST['gdescription'];
    $orderintb = $_POST['gorder'];
    $img = $_POST['gimage'];

    $sql = "UPDATE goods SET name='$name', cost='$cost',
     description = '$description', orderintb='$orderintb', img='$img' 
     WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        echo " Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    writeJSON();

}

function newGoods() {
    // Einen neuen Datensatz in DB schreiben
    $conn = connect();    
    $name = $_POST['gname'];
    echo $name;
    $cost = $_POST['gcost'];
    $description = $_POST['gdescription'];
    $orderintb = $_POST['gorder'];
    $img = $_POST['gimage'];    
    
    $sql = "INSERT INTO goods (name, cost, description, orderintb, img)
    VALUES ('$name', '$cost', '$description', '$orderintb', '$img')";
    
    if (mysqli_query($conn, $sql)) {
        echo " Record inserted successfully";
    } else {
        echo "Error inserting record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    writeJSON();
}

function writeJSON() {
    $conn = connect();
    $sql = "SELECT * FROM goods";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $out = array();
        while($row = mysqli_fetch_assoc($result)) {
            $out[$row["id"]] = $row;
        }
        file_put_contents('../goods.json', json_encode($out));
    } else {
        echo "0";
    }

    mysqli_close($conn);    
}
