<?php
include('layout.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
    <title>Xem nội dung</title>
</head>

<body>
    <header class="container mt-4">
        <h3><a href="content.php"><i class="bi bi-arrow-left-circle"></i></a>
            Tài liệu tham khảo</h3>
    </header>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <p>
                    <b>Tạo bởi: </b> <img src="../../assets/images/64132675.png" alt="Avatar" class="img-fluid rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
                    <span>Trần Thanh Trí</span>
                </p>
            </div>
            <div class="col-md-6">
                <p class="float-end">
                    <b>Ngày tạo: </b>24/12/2023
                    <b> - Thời lượng hoàn thành:</b> 9 phút
                </p>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <iframe id="inlineFrameExample" title="Inline Frame Example" width="100%" height="800" src="../../assets\OCA-Oracle-Certified-Associate-Java-SE-8-Programmer-I-Study-Guide-Exam-1Z0-808.pdf">
        </iframe>
    </div>
    <?php include("../../footer.php"); ?>
</body>

</html>