<?php
include_once("E_Login.php");

class M_Login {

function accept($name, $pass){
    $link = mysqli_connect("localhost", "root", "")
    or die('Không thể kết nối đến cơ sở dữ liệu');
    mysqli_select_db($link, "qlnspb");
    
    $sql = "SELECT * FROM admin WHERE username = '$name' AND password = '$pass'";

    $result = mysqli_query($link, $sql);

    // Đóng kết nối đến cơ sở dữ liệu
    mysqli_close($link);

    // Chuyển kết quả thành mảng để trả về
    $resultArray = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $resultArray[] = $row;
    }

    return $resultArray;
}
}
?>