<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Chat Box</title>
</head>

<body>
    <div class="card mt-3">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h3>Tên khóa học</h3>
                </div>
                <div class="col-6 text-right">
                    <button type="button" class="btn btn-primary">Vào cuộc họp online</button>
                </div>
            </div>
        </div>
        <div class="card-body" style="height: 70vh; overflow-y: auto;">
            <!-- Hiển thị tin nhắn ở đây -->
            <div class="incoming-message d-flex align-items-center">
                <img class="rounded-circle mr-2" width="35" src="../../assets/images/course1.jpg" alt="avatar">
                <span class="rounded-5 p-2" style="background-color: #f0f0f0;">Nội dung tin nhắn...</span>
                <div></div>
            </div>
            <div class="outgoing-message text-right flex ">
                <span class="rounded-5 p-2" style="background-color: #f0f0f0;">Nội dung tin nhắn...</span>
                <div></div>
            </div>
            <!-- Thêm các tin nhắn khác tương tự ở đây -->
        </div>
        <div class="card-footer">
            <div class="input-group">
                <div class="input-group-prepend">
                    <button class="btn btn-outline-secondary rounded-circle border-0" type="button"><i class="fas fa-image"></i></button>
                    <button class="btn btn-outline-secondary rounded-circle border-0 mr-2" type="button"><i class="fas fa-paperclip"></i></button>
                </div>
                <textarea class="form-control rounded-pill" style="resize: none;" placeholder="Nhập tin nhắn..." rows="1"></textarea>
                <div class="input-group-append">
                    <button class="btn btn-primary rounded-pill ml-2 d-flex align-items-center" type="button">Gửi</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Script Bootstrap và jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>