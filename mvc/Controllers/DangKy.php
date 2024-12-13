<?php
// Định nghĩa lớp chính và các thuộc tính, phương thức của lớp
    class DangKy extends controller
    {
// Hàm show - thực hiện chức năng chính của hàm show
        function show()
        {
            if(isset($_SESSION["logined"]))
            {
                header("location: TrangChu");
            }
            
            self::view("master",[
                "page" => "DangKy",
            ]);
        }
    }
?>