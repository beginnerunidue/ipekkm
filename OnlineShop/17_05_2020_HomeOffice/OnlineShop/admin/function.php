<?php
    // $servername = "localhost";
    // $username = "root";
    // $password = "root";
    // $dbname = "eshop";

    function connect() {
        $conn = mysqli_connect("localhost","root","","eshop");
        if(!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        return $conn;
    }

    function init() {
        // Ausgabe der Liste der Artikel
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
            echo " 0 results";
        }

        mysqli_close($conn);
    }

    function selectOneOfGoods() {
        $conn = connect();
        if ($_POST['gid']) {
            $id = $_POST['gid'];
        }
        $sql = "SELECT * FROM goods WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {            
            $row = mysqli_fetch_assoc($result);
            echo json_encode($row); 
        } else {
            echo " 0 results";
        }

        mysqli_close($conn);
    }

    function updateGoods() {
        $conn = connect();
        if ($_POST['gid']) {
            $id = $_POST['gid'];
            $name = $_POST['gname'];
            $cost = $_POST['gcost'];
            $description = $_POST['gdescription'];
            $ordertb = $_POST['gorder'];
            $img = $_POST['gimage'];
        }

        $sql = "UPDATE goods SET name='$name', cost='$cost', description='$description',
            ordertb='$ordertb', img='$img'  WHERE id='$id' ";

        if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully";
        } else {
        echo "Error updating record: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
    
    
    // function connect() {
    //     $conn = mysqli_connect("localhost","root","","eshop");
    //     if(!$conn) {
    //         die("Connection failed: " . mysqli_connect_error());
    //     }
    //     return $conn;
    // }

    // $mysqli = new mysqli_connect("localhost","root","","eshop");

    // // Check connection
    // if ($mysqli -> connect_errno) {
    //   echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    //   exit();
    // }


?>