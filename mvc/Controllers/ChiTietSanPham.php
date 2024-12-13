<?php
// Định nghĩa lớp chính và các thuộc tính, phương thức của lớp
    class ChiTietSanPham extends controller
    {
        protected $myModel;

// Hàm __construct - thực hiện chức năng chính của hàm __construct
        function __construct()
        {
            $this->myModel = $this->model("ChiTietSPModel");
        }

// Hàm show - thực hiện chức năng chính của hàm show
        function show()
        {
            $ID = isset($_GET["ID"]) ? $_GET["ID"] : null;
            $IDLoai = isset($_GET["IDLoai"]) ? $_GET["IDLoai"] : null;

            if($ID != null)
            {
                $result= json_decode($this->myModel->getDetailProduct($ID),true);
            }

            $size = $this->model("SanPhamModel")->getSize();
            $involve = json_decode($this->myModel->getProductInvolve($IDLoai),true);
            $getStarProduct = $this->model("SanPhamModel")->getStarProduct();

            $this->view("master",
            [
                        "page" => "ChiTietSanPham",
                        "data" => $result,
                        "size" => $size,
                        "involve" => $involve,
                        "star"=> json_decode($getStarProduct,true),
                        "title" => "Chi tiết sản phẩm"
            ]);
        }

// Hàm review - thực hiện chức năng chính của hàm review
        function review()
        {
            $IDKH = isset($_SESSION["logined"][0]["ID"]) ? $_SESSION["logined"][0]["IDTK"] : null;
            $IDSP = isset($_POST["IDSP"]) ? $_POST["IDSP"] : null;
            $Review = isset($_POST["review"]) ? $_POST["review"] : null;
            $Date = new DateTime();
            $Star = isset($_POST["star"]) ? $_POST["star"] : null;

            $model = $this->model("ChiTietSPModel");

            if($IDKH != null)
            {
                $model->review($IDKH,$IDSP,$Review,$Date,$Star);
            }
            else
            {
                echo -1;
            }
        }

// Hàm loadReview - thực hiện chức năng chính của hàm loadReview
        function loadReview()
        {
            $IDSP = isset($_POST["IDSP"]) ? $_POST["IDSP"] : null;
            $amount = isset($_POST["Amount"]) ? $_POST["Amount"] : null;
            $model = $this->model("ChiTietSPModel");

            $result = $model->loadReview($IDSP,$amount);

            echo $result;
        }

// Hàm lenghtReview - thực hiện chức năng chính của hàm lenghtReview
        function lenghtReview()
        {
            $IDSP = isset($_POST["IDSP"]) ? $_POST["IDSP"] : null;
            $model = $this->model("ChiTietSPModel");

            $result = $model->lenghtReview($IDSP);

            echo $result;
        }
    }
