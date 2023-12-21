<?php
    session_start();
    require_once './ShareAdmin/root/connect.php';

    $name_parent_properties = $_POST['name_parent_properties'];
    $name_child_properties = $_POST['name_child_properties'];
    $name_child_properties = str_replace(', ', ',', $name_child_properties); // remove space
    $name_child_properties = str_replace(' ,', ',', $name_child_properties); // remove space
    $name_child_properties = str_replace(' , ', ',', $name_child_properties); // remove space
    // remove coma at the end of string
    if (substr($name_child_properties, -1) == ',') {
        $name_child_properties = substr($name_child_properties, 0, -1);
    }

    $name_child_properties = explode(',', $name_child_properties); // convert string to array

    // Get count of properties
    $stringSQL = "SELECT COUNT(*) FROM `thuoctinh`";
    $result = mysqli_query($connect, $stringSQL);
    $row = mysqli_fetch_array($result);
    $count_properties = $row[0];
    $id_properties_parent = "TT" . $count_properties + 1;
    $create_date = date('Y-m-d H:i:s');

    // add parent properties
    $stringSQL = "INSERT INTO `thuoctinh`(`ma_thuoctinh`, `ten_thuoctinhcha`, `ten_thuoctinhcon`, `ngaytao`) VALUES ('$id_properties_parent', '$name_parent_properties',null,'$create_date')";
    $result = mysqli_query($connect, $stringSQL);

    // add child properties
    foreach ($name_child_properties as $index => $each) {
        $stringSQL = "SELECT COUNT(*) FROM `thuoctinh`";
        $result = mysqli_query($connect, $stringSQL);
        $row = mysqli_fetch_array($result);
        $count_properties = $row[0];
        $id_properties = "TT" . $count_properties + 1;
        $stringSQL = "INSERT INTO `thuoctinh`(`ma_thuoctinh`, `ten_thuoctinhcha`, `ten_thuoctinhcon`, `ngaytao`) VALUES ('$id_properties', '$id_properties_parent','$each','$create_date')";
        $resultChild = mysqli_query($connect, $stringSQL);
    }
    if ($result) {
        $_SESSION['toast-success'] = "Thêm thành công";
    } else {
        $_SESSION['toast-error'] = "Thêm thất bại";
    }
    header("Location: ./ProductProperties.php");
