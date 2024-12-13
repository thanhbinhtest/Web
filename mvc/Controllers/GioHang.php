<?php
// Định nghĩa lớp chính và các thuộc tính, phương thức của lớp
    class GioHang extends controller
    {
// Hàm show - thực hiện chức năng chính của hàm show
        function show()
        {     
            $this->view("master", [
                "page"=> "GioHang",
                "title" => "Giỏ hàng"
            ]);
        }
    }
