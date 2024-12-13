<?php
// Định nghĩa lớp chính và các thuộc tính, phương thức của lớp
    class TaiKhoanModel extends Database
    {
        public function __construct()
        {
            // Gọi hàm khởi tạo từ class cha (Database) để thiết lập kết nối
            parent::__construct();
        }

// Hàm Reigster - thực hiện chức năng chính của hàm Reigster
        function Reigster($name, $gender, $date, $address, $email, $password)
        {
            if($this->checkEmail($email) == false)
            {
                return 2;
            }
            else
            {
                $insertTK = "INSERT INTO `taikhoan`(`email`, `passwords`, `checktk`, `role`, `status`) 
                             VALUES ('".$email."','".$password."',0,'user', 0)";
                mysqli_query($this->getConnection(), $insertTK);

                $query = "SELECT MAX(ID) from taikhoan";
                $result = mysqli_query($this->getConnection(), $query);
                $rows = mysqli_fetch_array($result);
                $IDNew = $rows[0];            

                $insertCustomer = "INSERT INTO `khachhang`(`IDTK`, `hoTen`, `ngaysinh`, `gioiTinh`, `sdt`, `diachi`, `ranks`, `image`) 
                                   VALUES ('".$IDNew."','".$name."','".$date."','".$gender."','null','".$address."','0','Public/image/Avatar/noavatar.png')";
                mysqli_query($this->getConnection(), $insertCustomer);

                return true;
            }
        }

// Hàm updateUserName - thực hiện chức năng chính của hàm updateUserName
        function updateUserName($IDKH, $newName)
        {
            $query = "UPDATE `khachhang` SET `hoTen` = '".$newName."' WHERE `IDTK` = '".$IDKH."'";
            $result = mysqli_query($this->getConnection(), $query);

            if ($result) {
                $_SESSION["hoTen"] = $newName;
                return true;
            } else {
                return false;
            }
        }

// Hàm checkEmail - thực hiện chức năng chính của hàm checkEmail
        function checkEmail($email)
        {
            $query = "SELECT * FROM taikhoan WHERE email = '".$email."'";
            $result = mysqli_query($this->getConnection(), $query);
            $count = mysqli_num_rows($result);

            return $count == 0;
        }

// Hàm checkLogin - thực hiện chức năng chính của hàm checkLogin
        function checkLogin($Email)
        {
            $query = "SELECT * FROM taikhoan WHERE email = '".$Email."'";
            $result = mysqli_query($this->getConnection(), $query);
            
            $password = "";
            
            while($row = mysqli_fetch_array($result))
            {
                $password = $row["passwords"];
            }

            return $password != "" ? $password : false;
        }

// Hàm getInforAccount - thực hiện chức năng chính của hàm getInforAccount
        function getInforAccount($Email)
        {
            $query = "SELECT * FROM taikhoan AS tk JOIN khachhang as kh ON tk.ID = kh.IDTK WHERE tk.email = '".$Email."'";
            $result = mysqli_query($this->getConnection(), $query);
            $arr = array();

            while($rows = mysqli_fetch_array($result))
            {
                $arr[] = $rows;
            }

            return $arr;
        }

// Hàm loadAccount - thực hiện chức năng chính của hàm loadAccount
        function loadAccount($IDTK)
        {
            $query = "SELECT * FROM taikhoan AS tk JOIN khachhang AS kh ON tk.ID = kh.IDTK WHERE kh.IDTK = '".$IDTK."'";
            $result = mysqli_query($this->getConnection(), $query);
            $arr = array();

            while ($rows = mysqli_fetch_array($result)) {
                $arr[] = $rows;
            }

            return json_encode($arr);
        }

// Hàm changedAccount - thực hiện chức năng chính của hàm changedAccount
        function changedAccount($IDKH, $Name, $Gender, $birthDate, $phone, $Address)
        {
            $query = "UPDATE `khachhang` SET `hoTen`='".$Name."', `ngaysinh`='".$birthDate."', `gioiTinh`='".$Gender."', `sdt`='".$phone."', `diachi`='".$Address."' WHERE IDTK = '".$IDKH."'";
            mysqli_query($this->getConnection(), $query);

            $_SESSION["hoTen"] = $Name;
        }

// Hàm changedPassword - thực hiện chức năng chính của hàm changedPassword
        function changedPassword($IDKH, $newPassword)
        {
            $query = "UPDATE `taikhoan` SET `passwords`='".$newPassword."' WHERE ID = '".$IDKH."'";
            mysqli_query($this->getConnection(), $query);
        }

// Hàm checkOldPass - thực hiện chức năng chính của hàm checkOldPass
        function checkOldPass($IDKH)
        {
            $query = "SELECT * FROM taikhoan WHERE ID = '".$IDKH."'";
            $result = mysqli_query($this->getConnection(), $query);

            $password = "";

            while($row = mysqli_fetch_array($result))
            {
                $password = $row["passwords"];
            }

            return $password;
        }

// Hàm recovery - thực hiện chức năng chính của hàm recovery
        function recovery($email, $newPassWord)
        {
            $query = "UPDATE taikhoan SET passwords = '".$newPassWord."' WHERE email = '".$email."'";
            mysqli_query($this->getConnection(), $query);
        }

// Hàm changedAvatar - thực hiện chức năng chính của hàm changedAvatar
        function changedAvatar($IDKH, $Avatar)
        {
            $query = "UPDATE `khachhang` SET `image`='".$Avatar."' WHERE IDTK = '".$IDKH."'";
            mysqli_query($this->getConnection(), $query);

            return $Avatar;
        }

// Hàm checkLockLogin - thực hiện chức năng chính của hàm checkLockLogin
        function checkLockLogin($Email)
        {
            $query = "SELECT * FROM taikhoan WHERE email = '".$Email."'";
            $result = mysqli_query($this->getConnection(), $query);

            $row = mysqli_fetch_array($result);
            
            if(mysqli_num_rows($result) > 0)
            {
                return $row["checktk"];
            }
        }

// Hàm updateLockLogin - thực hiện chức năng chính của hàm updateLockLogin
        function updateLockLogin($Email, $amountLogin, $status)
        {
            $query = "UPDATE taikhoan SET checktk = '".$amountLogin."', status = '".$status."' WHERE email = '".$Email."'";
            mysqli_query($this->getConnection(), $query);
        }

// Hàm LogOut - thực hiện chức năng chính của hàm LogOut
        function LogOut($email)
        {
            $query = "UPDATE taikhoan SET status = 0 WHERE email = '".$email."'";
            mysqli_query($this->getConnection(), $query);
        }
    }
?>
