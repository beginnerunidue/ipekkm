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
    $sql = "SELECT * FROM goods";
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

}
