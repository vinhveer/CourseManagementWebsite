<footer class="bd-footer py-4 py-md-5 mt-5 bg-body-tertiary">
    <div class="container py-4 py-md-5 px-4 px-md-3 text-body-secondary">
        <div class="row">
            <div class="col-12 col-md">
                <h5>LMS</h5>
                <small class="d-block mb-3 text-body-secondary">&copy; 2023–2024</small>
            </div>
            <div class="col-6 col-md">
                <h5>Truy cập đến</h5>
                <ul class="list-unstyled text-small">
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="../index.php">Trang chủ</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Trang theo dõi</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="index.php">Trang chủ quản trị</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>Thông tin đăng nhập</h5>
                <?php
                if (isset($username_now)) {
                    echo '<ul class="list-unstyled text-small">
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Tư cách đăng nhập: ' . $username_now . '</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="my.php">Trang cá nhân</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="../../logout.php">Đăng xuất</a></li>
                    </ul>';
                } else {
                    echo '<ul class="list-unstyled text-small">
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Bạn chưa đăng nhập</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="my.php">Trang cá nhân</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="../../logout.php">Đăng xuất</a></li>
                    </ul>';
                }
                ?>
            </div>
        </div>
    </div>
</footer>
