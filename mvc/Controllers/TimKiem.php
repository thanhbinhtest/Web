<?php
// Định nghĩa lớp chính và các thuộc tính, phương thức của lớp
class TimKiem extends controller
{
// Hàm show - thực hiện chức năng chính của hàm show
    function show()
    {
        $model = self::model("SanPhamModel");
        $keyWord = isset($_GET["key"]) ? $_GET["key"] : null;
        $temp = $model->search($keyWord);

        self::view("master", [
            "page" => "TimKiem",
            "data" => $temp,
            "title" => "Tìm kiếm"
        ]);
    }
}
