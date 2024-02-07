<?php
include_once "../../config/connect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['full_name'];
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $birth = $_POST['date_of_birth'];
    $gender = "";
    if ($_POST['gender'] == "Nữ") {
        $gender = "F";
    } else if ($_POST['gender'] == "Nam") {
        $gender = "M";
    } else $gender = "K";
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $citizen_id = $_POST['citizen_id'];
    function createUsername($str,$dbconnect) {
        // Loại bỏ ký tự đặc biệt và dấu
        $cleanedStr = str_replace(
            array('á', 'à', 'ả', 'ã', 'ạ', 'â', 'ấ', 'ầ', 'ẩ', 'ẫ', 'ậ', 'ă', 'ắ', 'ằ', 'ẳ', 'ẵ', 'ặ', 'đ', 'é', 'è', 'ẻ', 'ẽ', 'ẹ', 'ê', 'ế', 'ề', 'ể', 'ễ', 'ệ', 'í', 'ì', 'ỉ', 'ĩ', 'ị', 'ó', 'ò', 'ỏ', 'õ', 'ọ', 'ô', 'ố', 'ồ', 'ổ', 'ỗ', 'ộ', 'ơ', 'ớ', 'ờ', 'ở', 'ỡ', 'ợ', 'ú', 'ù', 'ủ', 'ũ', 'ụ', 'ư', 'ứ', 'ừ', 'ử', 'ữ', 'ự', 'ý', 'ỳ', 'ỷ', 'ỹ', 'ỵ'),
            array('a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'd', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'y', 'y', 'y', 'y', 'y'),$str);
        $username = preg_replace('/[^a-z0-9]/', '', strtolower($cleanedStr));
        return $username;
    }
    function checkusername($username,$dbconnect){
        $query_ac = "SELECT * FROM user_account WHERE username = '$username'";
        $result = mysqli_query($dbconnect, $query_ac);
        $row_ac = mysqli_fetch_assoc($result);
        // Nếu đã tồn tại, thêm số vào username cho đến khi là duy nhất
        if(!empty($row_ac['account_id'])){
            $i = 1;
            $newUsername = "";
            while (mysqli_num_rows($result) > 0) {
                $newUsername = $username . $i;
                $query_row = "SELECT * FROM user_account WHERE username = '$newUsername'";
                $result = mysqli_query($dbconnect, $query_row);
                $i++;
            }
            $username = $newUsername;
        }
        return $username;
    }

    $this_id = $_GET['id'];
    $Tname = createUsername($name,$dbconnect);
    $username = checkusername($Tname,$dbconnect);
    $sql = "INSERT INTO user (full_name, date_of_birth,gender,address,phone,email,citizen_id,image) VALUES ('$name','$birth','$gender','$address','$phone','$email','$citizen_id','$image')";
    $query = mysqli_query($dbconnect, $sql);
    if (!$query) {
        echo "Lỗi khi chèn dữ liệu vào bảng user: " . mysqli_error($dbconnect);
    }

    $user_id = mysqli_insert_id($dbconnect);
    $sql_us = "INSERT INTO user_account(account_id, username, password, user_id) VALUES ('$user_id','$username','dododododo','$user_id')";
    $query_us = mysqli_query($dbconnect, $sql_us);
    if (!$query_us) {
        echo "Lỗi khi chèn dữ liệu vào bảng user_account: " . mysqli_error($dbconnect);
    }

    if ($this_id == 1) {
        $sql_role = "INSERT INTO user_role (user_id,role_id) VALUES ('$user_id','1')";
    }else if ($this_id == 2){
        $sql_role = "INSERT INTO user_role (user_id,role_id) VALUES ('$user_id','2')";
    }else if ($this_id == 3){
        $sql_role = "INSERT INTO user_role (user_id,role_id) VALUES ('$user_id','3')";
    }else{
        echo "Lỗi role không tồn tại: " . mysqli_error($dbconnect);
    }
    $query_role = mysqli_query($dbconnect, $sql_role);
    if (!$query_role) {
        echo "Lỗi khi chèn dữ liệu vào bảng user_role: " . mysqli_error($dbconnect);
    }

    if (move_uploaded_file($image_tmp, '../../assets/images/' . $image)) {
        echo 'Upload thành công';
    } else {
        echo 'Lỗi khi upload: ' . error_get_last()['message'];
    }
    mysqli_close($dbconnect);
    //header('location: ../add_acc.php');
    if($this_id == 1){
        header('location: ../student.php');
    }else if($this_id == 2){
        header('location: ../teacher.php');
    }else if($this_id == 3){
        header('location: ../admin.php');
    }else{
        echo "Vai trò không tồn tại!";
        exit;
    }
}
?>
