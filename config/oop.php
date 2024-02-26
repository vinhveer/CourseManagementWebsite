<?php
// Biến chứa chuỗi nhập vào từ iframe
$iframeInput = '<iframe width="560" height="315" src="https://www.youtube.com/embed/zYNoE_SSrNs?si=4cNEs1wI20WX5_OZ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';

// Hàm để trích xuất đường dẫn từ chuỗi iframe
function extractVideoURL($iframeInput) {
    // Sử dụng biểu thức chính quy để tìm chuỗi src
    $pattern = '/src="([^"]+)"/';
    preg_match($pattern, $iframeInput, $matches);

    // Nếu tìm thấy, trả về phần tử thứ nhất của mảng $matches, nơi chứa đường dẫn
    if (isset($matches[1])) {
        return $matches[1];
    } else {
        return false; // Trả về false nếu không tìm thấy
    }
}

// Lấy đường dẫn từ iframe
$videoURL = extractVideoURL($iframeInput);

// In ra đường dẫn
echo "Đường dẫn video: " . $videoURL;
?>
