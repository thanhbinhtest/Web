<?php
// Định nghĩa lớp chính và các thuộc tính, phương thức của lớp
    class ChiTietSPModel extends Database
    {
        public function __construct()
        {
            // Gọi hàm khởi tạo từ class cha (Database) để thiết lập kết nối
            parent::__construct();
        }

// Hàm getDetailProduct - thực hiện chức năng chính của hàm getDetailProduct
        function getDetailProduct($ID)
        {
            $query = "SELECT * FROM giamgia as gg 
                     join sanpham as sp on gg.IDSP = sp.ID
                     join theloai as tl on sp.IDLoai = tl.ID 
                     join brand as br on sp.IDBrand = br.ID
                     JOIN xuatxu as xx on sp.IDSX = xx.ID
                     join kichthuoc as kt on sp.IDSize = kt.ID 
                     WHERE sp.ID = '".$ID."'
                     GROUP BY sp.ID";

            $arr = array();

            $result = mysqli_query($this->getConnection(), $query);

            while($rows = mysqli_fetch_assoc($result))
            {
                $arr[] = $rows;
            }

            return json_encode($arr);
        }

// Hàm getProductInvolve - thực hiện chức năng chính của hàm getProductInvolve
        function getProductInvolve($IDLoai)
        {
            $query = "SELECT * FROM `giamgia` as gg 
                      join sanpham as sp on gg.IDSP = sp.ID
                      WHERE sp.IDLoai = '".$IDLoai."'
                      GROUP BY sp.ID";

            $arr = array();

            $result = mysqli_query($this->getConnection(), $query);

            while($rows = mysqli_fetch_assoc($result))
            {
                $arr[] = $rows;
            }

            return json_encode($arr);    
        }

// Hàm getProductDetailInvolve - thực hiện chức năng chính của hàm getProductDetailInvolve
        function getProductDetailInvolve($ID)
        {
            $query = "SELECT * FROM sanpham AS sp WHERE sp.ID = '".$ID."'";
            $result = mysqli_query($this->getConnection(), $query);
            $combo = "";

            while($row = mysqli_fetch_array($result))
            {
                $combo = $row["combo"];
            }

            $queryCombo = "SELECT * FROM `giamgia` as gg 
                           join sanpham as sp on gg.IDSP = sp.ID
                           join kichthuoc as kt on sp.IDSize = kt.ID
                           WHERE sp.combo = '".$combo."'
                           GROUP BY sp.ID
                           LIMIT 4";

            $resultCombo = mysqli_query($this->getConnection(), $queryCombo);

            $arr = array();

            while($rows = mysqli_fetch_assoc($resultCombo))
            {
                $arr[] = $rows;
            }

            return json_encode($arr);
        }

// Hàm review - thực hiện chức năng chính của hàm review
        function review($IDKH,$IDSP,$Review,$Date,$Star)
        {
            $query = "INSERT INTO `binhluan`(`IDKH`, `IDSP`, `binhLuan`, `ngayBL`, `star`) 
                      VALUES ('".$IDKH."','".$IDSP."','".$Review."','".$Date->format('Y-m-d H:i:s')."','".$Star."')";

            mysqli_query($this->getConnection(), $query);
        }

// Hàm loadReview - thực hiện chức năng chính của hàm loadReview
        function loadReview($IDSP, $amount)
        {
            $query = "SELECT kh.hoTen AS hoTen, bl.star, bl.ngayBL, bl.binhLuan FROM binhluan as bl 
                      JOIN khachhang as kh ON bl.IDKH = kh.IDTK
                      JOIN sanpham as sp ON bl.IDSP = sp.ID
                      WHERE IDSP = '".$IDSP."'
                      ORDER BY bl.ID DESC
                      LIMIT 0,$amount";

            $result = mysqli_query($this->getConnection(), $query);

            $arr = array();

            while($rows = mysqli_fetch_array($result))
            {
                $arr[] = $rows;
            }

            return json_encode($arr);
        }

// Hàm lenghtReview - thực hiện chức năng chính của hàm lenghtReview
        function lenghtReview($IDSP)
        {
            $query = "SELECT kh.image,kh.hoTen,bl.star,bl.ngayBL,bl.binhLuan 
                      FROM binhluan as bl 
                      JOIN khachhang as kh on bl.IDKH = kh.IDTK
                      JOIN sanpham as sp on bl.IDSP = sp.ID
                      WHERE IDSP = '".$IDSP."'";

            $result = mysqli_query($this->getConnection(), $query);
            $lenght = mysqli_num_rows($result);

            return $lenght;
        }   
    }
?>
