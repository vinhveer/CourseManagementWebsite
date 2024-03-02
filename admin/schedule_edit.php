<?php
include("layout.php");
include_once("../config/connect.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$course_id = isset($_GET['id']) ? $_GET['id'] : '';
$sql_schedule = "SELECT * FROM course_schedule cs
INNER JOIN course c ON cs.course_id = c.course_id
WHERE cs.course_id = '$course_id'";
$result = mysqli_query($dbconnect, $sql_schedule);
$data = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}
mysqli_close($dbconnect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <title>Sửa thời khóa biểu</title>
</head>

<body>
    <header class="container mt-5">
        <h3>Sửa thời khóa biểu</h3>
        <p>Cập nhật thông tin thời khóa biểu dưới đây</p>
    </header>
    <div class="container mt-5">
        <form id="scheduleForm" action="process.php" method="post" class="needs-validation" novalidate>
            <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
            <div id="additionalTimes" class="mb-3 row">
                <?php foreach ($data as $row): ?>
                    <div class="mb-3 row">
                    <input type="hidden" name="schedule_id[]" value="<?php echo isset($row['course_schedule_id']) ? $row['course_schedule_id'] : ''; ?>">
                        <label for="dayOfWeek" class="col-sm-2 col-form-label">Ngày trong tuần</label>
                        <div class="col-sm-2">
                            <select class="form-select" name="dayOfWeek[]" required>
                                <option value="" disabled>Chọn ngày</option>
                                <option value="monday" <?php if ($row['day_of_week'] == '2') echo 'selected'; ?>>Thứ hai</option>
                                <option value="tuesday" <?php if ($row['day_of_week'] == '3') echo 'selected'; ?>>Thứ ba</option>
                                <option value="wednesday" <?php if ($row['day_of_week'] == '4') echo 'selected'; ?>>Thứ tư</option>
                                <option value="thursday" <?php if ($row['day_of_week'] == '5') echo 'selected'; ?>>Thứ năm</option>
                                <option value="friday" <?php if ($row['day_of_week'] == '6') echo 'selected'; ?>>Thứ sáu</option>
                                <option value="saturday" <?php if ($row['day_of_week'] == '7') echo 'selected'; ?>>Thứ bảy</option>
                                <option value="sunday" <?php if ($row['day_of_week'] == 'C') echo 'selected'; ?>>Chủ nhật</option>
                            </select>
                        </div>
                        <label for="startTime" class="col-sm-1 col-form-label">Bắt đầu</label>
                        <div class="col-sm-2">
                            <input type="time" class="form-control" name="startTime[]" value="<?php echo $row['start_time']; ?>" required>
                        </div>
                        <label for="endTime" class="col-sm-1 col-form-label">Kết thúc</label>
                        <div class="col-sm-2">
                            <input type="time" class="form-control" name="endTime[]" value="<?php echo $row['end_time']; ?>" required>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-danger" onclick="removeTimeRow(this)"> Xóa hàng </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="mb-3 row">
                <div class="col-sm-12">
                <?php  mysqli_data_seek($result, 0); $row = mysqli_fetch_assoc($result)?>
                    <button type="button" class="btn btn-primary" onclick="addTimeRow()">Thêm thời gian</button>
                    <button type="submit" class="btn btn-primary" name="update_schedule">Cập nhật thời khóa biểu</button>
                    <a href="course_show.php?id=<?php echo $course_id;?>&teacher_id=<?php echo $row['teacher_id'];?>" type="button" class="btn btn-secondary">Quay lại</a>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-rqI2waM7CtpVHmUnY9NXfQTKc3N8RBLtbl6TbY3b3NC6HjbF2wF81v11z5KnMK17" crossorigin="anonymous">
    </script>
    <script>
        // Function to add dynamic time rows
        function addTimeRow() {
            var additionalTimesContainer = document.getElementById('additionalTimes');

            var newRow = document.createElement('div');
            newRow.className = 'mb-3 row';

            newRow.innerHTML = `
                <label for="dayOfWeek" class="col-sm-2 col-form-label">Ngày trong tuần</label>
                <div class="col-sm-2">
                    <select class="form-select" name="dayOfWeek[]" required>
                        <option value="" disabled selected>Chọn ngày</option>
                        <option value="monday">Thứ hai</option>
                        <option value="tuesday">Thứ ba</option>
                        <option value="wednesday">Thứ tư</option>
                        <option value="thursday">Thứ năm</option>
                        <option value="friday">Thứ sáu</option>
                        <option value="saturday">Thứ bảy</option>
                        <option value="sunday">Chủ nhật</option>
                    </select>
                </div>
                <label for="startTime" class="col-sm-1 col-form-label">Bắt đầu</label>
                <div class="col-sm-2">
                    <input type="time" class="form-control" name="startTime[]" required>
                </div>
                <label for="endTime" class="col-sm-1 col-form-label">Kết thúc</label>
                <div class="col-sm-2">
                    <input type="time" class="form-control" name="endTime[]" required>
                </div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-danger" onclick="removeTimeRow(this)"> Xóa hàng </button>
                </div>
            `;

            additionalTimesContainer.appendChild(newRow);
        }

        // Function to remove dynamic time rows
        function removeTimeRow(button) {
            var additionalTimesContainer = document.getElementById('additionalTimes');
            var rowToRemove = button.closest('.row');
            additionalTimesContainer.removeChild(rowToRemove);
        }
    </script>
        <?php include("../footer.php"); ?>
</body>

</html>
