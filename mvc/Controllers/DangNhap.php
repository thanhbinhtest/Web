<?php
// Định nghĩa lớp chính và các thuộc tính, phương thức của lớp
    class DangNhap extends controller
    {
// Hàm show - thực hiện chức năng chính của hàm show
        function show()
        {
            if(isset($_SESSION["logined"]))
            {
                header("location: TrangChu");
            }

            self::view("master",[
                "page" => "DangNhap",
            ]);
        }

        /*-------------------------------------- Logout -------------------------------------- */
// Hàm logOut - thực hiện chức năng chính của hàm logOut
        function logOut()
        {
            if(isset($_SESSION["logined"]))
            {
                $this->model("TaiKhoanModel")->LogOut($_SESSION["email"]);

                unset($_SESSION["logined"]);
                unset($_SESSION["hoTen"]);
                unset($_SESSION["diachi"]);
                unset($_SESSION["sdt"]);
                unset($_SESSION["email"]);
            }
        }
    }
?>