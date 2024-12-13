<?php
// Định nghĩa lớp chính và các thuộc tính, phương thức của lớp
    class Database
    {
        public $connect;

        public function __construct()
        {
            // Thông tin kết nối cơ sở dữ liệu
            $host = '127.0.0.1';
            $username = 'u378271986_meowwhousee';
            $password = 'VoMinhPhuc123';
            $database = 'u378271986_MyPham';
            $port = '3306';

            // Kết nối tới MySQL
            $this->connect = new mysqli($host, $username, $password, $database, $port);

            // Kiểm tra kết nối
            if ($this->connect->connect_error) {
                die("Kết nối thất bại: " . $this->connect->connect_error);
            }
        }

        // Phương thức trả về kết nối cơ sở dữ liệu
        public function getConnection()
        {
            return $this->connect;
        }
    }
?>
