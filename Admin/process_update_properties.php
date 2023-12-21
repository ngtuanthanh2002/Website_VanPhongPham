<?php
    session_start();
    require_once './ShareAdmin/root/connect.php';
    $id = $_GET['id'];
    $stringSQL = "SELECT * FROM `thuoctinh` WHERE `id` = '$id'";

    $result = mysqli_query($connect, $stringSQL);
    $each = mysqli_fetch_array($result);

    $stringSQL = "SELECT * FROM `thuoctinh` WHERE `ten_thuoctinhcha` = '". $each['ma_thuoctinh'] . "'";
    $result = mysqli_query($connect, $stringSQL);
    $lstthuoctinhcon = array();
    foreach ($result as $eachChild) {
        array_push($lstthuoctinhcon, $eachChild);
    }

    $name_parent_properties = $_POST['name_parent_properties'];
    if (isset($_POST['name_child_properties'])) {
        $name_child_properties = $_POST['name_child_properties'];
    } else {
        $name_child_properties = [];
    }

    if ($name_parent_properties != $each['ten_thuoctinhcha']) {
        $stringSQL = "UPDATE `thuoctinh` SET `ten_thuoctinhcha` = '$name_parent_properties' WHERE `id` = '$id'";
        mysqli_query($connect, $stringSQL);
    }

    if (count($name_child_properties) == 0) {
        $stringSQL = "DELETE FROM `thuoctinh` WHERE `ten_thuoctinhcha` = '". $each['ma_thuoctinh'] . "'";
        mysqli_query($connect, $stringSQL);
    } else {
        $create_date = date('Y-m-d H:i:s');
        $ten_thuoctinhcha = $each['ma_thuoctinh'];
        // add child properties
        foreach ($name_child_properties as $eachChildInput) {
            $check = true;
            foreach ($lstthuoctinhcon as $eachChild) {
                if ($eachChildInput == $eachChild['ten_thuoctinhcon']) {
                    $check = false;
                }
            }
            if ($check) {
                $stringSQL = "SELECT COUNT(*) FROM `thuoctinh`";
                $result = mysqli_query($connect, $stringSQL);
                $row = mysqli_fetch_array($result);
                $count_properties = $row[0];
                $id_properties = "TT" . $count_properties + 1;
                $stringSQL = "INSERT INTO `thuoctinh`(`ma_thuoctinh`, `ten_thuoctinhcha`, `ten_thuoctinhcon`, `ngaytao`) VALUES ('$id_properties', '$ten_thuoctinhcha','$eachChildInput','$create_date')";
                $resultChild = mysqli_query($connect, $stringSQL);
            }
        }
        // delete child properties
        foreach ($lstthuoctinhcon as $eachChild) {
            $check = true;
            foreach ($name_child_properties as $eachChildInput) {
                if ($eachChildInput == $eachChild['ten_thuoctinhcon']) {
                    $check = false;
                }
            }
            if ($check) {
                $stringSQL = "DELETE FROM `thuoctinh` WHERE `id` = '". $eachChild['id'] . "'";
                mysqli_query($connect, $stringSQL);
            }
        }
    }

    $_SESSION['toast-success'] = "Cập nhật thành công";
    header("Location: ./ProductProperties.php");