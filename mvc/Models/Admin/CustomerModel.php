<?php
// Định nghĩa lớp chính và các thuộc tính, phương thức của lớp
    class CustomerModel extends Database
    {
        public function __construct()
        {
            // Gọi hàm khởi tạo từ class cha (Database) để thiết lập kết nối
            parent::__construct();
        }

// Hàm apiListCustomer - thực hiện chức năng chính của hàm apiListCustomer
        function apiListCustomer($keyword, $page, $amountElement)
        {
            $currentPage = $page * $amountElement;
            
            $query = "SELECT tk.ID, kh.hoTen, kh.ngaysinh, kh.gioiTinh, kh.sdt, kh.diachi, kh.ranks, kh.image, tk.email, tk.role 
                      FROM `taikhoan` as tk 
                      JOIN khachhang as kh ON kh.IDTK = tk.ID";

            if($keyword != null)
            {
                $query .= " WHERE tk.ID = '".$keyword."' OR kh.hoTen LIKE '".'%'.$keyword.'%'."'";
            }

            $query .= " GROUP BY tk.ID LIMIT $currentPage, $amountElement";
            $result = mysqli_query($this->getConnection(), $query);

            $array = array();

            while($rows = mysqli_fetch_assoc($result))
            {
                $array[] = $rows;
            }

            return json_encode($array); 
        }

// Hàm lengthListCustomer - thực hiện chức năng chính của hàm lengthListCustomer
        function lengthListCustomer($keyword)
        {
            $query = "SELECT tk.ID, kh.hoTen, kh.ngaysinh, kh.gioiTinh, kh.sdt, kh.diachi, kh.ranks, kh.image, tk.email, tk.role 
                      FROM `taikhoan` as tk 
                      JOIN khachhang as kh ON kh.IDTK = tk.ID";

            if($keyword != null)
            {
                $query .= " WHERE tk.ID = '".$keyword."' OR kh.hoTen LIKE '".'%'.$keyword.'%'."'";
            }
            
            $query .= " GROUP BY tk.ID";

            $result = mysqli_query($this->getConnection(), $query);
            $length = mysqli_num_rows($result);
            
            return $length;
        }

// Hàm removeCustomer - thực hiện chức năng chính của hàm removeCustomer
        function removeCustomer($ID)
        {
            $queryOrder = "SELECT ID FROM donhang WHERE IDKH = '".$ID."'";
            $result = mysqli_query($this->getConnection(), $queryOrder);

            while($row = mysqli_fetch_array($result))
            {
                $removeDetailOrder = "DELETE FROM chitietdonhang WHERE IDDH = '".$row["ID"]."'";
                mysqli_query($this->getConnection(), $removeDetailOrder);
            }

            $removeOrder = "DELETE FROM donhang WHERE IDKH = '".$ID."'";
            mysqli_query($this->getConnection(), $removeOrder);

            $removeReview = "DELETE FROM binhluan WHERE IDKH = '".$ID."'";
            mysqli_query($this->getConnection(), $removeReview);

            $removeListLove = "DELETE FROM danhsachyeuthich WHERE IDKH = '".$ID."'";
            mysqli_query($this->getConnection(), $removeListLove);
            
            $removeCart = "DELETE FROM giohang WHERE IDKH = '".$ID."'";
            mysqli_query($this->getConnection(), $removeCart);

            $removeCustomer = "DELETE FROM khachhang WHERE IDTK = '".$ID."'";
            mysqli_query($this->getConnection(), $removeCustomer);

            $removeAccount = "DELETE FROM taikhoan WHERE ID = '".$ID."'";
            mysqli_query($this->getConnection(), $removeAccount);
        }

// Hàm updateCustomer - thực hiện chức năng chính của hàm updateCustomer
        function updateCustomer($ID, $name, $birthDay, $gender, $phone, $address, $rank, $role)
        {
            $updateUser = "UPDATE `khachhang` 
                          SET `hoTen`='" . $name . "', `ngaysinh`='" . $birthDay . "',
                              `gioiTinh`='" . $gender . "', `sdt`='" . $phone . "', `diachi`='" . $address . "', `ranks`='" . $rank . "'
                           WHERE IDTK = '" . $ID . "'";
        
            $updateRole = "UPDATE `taikhoan` SET `role` = '" . $role . "' WHERE ID = '" . $ID . "'";
        
            $result1 = mysqli_query($this->getConnection(), $updateUser);
            $result2 = mysqli_query($this->getConnection(), $updateRole);
        
            // Kiểm tra kết quả của cả hai truy vấn
            if ($result1 && $result2) {
                // Cập nhật biến session $_SESSION["hoTen"] với tên mới
                $_SESSION["hoTen"] = $name;
                return true; // Trả về true nếu cập nhật thành công
            } else {
                return false; // Trả về false nếu cập nhật không thành công
            }
        }
        
// Hàm updateAvatarCustomer - thực hiện chức năng chính của hàm updateAvatarCustomer
        function updateAvatarCustomer($ID, $image)
        {
            $query = "UPDATE `khachhang` 
                      SET `image`='".$image."' WHERE IDTK = '".$ID."'";
            
            mysqli_query($this->getConnection(), $query);
        }
    }
?>
