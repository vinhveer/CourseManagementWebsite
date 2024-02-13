<?php
    require_once "../../config/connect.php";
    $id = $_GET['id'];
    $sql_edit= "SELECT * FROM user us
    INNER JOIN user_role ur ON us.user_id = ur.user_id
    INNER JOIN user_account ua ON ua.user_id = us.user_id
    where us.user_id=$id";
    $query_update = mysqLi_query($dbconnect, $sql_edit);
    $row_update = mysqli_fetch_assoc($query_update);
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["sbm"])) {
    $name = $_POST['full_name'];
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $birth = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $citizen_id = $_POST['citizen_id'];
    if(empty($image)){
        $image = $row_update['image'];
    }
    function createUsername($str,$dbconnect) {
            $cleanedStr = str_replace(
                array('á', 'à', 'ả', 'ã', 'ạ', 'â', 'ấ', 'ầ', 'ẩ', 'ẫ', 'ậ', 'ă', 'ắ', 'ằ', 'ẳ', 'ẵ', 'ặ', 'đ', 'é', 'è', 'ẻ', 'ẽ', 'ẹ', 'ê', 'ế', 'ề', 'ể', 'ễ', 'ệ', 'í', 'ì', 'ỉ', 'ĩ', 'ị', 'ó', 'ò', 'ỏ', 'õ', 'ọ', 'ô', 'ố', 'ồ', 'ổ', 'ỗ', 'ộ', 'ơ', 'ớ', 'ờ', 'ở', 'ỡ', 'ợ', 'ú', 'ù', 'ủ', 'ũ', 'ụ', 'ư', 'ứ', 'ừ', 'ử', 'ữ', 'ự', 'ý', 'ỳ', 'ỷ', 'ỹ', 'ỵ','Á', 'À', 'Ả', 'Ã', 'Ạ', 'Â', 'Ấ', 'Ầ', 'Ẩ', 'Ẫ', 'Ậ', 'Ă', 'Ắ', 'Ằ', 'Ẳ', 'Ẵ', 'Ặ', 'Đ', 'É', 'È', 'Ẻ', 'Ẽ', 'Ẹ', 'Ê', 'Ế', 'Ề', 'Ể', 'Ễ', 'Ệ', 'Í', 'Ì', 'Ỉ', 'Ĩ', 'Ị', 'Ó', 'Ò', 'Ỏ', 'Õ', 'Ọ', 'Ô', 'Ố', 'Ồ', 'Ổ', 'Ỗ', 'Ộ', 'Ơ', 'Ớ', 'Ờ', 'Ở', 'Ỡ', 'Ợ', 'Ú', 'Ù', 'Ủ', 'Ũ', 'Ụ', 'Ư', 'Ứ', 'Ừ', 'Ử', 'Ữ', 'Ự', 'Ý', 'Ỳ', 'Ỷ', 'Ỹ', 'Ỵ'),
                array('a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'd', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u','u', 'y', 'y', 'y', 'y', 'y','a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'd', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'y', 'y', 'y', 'y', 'y'),$str);
        $username = preg_replace('/[^a-z0-9]/', '', strtolower($cleanedStr));
        return $username;
    }
    function checkusername($username,$dbconnect){
        $query_ac = "SELECT * FROM user_account WHERE username = '$username'";
        $result = mysqli_query($dbconnect, $query_ac);
        $row_ac = mysqli_fetch_assoc($result);
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
    $Tname = createUsername($name,$dbconnect);
    if( $row_update['full_name'] != $name){
        $username = checkusername($Tname,$dbconnect);
    }else{
        $username = $Tname;
    }
    $sql = "UPDATE user SET full_name='$name', date_of_birth = '$birth',gender ='$gender',
    address = '$address',phone = '$phone',email='$email',citizen_id = '$citizen_id',image='$image' WHERE user_id='$id';";
    $query = mysqli_query($dbconnect, $sql);
    if (!$query) {
        echo "Lỗi khi sửa dữ liệu vào bảng user: " . mysqli_error($dbconnect);
    }
    $sql_ua = "UPDATE user_account SET username='$username' WHERE user_id='$id'";
    $query_ua = mysqli_query($dbconnect, $sql_ua);
    if (!$query_ua) {
        echo "Lỗi khi chèn dữ liệu vào bảng user_account: " . mysqli_error($dbconnect);
    }
    if (move_uploaded_file($image_tmp, '../../assets/images/' . $image)) {
        echo 'Upload thành công';
    } else {
        echo 'Lỗi khi upload: ' . error_get_last()['message'];
    }
    mysqli_close($dbconnect);
    $role = $row_update['role_id'];
    if($role == 1){
        header('location: ../student.php');
    }else if($role == 2){
        header('location: ../teacher.php');
    }else if($role == 3){
        header('location: ../admin.php');
    }else{
        echo "Vai trò không tồn tại!";
        exit;
    }
    }
?>
