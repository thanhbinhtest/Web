<?php
// Định nghĩa lớp chính và các thuộc tính, phương thức của lớp
    class TheoDoiDonHang extends controller
    {
        private $model;
// Hàm __construct - thực hiện chức năng chính của hàm __construct
        function __construct()
        {
            $this->model = $this->model("DonHangModel");
        }
        
// Hàm show - thực hiện chức năng chính của hàm show
        function show()
        {
            $IDKH = isset($_SESSION["logined"][0]["IDTK"]) ? $_SESSION["logined"][0]["IDTK"] : null;
            $result = json_decode($this->model->loadBill($IDKH),true);

            self::view("master",[
                "page" => "TheoDoiDonHang",
                "Bill" => $result
            ]);
        }
        
// Hàm chiTietDonHang - thực hiện chức năng chính của hàm chiTietDonHang
        function chiTietDonHang()
        {
            $IDKH = isset($_SESSION["logined"][0]["IDTK"]) ? $_SESSION["logined"][0]["IDTK"] : null;
            $IDDH = isseT($_POST["IDDH"]) ? $_POST["IDDH"] : null;
            $result = $this->model->loadDetailBill($IDKH,$IDDH);

            echo $result;
        }

// Hàm deleteBill - thực hiện chức năng chính của hàm deleteBill
        function deleteBill()
        {
            $IDKH = isset($_SESSION["logined"][0]["IDTK"]) ? $_SESSION["logined"][0]["IDTK"] : null;
            $IDDH = isseT($_POST["IDDH"]) ? $_POST["IDDH"] : null;
            $this->model->deleteBill($IDKH,$IDDH);
        }

// Hàm cancelBill - thực hiện chức năng chính của hàm cancelBill
        function cancelBill()
        {
            $ID = isseT($_POST["ID"]) ? $_POST["ID"] : null;
            $status = 2;
            
            $this->model->cancelBill($ID, $status);
        }
    }
?>