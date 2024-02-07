<?php
include('layout.php');
include_once('../../../config/connect.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['course_id'])) {
    $course_id = $_SESSION['course_id'];
    $sql = "SELECT * FROM grade_column WHERE course_id = $course_id";
    $result = mysqli_query($dbconnect, $sql);

    if (!$result) {
        die('Query failed: ' . mysqli_error($dbconnect));
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <title>Điểm số</title>
</head>

<body>

    <header class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <h3>Danh sách các cột điểm</h3>
            </div>
            <div class="col-md-6">
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Tìm kiếm theo tên ..."
                        aria-label="Tìm kiếm">
                    <button class="btn btn-outline-primary" type="submit">Tìm</button>
                </form>
            </div>
        </div>
    </header>

    <div class="modal fade" id="editGradeColumnModal" tabindex="-1" aria-labelledby="editGradeColumnModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editGradeColumnModalLabel">Chỉnh sửa cột điểm</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="editColumnName" class="col-form-label">Tên cột điểm</label>
                            <input type="text" class="form-control" id="editColumnName">
                        </div>
                        <div class="mb-3">
                            <label for="editProportion" class="col-form-label">Tỉ lệ tích lũy</label>
                            <input type="text" class="form-control" id="editProportion">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" onclick="saveChanges()">Lưu thay đổi</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <section class="mt-4">
            <table class="table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã cột điểm</th>
                        <th>Tên cột điểm</th>
                        <th>Tỉ lệ tích lũy</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Đặt con trỏ kết quả về đầu để có thể duyệt lại từ đầu
                    mysqli_data_seek($result, 0);

                    $index = 0;
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?php echo ++$index; ?></td>
                        <td><?php echo $row['column_id']; ?></td>
                        <td><?php echo $row['grade_column_name']; ?></td>
                        <td><?php echo $row['proportion']; ?></td>
                        <td>
                            <button type="button" class="btn btn-primary"
                                onclick="editGradeColumn('<?php echo $row['column_id']; ?>', '<?php echo $row['grade_column_name']; ?>', '<?php echo $row['proportion']; ?>')">Sửa</button>
                        </td>
                        <td><button class="btn btn-primary">Nhập điểm cho cột này</button></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script>
        function editGradeColumn(columnId, columnName, proportion) {
            // Set values in modal
            document.getElementById('editColumnName').value = columnName;
            document.getElementById('editProportion').value = proportion;

            // Show the modal
            $('#editGradeColumnModal').modal('show');
        }

        function saveChanges() {
            // Add logic to save changes here
            // You can use JavaScript or AJAX to send the updated data to the server
            // After saving, you may want to close the modal
            $('#editGradeColumnModal').modal('hide');
        }
    </script>

</body>

</html>
