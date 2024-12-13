<?php
// Định nghĩa lớp chính và các thuộc tính, phương thức của lớp
class HistoriesModel extends Database
{
    public function __construct()
    {
        // Gọi hàm khởi tạo từ class cha (Database) để thiết lập kết nối
        parent::__construct();
    }

// Hàm apiListBill - thực hiện chức năng chính của hàm apiListBill
    function apiListBill($keyword, $IDCategory)
    {
        if ($IDCategory == 0) {
            $query = "SELECT LS.ID, LS.soLuong, LS.ngayBan, kh.hoTen, sp.tenSP, (sp.giaSP * ls.soLuong) as total 
            FROM `lichsubanhang` as ls 
            join sanpham as sp on ls.IDSP = sp.ID 
            join khachhang as kh on ls.IDKH = kh.ID";
        } else {
            $query = "SELECT LS.ID, LS.soLuong, LS.ngayBan, kh.hoTen, sp.tenSP, (sp.giaSP * ls.soLuong) as total 
            FROM `lichsubanhang` as ls 
            join sanpham as sp on ls.IDSP = sp.ID 
            join khachhang as kh on ls.IDKH = kh.ID
            WHERE sp.IDLoai = '" . $IDCategory . "'";
        }

        if ($keyword != null) {
            $query .= " AND ls.ID = '" . $keyword . "' OR ls.ngayBan = '" . $keyword . "'";
        }

        $query .= " ORDER BY LS.ID";

        $result = mysqli_query($this->getConnection(), $query);

        $array = array();

        while ($rows = mysqli_fetch_assoc($result)) {
            $array[] = $rows;
        }

        return json_encode($array);
    }

// Hàm removeBill - thực hiện chức năng chính của hàm removeBill
    function removeBill($ID)
    {
        $query = "DELETE FROM `lichsubanhang` WHERE ID = '" . $ID . "'";
        mysqli_query($this->getConnection(), $query);
    }
}
