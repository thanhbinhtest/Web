<?php
// Định nghĩa lớp chính và các thuộc tính, phương thức của lớp
    class Bills extends Controller
    {
        private $model;

// Hàm __construct - thực hiện chức năng chính của hàm __construct
        function __construct()
        {
            $this->model = $this->modelAdmin("BillsModel");
        }

// Hàm show - thực hiện chức năng chính của hàm show
        function show()
        {
            self::viewAdmin('master', ["page" => "Bills"]);
        }
        
// Hàm loadBill - thực hiện chức năng chính của hàm loadBill
        function loadBill()
        {
            $keyword = isset($_POST["keyword"]) ? $_POST["keyword"] : null;
            $page = isset($_POST["page"]) ? $_POST["page"] : null;
            $amountPage = isset($_POST["amountPage"]) ? $_POST["amountPage"] : null;

            $result = $this->model->loadBill($keyword,$page,$amountPage);
            
            echo $result;
        }

// Hàm lengthListBill - thực hiện chức năng chính của hàm lengthListBill
        function lengthListBill()
        {
            $keyword = isset($_POST["keyword"]) ? $_POST["keyword"] : null;
            $result = $this->model->lengthListBill($keyword);

            echo $result;
        }
        
// Hàm loadDetailBill - thực hiện chức năng chính của hàm loadDetailBill
        function loadDetailBill()
        {
            $ID = isset($_POST["ID"]) ? $_POST["ID"] : null;

            $result = $this->model->loadDetailBill($ID);
            
            echo $result;
        }

// Hàm cancelBill - thực hiện chức năng chính của hàm cancelBill
        function cancelBill()
        {
            $ID = isset($_POST["ID"]) ? $_POST["ID"] : null;

            $this->model->cancelBill($ID);
        }

// Hàm checkBill - thực hiện chức năng chính của hàm checkBill
        function checkBill()
        {
            $ID = isset($_POST["ID"]) ? $_POST["ID"] : null;
            $IDKH = isset($_POST["IDKH"]) ? $_POST["IDKH"] : null;
            $status = isset($_POST["status"]) ? $_POST["status"] : null;

            $this->model->checkBill($ID,$status,$IDKH);
        }

// Hàm confirmCancelBill - thực hiện chức năng chính của hàm confirmCancelBill
        function confirmCancelBill()
        {
            $ID = isset($_POST["ID"]) ? $_POST["ID"] : null;
            $IDDH = isset($_POST["IDDH"]) ? $_POST["IDDH"] : null;
            $status = 1;

            $result = $this->model->confirmCancelBill($ID, $IDDH, $status);
        }
    }
?>