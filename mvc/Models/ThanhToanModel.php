<?php
// Định nghĩa lớp chính và các thuộc tính, phương thức của lớp
    class ThanhToanModel extends Database
    {
        public function __construct()
        {
            // Gọi hàm khởi tạo từ class cha (Database) để thiết lập kết nối
            parent::__construct();
        }

// Hàm discount - thực hiện chức năng chính của hàm discount
        function discount($code)
        {
            $query = "SELECT * FROM magiam WHERE codes = '".$code."'";
            $result = mysqli_query($this->getConnection(), $query);
            $array = array();

            while($rows = mysqli_fetch_assoc($result))
            {
                $array[] = $rows;
            }

            return json_encode($array);
        }
    }
?>
