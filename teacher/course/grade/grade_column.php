<?php
include('layout.php');
include_once('../../../config/connect.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['course_id'])) {
    $course_id = $_SESSION['course_id'];
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['timkiem'])) {
        $tukhoa = $_POST['tukhoa'];
        $keyword = strtolower(trim($tukhoa));
        $keyword = str_replace(' ', '', $keyword);
        $sql = "SELECT * FROM grade_column WHERE course_id = $course_id AND
        (LOWER(REPLACE(REPLACE(REPLACE(REPLACE(grade_column_name, ' ', ''), 'Đ', 'D'),'đ','d'), ' ', '')) LIKE '%$keyword%' OR grade_column_name LIKE '%$tukhoa%')";
        $result = mysqli_query($dbconnect, $sql);
        if (!$result) {
            // Query execution failed
            die('Query failed: ' . mysqli_error($dbconnect));
        }
    } else {
        $sql = "SELECT * FROM grade_column WHERE course_id = $course_id";
        $result = mysqli_query($dbconnect, $sql);

        if (!$result) {
            die('Query failed: ' . mysqli_error($dbconnect));
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Điểm số</title>
</head>

<body>
    <header class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <h3>Danh sách các cột điểm</h3>
            </div>
            <div class="col-md-4">
                <form class="d-flex" action="grade_column.php" method="POST">
                    <div class="input-group">
                        <input type="search" class="form-control me-2" placeholder="Tìm kiếm theo tên..." name="tukhoa" aria-label="Tìm kiếm">
                        <button class="btn btn-outline-primary" type="submit" name="timkiem" value="find">Tìm kiếm</button>
                    </div>
                </form>
                <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['timkiem'])) { ?>
                    <div class="row mt-3">
                        <div class="col">
                            <?php
                            $tukhoa = $_POST['tukhoa'];
                            echo "<p>Tìm kiếm với từ khóa: '<strong>$tukhoa</strong>'</p>";
                            ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-primary float-end" onclick="createGradeColumn()">Tạo cột điểm mới</button>
            </div>
        </div>
    </header>

    <div class="modal fade" id="editGradeColumnModal" tabindex="-1" aria-labelledby="editGradeColumnModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editGradeColumnModalLabel">Chỉnh sửa cột điểm</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="process.php" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editColumnName" class="col-form-label">Tên cột điểm</label>
                            <input type="text" class="form-control" id="editColumnName" name="editColumnName">
                        </div>
                        <div class="mb-3">
                            <label for="editProportion" class="col-form-label">Tỉ lệ tích lũy</label>
                            <input type="text" class="form-control" id="editProportion" name="editProportion">
                        </div>
                        <!-- Add a hidden input for column id -->
                        <input type="hidden" id="editColumnId" name="editColumnId">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary" id="update_grade_column" name="update_grade_column">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="createGradeColumnModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Tạo cột điểm mới</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="process.php" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="col-form-label">Tên cột điểm</label>
                            <input type="text" class="form-control" id="columnName" name="columnName">
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Tỉ lệ tích lũy</label>
                            <input type="text" class="form-control" id="proportion" name="proportion">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary" id="create_grade_column" name="create_grade_column">Lưu cột điểm</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteGradeColumnModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Xóa cột điểm này?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="process.php" method="post" id="deleteGradeColumnForm">
                    <div class="modal-body">
                        <p>Khi xóa cột điểm này, tất cả dữ liệu điểm của học sinh sẽ bị xóa.</p>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="columnId" name="column_id">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-danger" id="delete_grade_column" name="delete_grade_column">Xóa cột điểm</button>
                    </div>
                </form>
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
                        <tr data-column-id="<?php echo $row['column_id']; ?>">
                            <td><?php echo ++$index; ?></td>
                            <td><?php echo $row['column_id']; ?></td>
                            <td class="editColumnName"><?php echo $row['grade_column_name']; ?></td>
                            <td class="editProportion"><?php echo $row['proportion']; ?></td>
                            <td class="float-end">
                                <button type="button" class="btn btn-primary" onclick="editGradeColumn('<?php echo $row['column_id']; ?>', '<?php echo $row['grade_column_name']; ?>', '<?php echo $row['proportion']; ?>')">Sửa thuộc tính</button>
                                <a class="btn btn-primary" href="insert_grade_column.php?id=<?php echo $row['column_id'] ?>">Nhập điểm cho cột này</a>
                            </td>
                            <td>
                                <button class="btn btn-danger" name="delete_grade_column" onclick="deleteGradeColumn('<?php echo $row['column_id'] ?>')">Xóa cột điểm</button>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script>
        function editGradeColumn(columnId, columnName, proportion) {
            // Set values in modal
            document.getElementById('editColumnName').value = columnName;
            document.getElementById('editProportion').value = proportion;
            document.getElementById('editColumnId').value = columnId;

            // Show the modal
            $('#editGradeColumnModal').modal('show');
        }

        function createGradeColumn() {
            $('#createGradeColumnModal').modal('show');
        }

        function deleteGradeColumn(columnId) {
            $('#columnId').val(columnId);
            $('#deleteGradeColumnModal').modal('show');
        }
    </script>
    <?php include("../../../footer.php"); ?>
</body>

</html>
