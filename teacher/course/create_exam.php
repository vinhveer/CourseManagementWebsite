<?php
include("layout.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo bài kiểm tra mới</title>
</head>

<body>
    <header class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <h3>Tạo bài kiểm tra mới</h3>
            </div>
            <div class="col-md-6">
                <a class="btn btn-primary float-end me-2" href="add_content_heading.php">Lưu nội dung</a>
            </div>
        </div>
    </header>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-primary me-2" href="add_content_heading.php">+ Thêm câu hỏi trắc nghiệm</a>
                <a class="btn btn-primary me-2" href="add_content_heading.php">+ Thêm câu hỏi tự luận</a>
            </div>
            <div class="col-md-6">
                <a class="btn btn-primary me-2 float-end" href="add_content_heading.php">Thay đổi số điểm tối đa</a>
                <a class="btn btn-primary me-2 float-end" href="add_content_heading.php">Tự động chia điểm</a>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card mt-2">
                    <div class="card-body">
                        <p class="type-question"><b>Chọn một đáp án đúng</b></p>
                        <h6 class="card-title">Câu 1</h6>
                        <p>Con gà có trước hay quả trứng có trước</p>
                        <hr class="info-divider">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Con gà
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Quả trứng
                            </label>
                        </div>
                    </div>
                </div>
                <div class="card mt-2">
                    <div class="card-body">
                        <p class="type-question"><b>Chọn một hoặc nhiều đáp án đúng</b></p>
                        <h6 class="card-title">Câu 2</h6>
                        <p>Những hành tinh nào thuộc hệ Mặt Trời?</p>
                        <hr class="info-divider">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Trái đất
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="flexRadioDefault" id="flexRadioDefault2">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Sao Hỏa
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="flexRadioDefault" id="flexRadioDefault2">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Sao diêm vương
                            </label>
                        </div>
                    </div>
                </div>
                <div class="card mt-2">
                    <div class="card-body">
                        <p class="type-question"><b>Nhập câu trả lời </b></p>
                        <h6 class="card-title">Câu 3</h6>
                        <p>Lệnh nào để copy trong linux?</p>
                        <hr class="info-divider">
                        <input class="form-control" type="text" id="formFile" placeholder="Nhập đáp án đúng">
                    </div>
                </div>
                <div class="card mt-2">
                    <div class="card-body">
                        <p class="type-question"><b>Tải lên đáp án</b></p>
                        <h6 class="card-title">Câu 4</h6>
                        <p>Viết chương trình tính căn bậc hai, sử dụng Python</p>
                        <hr class="info-divider">
                        <p>Tải lên file (Kích thước tối đa: 20MB)</p>
                        <input class="form-control" type="file" id="formFile">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mt-2">
                    <div class="card-body">
                        <h6>Điều hướng câu hỏi</h6>
                        <hr class="info-divider">
                        <div class="d-flex justify-content-center">
                            <div class="p-2 bg-secondary text-white rounded me-2">1 <i class="bi bi-question-square-fill"></i></div>
                            <div class="p-2 bg-secondary text-white rounded me-2">2 <i class="bi bi-question-square-fill"></i></div>
                            <div class="p-2 bg-secondary text-white rounded me-2">3 <i class="bi bi-question-square-fill"></i></div>
                            <div class="p-2 bg-secondary text-white rounded me-2">4 <i class="bi bi-question-square-fill"></i></div>
                            <div class="p-2 bg-secondary text-white rounded me-2">5 <i class="bi bi-question-square-fill"></i></div>
                            <div class="p-2 bg-secondary text-white rounded me-2">6 <i class="bi bi-question-square-fill"></i></div>
                            <div class="p-2 bg-secondary text-white rounded me-2">7 <i class="bi bi-question-square-fill"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("../../footer.php"); ?>
</body>

</html>