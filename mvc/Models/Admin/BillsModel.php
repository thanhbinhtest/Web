<?php
// Định nghĩa lớp chính và các thuộc tính, phương thức của lớp
    class BillsModel extends Database
    {
        public function __construct()
        {
            // Gọi hàm khởi tạo từ class cha (Database) để thiết lập kết nối
            parent::__construct();
        }

// Hàm loadBill - thực hiện chức năng chính của hàm loadBill
        function loadBill($keyword, $page, $amountPage)
        {
            $temp = $page * $amountPage;
            
            $query = "SELECT * FROM `donhang` WHERE (tinhTrang = 'Đang xử lý' OR tinhTrang = 'Đã duyệt')";
        
            if ($keyword != null) {
                $query .= " AND ID = '".$keyword."'";
            }
        
            $query .= " ORDER BY ID DESC LIMIT $temp, $amountPage";
        
            $result = mysqli_query($this->getConnection(), $query);
        
            $array = array();
        
            while($row = mysqli_fetch_assoc($result)) {
                $array[] = $row;
            }
        
            return json_encode($array);
        }

// Hàm lengthListBill - thực hiện chức năng chính của hàm lengthListBill
        function lengthListBill($keyword)
        {
            $query = "SELECT * FROM `donhang` WHERE tinhTrang = 'Đang xử lý' OR tinhTrang = 'Đã duyệt'";

            if($keyword != null)
            {
                $query .= " AND ID = '".$keyword."' or MONTH(ngayDat) = '".$keyword."'";
            }

            $query .= " ORDER BY ID DESC";

            $result = mysqli_query($this->getConnection(), $query);
            $length = mysqli_num_rows($result);
            
            return $length;
        }

// Hàm loadDetailBill - thực hiện chức năng chính của hàm loadDetailBill
        function loadDetailBill($ID)
        {
            // Xác thực hoặc chuyển đổi kiểu dữ liệu của $ID
            $ID = mysqli_real_escape_string($this->getConnection(), $ID);
        
            // Truy vấn SQL để lấy chi tiết của hóa đơn dựa trên ID
            $query = "SELECT ct.ID, ct.status, ct.IDSP, ct.soLuong, ct.Size, ct.tongTien, ct.cachThanhToan, ct.ten, ct.diaChi, ct.sdt, ct.email, ct.ghiChu, sp.tenSP 
                      FROM `chitietdonhang` as ct 
                      JOIN `sanpham` as sp ON ct.IDSP = sp.ID 
                      WHERE IDDH = '$ID'";
        
            $result = mysqli_query($this->getConnection(), $query);
        
            $array = array();
        
            // Lặp qua kết quả và thêm vào mảng
            while($row = mysqli_fetch_assoc($result))
            {
                $array[] = $row;
            }
        
            // Trả về dữ liệu dưới dạng JSON
            return json_encode($array);
        }

// Hàm cancelBill - thực hiện chức năng chính của hàm cancelBill
        function cancelBill($ID)
        {
            $removeDetailBill = "DELETE FROM `chitietdonhang` WHERE IDDH = '".$ID."'";
            mysqli_query($this->getConnection(), $removeDetailBill);

            $removeBill = "DELETE FROM `donhang` WHERE ID = '".$ID."'";
            mysqli_query($this->getConnection(), $removeBill);
        }

// Hàm checkBill - thực hiện chức năng chính của hàm checkBill
        function checkBill($ID, $status, $IDKH)
        {
            if(strcmp($status, "Đã nhận hàng") == 0)
            {
                $arr = json_decode($this->loadDetailBill($ID), true);
                $date = date("Y-m-d");
                
                foreach($arr as $item)
                {
                    $insertHistory = "INSERT INTO `lichsubanhang`(`IDKH`, `IDSP`, `soLuong`, `ngayBan`) 
                                      VALUES ('".$IDKH."','".$item["IDSP"]."','".$item["soLuong"]."','".$date."')";
                    
                    mysqli_query($this->getConnection(), $insertHistory);
                }

                $updateBill = "UPDATE donhang SET `tinhTrang`= '".$status."' WHERE ID = '".$ID."'";
                mysqli_query($this->getConnection(), $updateBill);
            }
            else if(strcmp($status, "Đã duyệt") == 0)
            {
                $updateBill = "UPDATE donhang SET `tinhTrang`= '".$status."' WHERE ID = '".$ID."'";
                mysqli_query($this->getConnection(), $updateBill);
            }
        }

// Hàm confirmCancelBill - thực hiện chức năng chính của hàm confirmCancelBill
        function confirmCancelBill($ID, $IDDH, $status)
        {
            $query = "UPDATE `chitietdonhang` SET `status`= '".$status."' WHERE ID = '".$ID."'";
            mysqli_query($this->getConnection(), $query);

            $amountProductInBill = $this->getAmountProductBill($IDDH);
            $amountProductCancelInBill = $this->getAmountProductBill($IDDH, $status);

            if($amountProductInBill - $amountProductCancelInBill <= 0)
            {
                $this->updateStatusBill($IDDH);
            }
        }

// Hàm getAmountProductBill - thực hiện chức năng chính của hàm getAmountProductBill
        function getAmountProductBill($IDDH, $status = null)
        {
            $query = "SELECT * FROM chitietdonhang WHERE IDDH = '".$IDDH."'";

            if(!empty($status))
            {
                $query .= " AND status = ".$status."";
            }

            $result = mysqli_query($this->getConnection(), $query);
            
            return mysqli_num_rows($result);
        }

// Hàm updateStatusBill - thực hiện chức năng chính của hàm updateStatusBill
        function updateStatusBill($IDDH)
        {
            $query = "UPDATE donhang SET tinhTrang = 'Đã hủy hàng' WHERE ID = '".$IDDH."'";
            mysqli_query($this->getConnection(), $query);
        }
    }
?>
