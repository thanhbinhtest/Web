<?php
// Định nghĩa lớp chính và các thuộc tính, phương thức của lớp
class Histories extends controller
{
    private $model;

// Hàm __construct - thực hiện chức năng chính của hàm __construct
    function __construct()
    {
        $this->model = $this->modelAdmin("HistoriesModel");
    }

// Hàm show - thực hiện chức năng chính của hàm show
    function show()
    {
        self::viewAdmin('master', ['page' => "Histories"]);
    }

// Hàm apiListBill - thực hiện chức năng chính của hàm apiListBill
    function apiListBill()
    {
        $keyword = isset($_POST["keyword"]) ? $_POST["keyword"] : null;
        $IDCategory = isset($_POST["IDCategory"]) ? $_POST["IDCategory"] : null;

        $result = $this->model->apiListBill($keyword, $IDCategory);

        echo $result;
    }

// Hàm removeBill - thực hiện chức năng chính của hàm removeBill
    function removeBill()
    {
        $ID = isset($_POST["ID"]) ? $_POST["ID"] : null;

        $this->model->removeBill($ID);
    }
}
