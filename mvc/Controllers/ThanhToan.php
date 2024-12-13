<?php
header("Access-Control-Allow-Origin: *");


// Định nghĩa lớp chính và các thuộc tính, phương thức của lớp
class ThanhToan extends controller
{
// Hàm show - thực hiện chức năng chính của hàm show
    function show()
    {
        $this->view("master", [
            "page" => "ThanhToan",
            "title" => "Thanh toán"
        ]);
    }

// Hàm discount - thực hiện chức năng chính của hàm discount
    function discount()
    {
        $code = isset($_POST["code"]) ? $_POST["code"] : null;

        $model = $this->model("ThanhToanModel");

        $result = $model->discount($code);

        echo $result;
    }

}
