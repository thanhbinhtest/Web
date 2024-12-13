<?php
// Định nghĩa lớp chính và các thuộc tính, phương thức của lớp
class DanhSachYeuThich extends controller
{
// Hàm show - thực hiện chức năng chính của hàm show
    function show()
    {
        $IDKH = isset($_SESSION["logined"][0]["IDTK"]) ? $_SESSION["logined"][0]["IDTK"] : null;

        $model = $this->model("SanPhamModel");
        $result = $model->getFavourite($IDKH);

        self::view("master", [
            "page" => "DanhSachYeuThich",
            "Favourite" => json_decode($result, true),
            "title" => "Danh sách yêu thích"
        ]);
    }

// Hàm deleteFavourite - thực hiện chức năng chính của hàm deleteFavourite
    function deleteFavourite()
    {
        $IDKH = isset($_SESSION["logined"][0]["IDTK"]) ? $_SESSION["logined"][0]["IDTK"] : null;
        $ID = isset($_POST["ID"]) ? $_POST["ID"] : null;

        $model = $this->model("SanPhamModel");
        $model->deleteFavourite($IDKH, $ID);
    }
}
