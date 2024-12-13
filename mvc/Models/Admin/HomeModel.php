<?php
// Định nghĩa lớp chính và các thuộc tính, phương thức của lớp
    class HomeModel extends Database
    {
        public function __construct()
        {
            // Gọi hàm khởi tạo từ class cha (Database) để thiết lập kết nối
            parent::__construct();
        }

// Hàm apiListProduct - thực hiện chức năng chính của hàm apiListProduct
        function apiListProduct($page, $amountProduct, $keyword)
        {
            $temp = $page * $amountProduct;
            
            $query = "SELECT tl.tenTL, br.tenBrand, s.size, m.tenMau, sx.tenSX, sp.tenSP, sp.giaSP, 
                             sp.image, sp.image1, sp.image2, sp.moTa, sp.congDung, 
                             sp.suDung, sp.gioiThieuTH, sp.status, sp.ID,
                             sp.IDLoai, sp.IDBrand, sp.IDSize, sp.IDMau, sp.IDSX, sp.combo
                      FROM sanpham as sp 
                      JOIN theloai as tl ON sp.IDLoai = tl.ID 
                      JOIN brand as br ON sp.IDBrand = br.ID 
                      JOIN kichthuoc as s ON sp.IDSize = s.ID 
                      JOIN mausac as m ON sp.IDMau = m.ID 
                      JOIN xuatxu as sx ON sp.IDSX = sx.ID";

            if($keyword != null)
            {
                $query .= " WHERE sp.ID = '".$keyword."' OR sp.tenSP LIKE '".'%'.$keyword.'%'."'";
            }

            $query .= " ORDER BY sp.ID LIMIT $temp, $amountProduct";
    
            $result = mysqli_query($this->getConnection(), $query);

            $arr = array();

            while($row = mysqli_fetch_assoc($result))
            {
                $arr[] = $row;
            }

            return json_encode($arr);
        }

// Hàm lengthListProduct - thực hiện chức năng chính của hàm lengthListProduct
        function lengthListProduct($keyword)
        {
            $query = "SELECT tl.tenTL, br.tenBrand, s.size, m.tenMau, sx.tenSX, sp.tenSP, sp.giaSP, 
                             sp.image, sp.image1, sp.image2, sp.moTa, sp.congDung, 
                             sp.suDung, sp.gioiThieuTH, sp.status, sp.ID,
                             sp.IDLoai, sp.IDBrand, sp.IDSize, sp.IDMau, sp.IDSX, sp.combo
                      FROM sanpham as sp 
                      JOIN theloai as tl ON sp.IDLoai = tl.ID 
                      JOIN brand as br ON sp.IDBrand = br.ID 
                      JOIN kichthuoc as s ON sp.IDSize = s.ID 
                      JOIN mausac as m ON sp.IDMau = m.ID 
                      JOIN xuatxu as sx ON sp.IDSX = sx.ID";

            if($keyword != null)
            {
                $query .= " WHERE sp.ID = '".$keyword."' OR sp.tenSP LIKE '".'%'.$keyword.'%'."'";
            }

            $result = mysqli_query($this->getConnection(), $query);
            $length = mysqli_num_rows($result);
            
            return $length;
        }

// Hàm apiCategories - thực hiện chức năng chính của hàm apiCategories
        function apiCategories($ID = null)
        {
            $query = "SELECT * FROM theLoai";
            
            if($ID != null)
            {
                $query .= " WHERE ID = '".$ID."' OR tenTL LIKE '".'%'.$ID.'%'."'";
            }

            $result = mysqli_query($this->getConnection(), $query);

            $arr = array();

            while($row = mysqli_fetch_assoc($result))
            {
                $arr[] = $row;
            }

            return json_encode($arr);
        }

// Hàm apiBrands - thực hiện chức năng chính của hàm apiBrands
        function apiBrands($keyword = null)
        {
            $query = "SELECT * FROM brand";
            
            if($keyword != null)
            {
                $query .= " WHERE ID = '".$keyword."' OR tenBrand LIKE '".'%'.$keyword.'%'."'";
            }

            $result = mysqli_query($this->getConnection(), $query);

            $arr = array();

            while($row = mysqli_fetch_assoc($result))
            {
                $arr[] = $row;
            }

            return json_encode($arr);
        }

// Hàm apiSizes - thực hiện chức năng chính của hàm apiSizes
        function apiSizes()
        {
            $query = "SELECT * FROM kichthuoc";
            
            $result = mysqli_query($this->getConnection(), $query);

            $arr = array();

            while($row = mysqli_fetch_assoc($result))
            {
                $arr[] = $row;
            }

            return json_encode($arr);
        }

// Hàm apiColors - thực hiện chức năng chính của hàm apiColors
        function apiColors()
        {
            $query = "SELECT * FROM mausac";
            
            $result = mysqli_query($this->getConnection(), $query);

            $arr = array();

            while($row = mysqli_fetch_assoc($result))
            {
                $arr[] = $row;
            }

            return json_encode($arr);
        }

// Hàm apiProduces - thực hiện chức năng chính của hàm apiProduces
        function apiProduces($keyword = null)
        {
            $query = "SELECT * FROM xuatxu";
            
            if($keyword != null)
            {
                $query .= " WHERE ID = '".$keyword."' OR tenSX LIKE '".'%'.$keyword.'%'."'";
            }

            $result = mysqli_query($this->getConnection(), $query);

            $arr = array();

            while($row = mysqli_fetch_assoc($result))
            {
                $arr[] = $row;
            }

            return json_encode($arr);
        }

// Hàm apiCombo - thực hiện chức năng chính của hàm apiCombo
        function apiCombo()
        {
            $query = "SELECT * FROM combo";
            
            $result = mysqli_query($this->getConnection(), $query);

            $arr = array();

            while($row = mysqli_fetch_assoc($result))
            {
                $arr[] = $row;
            }

            return json_encode($arr);
        }

// Hàm createCombo - thực hiện chức năng chính của hàm createCombo
        function createCombo($name)
        {
            $query = "INSERT INTO `combo`(`tenCombo`) VALUES ('".$name."')";
            mysqli_query($this->getConnection(), $query);
        }

// Hàm updateProduct - thực hiện chức năng chính của hàm updateProduct
        function updateProduct($ID, $IDCategory, $IDBrand, $IDSize, $IDColor, $IDProduce, $Image1, $Image2, $Image3, $name, $price, $description, $effect, $usage, $introduce, $combo)
        {
            $query = "UPDATE `sanpham` SET `IDLoai`='".$IDCategory."',`IDBrand`='".$IDBrand."',`IDSize`='".$IDSize."',`IDMau`='".$IDColor."',`IDSX`='".$IDProduce."',
                             `tenSP`='".$name."',`giaSP`='".$price."', `moTa`='".$description."',`congDung`='".$effect."',`suDung`='".$usage."',`gioiThieuTH`='".$introduce."',
                             `combo`='".$combo."',`image` = '".$Image1."', `image1` = '".$Image2."', `image2` = '".$Image3."'
                      WHERE ID = '".$ID."'";

            mysqli_query($this->getConnection(), $query);
        }
        
// Hàm insertProduct - thực hiện chức năng chính của hàm insertProduct
        function insertProduct($IDCategory, $IDBrand, $IDSize, $IDColor, $IDProduce, $image1, $image2, $image3, $name, $price, $description, $effect, $usage, $introduce, $combo)
        {
            $insertProduct = "INSERT INTO `sanpham`(`IDLoai`, `IDBrand`, `IDSize`, `IDMau`, `IDSX`, `tenSP`, `giaSP`, `image`, `image1`, `image2`, `moTa`, `congDung`, `suDung`, `gioiThieuTH`, `combo`, `status`) 
                              VALUES ('".$IDCategory."','".$IDBrand."','".$IDSize."','".$IDColor."','".$IDProduce."','".$name."','".$price."','".$image1."','".$image2."','".$image3."','".$description."','".$effect."','".$usage."','".$introduce."','".$combo."',1)";

            mysqli_query($this->getConnection(), $insertProduct);

            $selectID = "SELECT Max(ID) FROM `sanpham`";
            $result = mysqli_query($this->getConnection(), $selectID);
            $IDSP = mysqli_fetch_array($result)[0];
            
            $this->insertDiscount($IDSP);
        }

// Hàm insertDiscount - thực hiện chức năng chính của hàm insertDiscount
        function insertDiscount($IDSP)
        {
            $query = "INSERT INTO `giamgia`(`IDSK`, `IDSP`, `giaGiam`) 
                      VALUES (null, '".$IDSP."', 0)";
            mysqli_query($this->getConnection(), $query);          
        }

// Hàm removeProduct - thực hiện chức năng chính của hàm removeProduct
        function removeProduct($IDSP)
        {
            $removeDiscount = "DELETE FROM `giamgia` WHERE IDSP = '".$IDSP."'";
            mysqli_query($this->getConnection(), $removeDiscount);    

            $removeProduct = "DELETE FROM `sanpham` WHERE ID = '".$IDSP."'";
            mysqli_query($this->getConnection(), $removeProduct);          
        }

// Hàm insertCategories - thực hiện chức năng chính của hàm insertCategories
        function insertCategories($name, $category)
        {
            $query = "INSERT INTO `theloai`(`ID`, `tenTL`, `Loai`) 
                      VALUES ('[value-1]', '".$name."', '".$category."')";

            mysqli_query($this->getConnection(), $query);    
        }

// Hàm removeCategories - thực hiện chức năng chính của hàm removeCategories
        function removeCategories($ID)
        {
            $selectProduct = "SELECT ID FROM sanpham WHERE IDLoai = '".$ID."'";
            $result = mysqli_query($this->getConnection(), $selectProduct);

            while($row = mysqli_fetch_array($result))
            {
                $removeProduct = "DELETE FROM `binhluan` WHERE IDSP = '".$row["ID"]."'";
                mysqli_query($this->getConnection(), $removeProduct);  

                $removeSale = "DELETE FROM `giamgia` WHERE IDSP = '".$row["ID"]."'";
                mysqli_query($this->getConnection(), $removeSale);   

                $removeHistory = "DELETE FROM `lichsubanhang` WHERE IDSP = '".$row["ID"]."'";
                mysqli_query($this->getConnection(), $removeHistory);  
                
                $removeLike= "DELETE FROM `danhsachyeuthich` WHERE IDSP = '".$row["ID"]."'";
                mysqli_query($this->getConnection(), $removeLike);  
            }

            $removeProduct = "DELETE FROM `sanpham` WHERE IDLoai = '".$ID."'";
            mysqli_query($this->getConnection(), $removeProduct);   

            $query = "DELETE FROM `theloai` WHERE ID = '".$ID."'";
            mysqli_query($this->getConnection(), $query);    
        }

// Hàm updateCategories - thực hiện chức năng chính của hàm updateCategories
        function updateCategories($ID, $name, $category)
        {
            $query = "UPDATE `theloai` SET `tenTL`='".$name."',`Loai`='".$category."' 
                      WHERE ID = '".$ID."'";

            mysqli_query($this->getConnection(), $query);    
        }

        public function insertProduce($name)
        {
            $query = "INSERT INTO `xuatxu`(`tenSX`) 
                      VALUES ('".$name."')";

            mysqli_query($this->getConnection(), $query);
        }

// Hàm updateProduce - thực hiện chức năng chính của hàm updateProduce
        function updateProduce($ID, $name)
        {
            $query = "UPDATE `xuatxu` SET `tenSX`='".$name."'
                      WHERE ID = '".$ID."'";

            mysqli_query($this->getConnection(), $query);    
        }

// Hàm removeProduce - thực hiện chức năng chính của hàm removeProduce
        function removeProduce($ID)
        {
            $query = "DELETE FROM `xuatxu` WHERE ID = '".$ID."'";
            mysqli_query($this->getConnection(), $query);    
        }

        public function insertBrand($name)
        {
            $query = "INSERT INTO `brand`(`tenBrand`) 
                      VALUES ('".$name."')";

            mysqli_query($this->getConnection(), $query);
        }

// Hàm updateBrand - thực hiện chức năng chính của hàm updateBrand
        function updateBrand($ID, $name)
        {
            $query = "UPDATE `brand` SET `tenBrand`='".$name."'
                      WHERE ID = '".$ID."'";

            mysqli_query($this->getConnection(), $query);    
        }

// Hàm removeBrand - thực hiện chức năng chính của hàm removeBrand
        function removeBrand($ID)
        {
            $query = "DELETE FROM `brand` WHERE ID = '".$ID."'";
            mysqli_query($this->getConnection(), $query);    
        }
        public function amountAccount() {
        // Thêm logic để lấy số lượng tài khoản
        return 5; // Giá trị mẫu, thay bằng logic phù hợp
    }

    public function amountProductSelled() {
        // Thêm logic để lấy số lượng sản phẩm đã bán
        return 0; // Giá trị mẫu, thay bằng logic phù hợp
    }

    public function amountProduct() {
        // Thêm logic để lấy tổng số sản phẩm
        return 85; // Giá trị mẫu, thay bằng logic phù hợp
    }

    public function amountLogined() {
        // Thêm logic để lấy số lần đăng nhập
        return 5; // Giá trị mẫu, thay bằng logic phù hợp
    }
    }
?>
