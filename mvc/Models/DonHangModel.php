<?php
// Định nghĩa lớp chính và các thuộc tính, phương thức của lớp
    class DonHangModel extends Database
    {
        public function __construct()
        {
            // Gọi hàm khởi tạo từ class cha (Database) để thiết lập kết nối
            parent::__construct();
        }

// Hàm loadBill - thực hiện chức năng chính của hàm loadBill
        function loadBill($IDKH)
        {
            $query = "SELECT *, SUM(ct.tongTien) as total, SUM(ct.soLuong) as amount 
                      FROM `donhang` as dh 
                      JOIN chitietdonhang as ct ON ct.IDDH = dh.ID 
                      WHERE dh.IDKH = '".$IDKH."'
                      GROUP BY ct.IDDH";

            $result = mysqli_query($this->getConnection(), $query);
            $arr = array();

            while($row = mysqli_fetch_array($result))
            {
                $arr[] = $row;
            }

            return json_encode($arr);
        }

// Hàm loadDetailBill - thực hiện chức năng chính của hàm loadDetailBill
        function loadDetailBill($IDKH, $IDDH)
        {
            $query = "SELECT *, ct.status as statusDetail, ct.ID as idDetail  
                      FROM `donhang` as dh 
                      JOIN chitietdonhang as ct ON ct.IDDH = dh.ID 
                      JOIN sanpham as sp ON ct.IDSP = sp.ID
                      WHERE dh.IDKH = '".$IDKH."' AND ct.IDDH = '".$IDDH."'";

            $result = mysqli_query($this->getConnection(), $query);
            $arr = array();

            while($row = mysqli_fetch_array($result))
            {
                $arr[] = $row;
            }

            return json_encode($arr);
        }

// Hàm deleteBill - thực hiện chức năng chính của hàm deleteBill
        function deleteBill($IDKH, $IDDH)
        {
            $delDetail = "DELETE FROM chitietdonhang WHERE IDDH = '".$IDDH."'";
            mysqli_query($this->getConnection(), $delDetail);

            $delBill = "DELETE FROM donhang WHERE IDKH = '".$IDKH."' AND ID = '".$IDDH."'";
            mysqli_query($this->getConnection(), $delBill);
        }

// Hàm cancelBill - thực hiện chức năng chính của hàm cancelBill
        function cancelBill($ID, $status)
        {
            $query = "UPDATE `chitietdonhang` SET `status`='".$status."' WHERE ID = '".$ID."'";
            mysqli_query($this->getConnection(), $query);
        }
    }
?>
