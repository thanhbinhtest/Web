<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VySoul Cosmetic</title>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="./Public/css/reset.css">
    <link rel="stylesheet" type="text/css" href="./Public/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" type="text/css" href="./Public/css/Responsive.css">
    <link rel="icon" href="Public/Image/logooo.png" type="image/png">
    <style>
    #snow {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 9999;
    }

    .snowflake {
    position: absolute;
    top: -10px;
    font-size: 2em; /* Kích thước của bông tuyết */
    color: #b3e5fc; /* Màu xanh nhạt cho bông tuyết */
    background: none; /* Đảm bảo không có nền */
    border-radius: 0; /* Không tạo hình dạng tròn cho phần nền */
    opacity: 0.8;
    pointer-events: none;
    animation: fall linear infinite;
}



    @keyframes fall {
        0% {
            transform: translateY(0);
        }
        100% {
            transform: translateY(100vh);
        }
    }
</style>

</head>

<body>
    <?php
    require_once "./mvc/Views/User/blocks/Header.php";
    ?>

    <div class="contain">
        <?php require_once "./mvc/Views/User/pages/" . $data["page"] . ".php" ?>
    </div>

    <?php
    require_once "./mvc/Views/User/blocks/Footer.php";
    require_once "./mvc/Views/User/blocks/ScrollTop.php";
    ?>

    <script type="text/javascript" src="./Public/js/script.js"></script>
    <script type="text/javascript" src="./Public/js/ajax.js"></script>
    <script type="text/javascript" src="./Public/js/mobile.js"></script>
<script>
// Hàm createSnowflakes - thực hiện chức năng chính của hàm createSnowflakes
    function createSnowflakes() {
        const snowContainer = document.getElementById('snow');
        const snowflakeCount = 100; // Số lượng bông tuyết

        for (let i = 0; i < snowflakeCount; i++) {
            const snowflake = document.createElement('div');
            snowflake.classList.add('snowflake');
            snowflake.innerHTML = '❄'; // Thêm ký tự bông tuyết Unicode

            // Kích thước ngẫu nhiên cho mỗi bông tuyết
            const size = Math.random() * 10 + 10 + 'px';
            snowflake.style.fontSize = size;

            // Vị trí bắt đầu ngẫu nhiên
            snowflake.style.left = Math.random() * 100 + 'vw';

            // Thời gian rơi ngẫu nhiên
            const duration = Math.random() * 5 + 5 + 's';
            snowflake.style.animationDuration = duration;

            // Độ trễ ngẫu nhiên
            const delay = Math.random() * 10 + 's';
            snowflake.style.animationDelay = delay;

            // Thêm bông tuyết vào trang
            snowContainer.appendChild(snowflake);
        }
    }

    createSnowflakes();
</script>


</body>

</html>