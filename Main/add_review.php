<?php
    session_start();
    require_once "./connect/connect.php";

    $sqlString = "";
    if (!isset($_POST['feedback']) || empty($_POST['feedback'])) {
        $_SESSION["toast-error"] = "Vui lòng nhập đầy đủ thông tin";
        header("Location: ./Hotro.php");
        die();
    }

    $content = $_POST['feedback'];
    if (isset($_SESSION['user']) && !empty($_SESSION['user']['customerID'])) {
        $idCustomer = $_SESSION['user']['customerID'];
        $sqlString = "INSERT INTO `feedbacks`(`customerID`,`content`) VALUES ('$idCustomer', '$content')";
    } else {
        $sqlString = "INSERT INTO `feedbacks`(`content`) VALUES ('$content')";
    }
    $result = mysqli_query($connect, $sqlString);
    if ($result) {
        $_SESSION["toast-success"] = "Gửi phản hồi thành công";
        header("Location: ./Hotro.php");
        die();
    } else {
        $_SESSION["toast-error"] = "Gửi phản hồi thất bại";
        header("Location: ./Hotro.php");
        die();
    }
