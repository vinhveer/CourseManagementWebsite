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
            <div class="col-md-9">
                <li class="btn btn-primary me-2 dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Thêm câu hỏi trắc nghiệm
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#one_answer" href="#">Câu hỏi có một đáp án đúng</a></li>
                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#more_answer">Câu hỏi có nhiều đáp án đúng</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#short_answer">Câu hỏi trả lời ngắn</a></li>
                    </ul>
                </li>
                <a class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#assignment">+ Thêm câu hỏi tự luận</a>
                <a class="btn btn-primary me-2" href="bank_question.php">+ Thêm từ ngân hàng câu hỏi</a>
            </div>
            <div class="col-md-3">
                <a class="btn btn-primary me-2 float-end" data-bs-toggle="modal" data-bs-target="#setup_score">Cài đặt</a>
            </div>
        </div>
    </div>
    <div class="modal fade modal-xl" id="one_answer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tạo câu hỏi có một đáp án đúng</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container mt-4">
                        <div class="row">
                            <div class="col-md-10">
                                <label for="question_title" class="form-label">Nội dung câu hỏi</label>
                                <input type="text" class="form-control" id="question_title" name="question_title" required>
                            </div>
                            <div class="col-md-2">
                                <label for="question_title" class="form-label">Số điểm</label>
                                <input type="text" class="form-control" id="question_title" name="question_title" required>
                            </div>
                        </div>
                    </div>
                    <div class="container mt-4">
                        <button type="button" class="btn btn-primary" onclick="addAnswerRow()">+ Thêm đáp án</button>
                        <button type="button" class="btn btn-primary me-2" data-bs-dismiss="modal" aria-label="Close">Lưu câu hỏi</button>
                    </div>
                    <div class="container mt-3">
                        <form action="process.php" method="post">
                            <div id="additionalAnswersContainer"></div>
                        </form>
                    </div>

                    <script>
                        // Function to add dynamic answer rows
                        function addAnswerRow() {
                            var additionalAnswersContainer = document.getElementById('additionalAnswersContainer');

                            var newRow = document.createElement('div');
                            newRow.className = 'row mb-3';

                            newRow.innerHTML = `
                                <div class="col-md-9">
                                    <label for="dynamic_answer" class="form-label">Đáp án</label>
                                    <input type="text" class="form-control" name="dynamic_answer[]" required>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check form-check-inline mt-4">
                                        <input class="form-check-input" type="checkbox" value="" name="dynamic_correct_answer[]">
                                        <label class="form-check-label" for="dynamic_correct_answer">
                                            Đáp án đúng
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-danger float-end" onclick="removeAnswerRow(this)"><i class="bi bi-trash3"></i></button>
                                </div>
                            `;

                            additionalAnswersContainer.appendChild(newRow);
                        }

                        // Function to remove dynamic answer rows
                        function removeAnswerRow(button) {
                            var additionalAnswersContainer = document.getElementById('additionalAnswersContainer');
                            var rowToRemove = button.closest('.row');
                            additionalAnswersContainer.removeChild(rowToRemove);
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-xl" id="more_answer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="moreAnswerLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="moreAnswerLabel">Tạo câu hỏi có nhiều đáp án đúng</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container mt-4">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="question_title" class="form-label">Nội dung câu hỏi</label>
                                <input type="text" class="form-control" id="question_title" name="question_title" required>
                            </div>
                        </div>
                    </div>
                    <div class="container mt-4">
                        <button type="button" class="btn btn-primary" onclick="addMoreAnswerRow()">+ Thêm đáp án</button>
                    </div>
                    <div class="container mt-3">
                        <form action="process.php" method="post">
                            <div id="additionalMoreAnswersContainer"></div>
                        </form>
                    </div>
                    <script>
                        // Function to add dynamic answer rows
                        function addMoreAnswerRow() {
                            var additionalMoreAnswersContainer = document.getElementById('additionalMoreAnswersContainer');

                            var newRow = document.createElement('div');
                            newRow.className = 'row mb-3';

                            newRow.innerHTML = `
                                <div class="col-md-8">
                                    <label for="dynamic_answer" class="form-label">Đáp án</label>
                                    <input type="text" class="form-control" name="dynamic_answer[]" required>
                                </div>
                                <div class="col-md-1" id="scoreInput">
                                    <label for="dynamic_score" class="form-label">Số điểm</label>
                                    <input type="number" class="form-control" name="dynamic_score[]" required>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-check form-check-inline mt-4">
                                        <input class="form-check-input" type="checkbox" value="" name="dynamic_correct_answer[]">
                                        <label class="form-check-label" for="dynamic_correct_answer">
                                            Đáp án đúng
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-danger float-end" onclick="removeMoreAnswerRow(this)"><i class="bi bi-trash3"></i></button>
                                </div>
                            `;

                            additionalMoreAnswersContainer.appendChild(newRow);
                        }

                        // Function to remove dynamic answer rows
                        function removeMoreAnswerRow(button) {
                            var additionalMoreAnswersContainer = document.getElementById('additionalMoreAnswersContainer');
                            var rowToRemove = button.parentNode.parentNode;
                            additionalMoreAnswersContainer.removeChild(rowToRemove);
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-xl" id="short_answer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="moreAnswerLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="moreAnswerLabel">Tạo câu hỏi trả lời ngắn</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container mt-4">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="question_title" class="form-label">Nội dung câu hỏi</label>
                                <input type="text" class="form-control" id="question_title" name="question_title" required>
                            </div>
                        </div>
                    </div>
                    <div class="container mt-4">
                        <button type="button" class="btn btn-primary" onclick="addShortAnswerRow()">+ Thêm đáp án</button>
                    </div>
                    <div class="container mt-3">
                        <form action="process.php" method="post">
                            <div id="additionalShortAnswersContainer"></div>
                        </form>
                    </div>
                    <script>
                        // Function to add dynamic answer rows
                        // Function to add dynamic answer rows
                        function addShortAnswerRow() {
                            var additionalShortAnswersContainer = document.getElementById('additionalShortAnswersContainer');

                            var newRow = document.createElement('div');
                            newRow.className = 'row mb-3';

                            newRow.innerHTML = `
                                <div class="col-md-8">
                                    <label for="dynamic_answer" class="form-label">Đáp án</label>
                                    <input type="text" class="form-control" name="dynamic_answer[]" required>
                                </div>
                                <div class="col-md-2" id="scoreInput">
                                    <label for="dynamic_score" class="form-label">Số điểm</label>
                                    <input type="number" class="form-control" name="dynamic_score[]" required>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger float-end" onclick="removeShortAnswerRow(this)"><i class="bi bi-trash3"></i></button>
                                </div>
                            `;

                            additionalShortAnswersContainer.appendChild(newRow);
                        }

                        // Function to remove dynamic answer rows
                        function removeShortAnswerRow(button) {
                            var additionalShortAnswersContainer = document.getElementById('additionalShortAnswersContainer');
                            var rowToRemove = button.parentNode.parentNode;
                            additionalShortAnswersContainer.removeChild(rowToRemove);
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-xl" id="assignment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="assignmentLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="assignmentLabel">Tạo câu hỏi tự luận</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container mt-4">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="question_title" class="form-label">Nội dung câu hỏi</label>
                                <input type="text" class="form-control" id="question_title" name="question_title" required>
                            </div>
                        </div>
                    </div>
                    <div class="container mt-4">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Dạng câu trả lời</option>
                            <option value="1">Tải file lên hệ thống</option>
                            <option value="2">Dạng text</option>
                        </select>
                    </div>
                    <div class="container mt-4">
                        <button type="button" class="btn btn-primary">Lưu câu hỏi</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="setup_score" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="setupScoreLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="setupScoreLabel">Cài đặt điểm số</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container mt-4">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="question_title" class="form-label">Số điểm tối đa</label>
                                <input type="text" class="form-control" id="question_title" name="question_title" required>
                            </div>
                        </div>
                    </div>
                    <div class="container mt-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Default switch checkbox input</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                            <label class="form-check-label" for="flexSwitchCheckChecked">Checked switch checkbox input</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" disabled>
                            <label class="form-check-label" for="flexSwitchCheckDisabled">Disabled switch checkbox input</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckCheckedDisabled" checked disabled>
                            <label class="form-check-label" for="flexSwitchCheckCheckedDisabled">Disabled checked switch checkbox input</label>
                        </div>
                    </div>
                    <div class="container mt-4">
                        <button type="button" class="btn btn-primary">Lưu câu hỏi</button>
                    </div>
                </div>
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