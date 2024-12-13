<?php
// Định nghĩa lớp chính và các thuộc tính, phương thức của lớp
    class TinTucModel extends Database
    {
        public function __construct()
        {
            // Gọi hàm khởi tạo từ class cha (Database) để thiết lập kết nối
            parent::__construct();
        }

        public function loadNews()
        {
            // Sử dụng kết nối từ class cha (Database) thông qua phương thức getConnection()
            $query = "SELECT * FROM tintuc";
            $result = mysqli_query($this->getConnection(), $query);

            $arr = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $arr[] = $row;
            }

            return json_encode($arr);
        }
    }
?>
