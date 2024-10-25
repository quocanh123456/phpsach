<?php
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sách</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Danh sách sách</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link active" aria-current="page" href="index.php">Trang chủ</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div class="container my-3">
        <nav class="alert alert-primary" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Index</li>
            </ol>
        </nav>

        <form class="row" method="POST" enctype="multipart/form-data">
            <div class="col">
                <div class="mb-3">
                    <input type="file" accept=".txt" class="form-control" name="file">
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Import database</button>
            </div>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
                $fileTmpPath = $_FILES['file']['tmp_name'];
                $fileType = $_FILES['file']['type'];

                if ($fileType == 'text/plain') {
                    $server = "localhost";
                    $database = "db_hua_quoc_anh";
                    $username = "root";
                    $password = "";

                    $conn = new mysqli($server, $username, $password, $database);
                    if ($conn->connect_error) {
                        die("Kết nối thất bại: " . $conn->connect_error);
                    }

                    $file = fopen($fileTmpPath, "r");
                    $successfulInserts = 0;
                    $failedInserts = 0;

                    while (($line = fgets($file)) !== false) {
                        list($ten_sach, $nha_xb, $nam_xb, $the_loai, $so_luong, $gia_ban, $link_anh) = explode(",", trim($line));

                        $query = "INSERT INTO thong_tin_sach (ten_sach, nha_xb, nam_xb, the_loai, so_luong, gia_ban, link_anh) 
                                  VALUES ('$ten_sach', '$nha_xb', '$nam_xb', '$the_loai', $so_luong, $gia_ban, '$link_anh')";

                        if ($conn->query($query) === TRUE) {
                            $successfulInserts++;
                        } else {
                            $failedInserts++;
                        }
                    }
                    fclose($file);
                    $conn->close();

                    echo "<div class='alert alert-info mt-2' role='alert'>
                            $successfulInserts records inserted successfully, $failedInserts records failed.
                          </div>";
                } else {
                    echo '<div class="alert alert-warning" role="alert">
                            Vui lòng tải lên file .txt!
                        </div>';
                }
            } else {
                echo '<div class="alert alert-danger" role="alert">
                        Lỗi tải file!
                    </div>';
            }
        }

        // Xử lý yêu cầu xóa sách
        $deleteMessage = '';
        if (isset($_GET['delete'])) {
            $id = $_GET['delete'];
            $conn = new mysqli("localhost", "root", "", "db_hua_quoc_anh");

            if ($conn->connect_error) {
                die('Connect failed: ' . $conn->connect_error);
            }

            $deleteQuery = "DELETE FROM thong_tin_sach WHERE id_sach = $id"; // Giả sử bạn có cột id trong bảng
            if ($conn->query($deleteQuery) === TRUE) {
                $deleteMessage = '<div class="alert alert-success alert-dismissible fade show" role="alert">Xóa sách thành công!</div>';
            } else {
                $deleteMessage = '<div class="alert alert-danger alert-dismissible fade show" role="alert">Xóa sách thất bại: ' . $conn->error . '</div>';
            }

            $conn->close();
        }
        ?>

        <hr>

        <?php
        // Kết nối database để hiển thị danh sách sách
        $conn = new mysqli("localhost", "root", "", "db_hua_quoc_anh");

        if ($conn->connect_error) {
            die('Connect failed: ' . $conn->connect_error);
        }

        $query = "SELECT * FROM thong_tin_sach";
        $result = $conn->query($query);

        echo '<div class="row row-cols-1 row-cols-md-2 g-4">';
        if ($result->num_rows > 0) {
            while ($sach = $result->fetch_assoc()) {
        ?>
                <div class="col">
                    <div class="card">
                        <img src="<?= htmlspecialchars($sach['link_anh']) ?>" class="card-img-top" alt="<?= htmlspecialchars($sach['ten_sach']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($sach['ten_sach']) ?></h5>
                            <p class="card-text">Nhà xuất bản: <?= htmlspecialchars($sach['nha_xb']) ?></p>
                            <p class="card-text">Năm xuất bản: <?= htmlspecialchars($sach['nam_xb']) ?></p>
                            <p class="card-text">Thể loại: <?= htmlspecialchars($sach['the_loai']) ?></p>
                            <p class="card-text">Số lượng: <?= htmlspecialchars($sach['so_luong']) ?></p>
                            <p class="card-text">Giá bán: <?= htmlspecialchars($sach['gia_ban']) ?> VND</p>
                            <a href="?delete=<?= $sach['id_sach'] ?>" class="btn btn-danger">Xóa</a> <!-- Nút xóa -->
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "<p>Không có sách nào trong cơ sở dữ liệu.</p>";
        }
        echo '</div>';

        $conn->close();

        // Hiển thị thông báo xóa sách
        if ($deleteMessage) {
            echo $deleteMessage;
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tìm các alert có lớp "alert-dismissible"
            var alerts = document.querySelectorAll('.alert-dismissible');

            alerts.forEach(function(alert) {
                // Đặt thời gian chờ 3 giây
                setTimeout(function() {
                    alert.classList.remove('show');
                    alert.classList.add('fade');
                    alert.style.display = 'none'; // Ẩn thông báo
                }, 3000); // 3000 milliseconds = 3 seconds
            });
        });
    </script>
</body>

</html>
