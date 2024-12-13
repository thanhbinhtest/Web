<?php
// Định nghĩa lớp chính và các thuộc tính, phương thức của lớp
    class EventModel extends Database
    {
        public function __construct()
        {
            // Gọi hàm khởi tạo từ class cha (Database) để thiết lập kết nối
            parent::__construct();
        }

// Hàm apiListEvent - thực hiện chức năng chính của hàm apiListEvent
        function apiListEvent($keyword = null)
        {
            $query = "SELECT sk.ID, sk.image, sk.tenSK, sk.ngayBD, sk.ngayKT, sk.noiDung, mg.codes, mg.giagiam
                      FROM sukien as sk 
                      JOIN magiam as mg ON sk.ID = mg.IDSK";

            if($keyword != null)
            {
                $query .= " WHERE sk.ID = '".$keyword."' OR sk.tenSK LIKE '".'%'.$keyword.'%'."'";
            }

            $result = mysqli_query($this->getConnection(), $query);

            $arr = array();

            while($row = mysqli_fetch_assoc($result))
            {
                $arr[] = $row;
            }

            return json_encode($arr);
        }

// Hàm getProductByCategories - thực hiện chức năng chính của hàm getProductByCategories
        function getProductByCategories($ID)
        {
            $query = "SELECT * FROM sanpham WHERE IDLoai = '".$ID."'";

            $result = mysqli_query($this->getConnection(), $query);

            $arr = array();

            while($row = mysqli_fetch_assoc($result))
            {
                $arr[] = $row;
            }

            return json_encode($arr);
        }

// Hàm getSK - thực hiện chức năng chính của hàm getSK
        function getSK()
        {
            $query = "SELECT MAX(ID) FROM sukien";

            $result = mysqli_query($this->getConnection(), $query);

            $ID = mysqli_fetch_array($result)[0];

            return $ID;
        }

// Hàm updateDiscount - thực hiện chức năng chính của hàm updateDiscount
        function updateDiscount($IDSK, $IDSP, $discount)
        {
            $query = "UPDATE `giamgia` SET `IDSK`='".$IDSK."',`IDSP`='".$IDSP."',`giaGiam`='".$discount."' 
                      WHERE IDSP = '".$IDSP."'";

            mysqli_query($this->getConnection(), $query);
        }

// Hàm insertEvent - thực hiện chức năng chính của hàm insertEvent
        function insertEvent($name, $content, $dateStart, $dateEnd, $image)
        {
            $query = "INSERT INTO `sukien`(`tenSK`, `ngayBD`, `ngayKT`, `noiDung`, `image`) 
                      VALUES ('".$name."','".$dateStart."','".$dateEnd."','".$content."','".$image."')";

            mysqli_query($this->getConnection(), $query);
        }

// Hàm insertGiftCode - thực hiện chức năng chính của hàm insertGiftCode
        function insertGiftCode($IDSK, $code, $discount)
        {
            $query = "INSERT INTO `magiam`(`IDSK`, `codes`, `giagiam`) 
                      VALUES ('".$IDSK."','".$code."','".$discount."')";

            mysqli_query($this->getConnection(), $query);
        }

// Hàm updateEvent - thực hiện chức năng chính của hàm updateEvent
        function updateEvent($ID, $name, $content, $dateStart, $dateEnd, $image)
        {
            $query = "UPDATE `sukien` SET `tenSK`='".$name."',`ngayBD`='".$dateStart."',
                             `ngayKT`='".$dateEnd."',`noiDung`='".$content."',`image`='".$image."' 
                      WHERE ID = '".$ID."'";

            mysqli_query($this->getConnection(), $query);
        }

// Hàm removeEvent - thực hiện chức năng chính của hàm removeEvent
        function removeEvent($ID)
        {
            $updateDiscount = "UPDATE `giamgia` SET `IDSK` = NULL, `giaGiam` = 0 WHERE IDSK = '".$ID."'";
            mysqli_query($this->getConnection(), $updateDiscount);
            
            $updateCodeDiscount = "DELETE FROM `magiam` WHERE IDSK = '".$ID."'";
            mysqli_query($this->getConnection(), $updateCodeDiscount);

            $removeGiftCode = "DELETE FROM magiam WHERE IDSK = '".$ID."'";
            mysqli_query($this->getConnection(), $removeGiftCode);

            $query = "DELETE FROM `sukien` WHERE ID = '".$ID."'";
            mysqli_query($this->getConnection(), $query);
        }
    }
?>
