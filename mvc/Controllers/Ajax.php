<?php
// Định nghĩa lớp chính và các thuộc tính, phương thức của lớp
class Ajax extends Controller
{
    public static $userModel;
// Khởi tạo thuộc tính static
    public static $page = 0;
    public static $countProduct;
    public static $brand;
    public static $origin;
    public static $size;
    public static $color;
    public static $fromPrice;
    public static $toPrice;
    public static $category;
    public static $sorted;
    public static $reduce;

    public function __construct()
    {
        self::$userModel = $this->model("SanPhamModel");
    }
    public function show()
    {
        self::getValue();

        $temp = self::$userModel->loadSP(self::$brand, self::$origin, self::$size, self::$color, self::$fromPrice, self::$toPrice, self::$category, self::$sorted, self::$reduce, self::$page, self::$countProduct);

        echo $temp;
    }

    public function getPages()
    {
        self::getValue();

        $temp = self::$userModel->getRows(self::$brand, self::$origin, self::$size, self::$color, self::$fromPrice, self::$toPrice, self::$category, self::$sorted, self::$reduce, self::$countProduct);

        echo $temp;
    }

    public function getValue()
    {
        self::$brand = isset($_POST["brand"]) ? $_POST["brand"] : null;
        self::$origin = isset($_POST["origin"]) ? $_POST["origin"] : null;
        self::$size = isset($_POST["size"]) ? $_POST["size"] : null;
        self::$color = isset($_POST["color"]) ? $_POST["color"] : null;
        self::$fromPrice = isset($_POST["fromPrice"]) ? $_POST["fromPrice"] : null;
        self::$toPrice = isset($_POST["toPrice"]) ? $_POST["toPrice"] : null;
        self::$category = isset($_POST["category"]) ? $_POST["category"] : null;
        self::$sorted = isset($_POST["sorted"]) ? $_POST["sorted"] : null;
        self::$reduce = isset($_POST["reduce"]) ? $_POST["reduce"] : 0;
        self::$page = isset($_POST["page"]) ? $_POST["page"] : 0;
        self::$countProduct = isset($_POST["countProduct"]) ? $_POST["countProduct"] : 9;
    }

    public function showBrand()
    {
        $brand = self::$userModel->getBrand();
        echo $brand;
    }

    public function search()
    {
        $keyWord = isset($_POST["keyWord"]) ? $_POST["keyWord"] : null;

        $result = self::$userModel->searchProduct($keyWord);

        echo $result;
    }

    public function getProductMiniCart()
    {
        $model = $this->model("ChiTietSPModel");

        $IDSP = isset($_POST["IDSP"]) ? $_POST["IDSP"] : null;

        if (isset($_SESSION["logined"])) {
            $result = $model->getDetailProduct($IDSP);

            echo $result;
        } else {
            echo 1;
        }
    }

    public function getProductInvolve()
    {
        $model = $this->model("ChiTietSPModel");

        $IDSP = isset($_POST["IDSP"]) ? $_POST["IDSP"] : null;

        if (isset($_SESSION["logined"])) {
            $result = $model->getProductDetailInvolve($IDSP);

            echo $result;
        } else {
            echo 1;
        }
    }
    /*-------------------------------------- get Star Product -------------------------------------- */
    public function getStarProduct()
    {
        $model = $this->model("SanPhamModel");

        $result = $model->getStarProduct();

        echo $result;
    }
    /*-------------------------------------- Reigster -------------------------------------- */

    public function Reigster()
    {
        $name = isset($_POST["name"]) ? $_POST["name"] : null;
        $gender = isset($_POST["gender"]) ? $_POST["gender"] : null;
        $Date = isset($_POST["Date"]) ? $_POST["Date"] : null;
        $Address = isset($_POST["Address"]) ? $_POST["Address"] : null;
        $Email = isset($_POST["Email"]) ? $_POST["Email"] : null;
        $Password = isset($_POST["Password"]) ? $_POST["Password"] : null;

        $model = $this->model("TaiKhoanModel");

        if ($this->checkName($name) == false) {
            echo "Vui lòng điền họ tên của bạn";
            return;
        } else if ($this->checkDate($Date) == false) {
            echo "Vui lòng điền ngày sinh của bạn";
            return;
        } else if ($this->checkAddress($Address) == false) {
            echo "Vui lòng điền địa chỉ của bạn";
            return;
        } else if ($this->checkFormatEmail($Email) == false) {
            echo "Email phải có định dạng '@gmail.com'";
            return;
        } else if ($this->checkPassWord($Password) == false) {
            echo "Mật khẩu phải có độ dài 5 ký tự trở lên";
            return;
        }

        if ($this->checkFormatEmail($Email) && $this->checkPassWord($Password) && $this->checkName($name) && $this->checkDate($Date) && $this->checkAddress($Address)) {
            $result = $model->Reigster($name, $gender, $Date, $Address, $Email, password_hash($Password, PASSWORD_DEFAULT));
            echo $result;
        }
    }

// Hàm checkFormatEmail - thực hiện chức năng chính của hàm checkFormatEmail
    function checkFormatEmail($email)
    {
        $check = strpos($email, "@gmail.com");

        if ($check)
            return true;
        return false;
    }

// Hàm checkPassword - thực hiện chức năng chính của hàm checkPassword
    function checkPassword($password)
    {
        if (strlen($password) < 6)
            return false;
        return true;
    }

// Hàm checkDate - thực hiện chức năng chính của hàm checkDate
    function checkDate($date)
    {
        if (strlen($date) < 10)
            return false;
        return true;
    }

// Hàm checkAddress - thực hiện chức năng chính của hàm checkAddress
    function checkAddress($address)
    {
        if (strlen($address) < 1)
            return false;
        return true;
    }

// Hàm checkName - thực hiện chức năng chính của hàm checkName
    function checkName($name)
    {
        if (strlen($name) < 1)
            return false;
        return true;
    }

    /*-------------------------------------- Login -------------------------------------- */
// Hàm login - thực hiện chức năng chính của hàm login
    function login()
    {
        $Email = isset($_POST["Email"]) ? $_POST["Email"] : null;
        $Password = isset($_POST["Password"]) ? $_POST["Password"] : null;
        $stringSPL = explode("@", $Email)[0];

        $model = $this->model("TaiKhoanModel");

        $result = $model->checkLogin($Email);

        //nếu không tồn tại cookie khóa tài khoản thì được phép đăng nhập
        if (isset($_COOKIE[$stringSPL])) {
            echo "Bạn đăng nhập sai quá 5 lần. Tài khoản tạm khóa 30p!!!";
        } else {
            if (password_verify($Password, $result) == true) {
                $_SESSION["logined"] = $model->getInforAccount($Email);
                $_SESSION["hoTen"] = $_SESSION["logined"][0]["hoTen"];
                $_SESSION["diachi"] = $_SESSION["logined"][0]["diachi"];
                $_SESSION["sdt"] = $_SESSION["logined"][0]["sdt"];
                $_SESSION["email"] = $_SESSION["logined"][0]["email"];
                $_SESSION["passwords"] = $_SESSION["logined"][0]["passwords"];
                $_SESSION["image"] = $_SESSION["logined"][0]["image"];

                //reset số lần đăng nhập sai về 0
                $this->updateLockLogin($Email, 0, 1);

                if (strcmp(strtolower($_SESSION["logined"][0]["role"]), "user") == 0) {
                    echo 1;
                } else if (strcmp(strtolower($_SESSION["logined"][0]["role"]), "admin") == 0) {
                    echo 2;
                }
            } else {
                //Tăng số lần đăng nhập sai lên 1
                $this->updateLockLogin($Email, $this->checkLockLogin($Email) + 1, 0);
                echo "Tài khoản hoặc mật khẩu không đúng";

                if ($this->checkLockLogin($Email) >= 6) {
                    //nếu số lần đăng nhập sai >= 5 thì tạo cookie khóa tài khoản
                    setcookie($stringSPL, "đăng nhập sai quá 5 lần", time() + 15, "/", "",  0);
                }
            }
        }
    }

// Hàm checkLockLogin - thực hiện chức năng chính của hàm checkLockLogin
    function checkLockLogin($Email)
    {
        $model = $this->model("TaiKhoanModel");
        $result = $model->checkLockLogin($Email);

        return $result;
    }

// Hàm updateLockLogin - thực hiện chức năng chính của hàm updateLockLogin
    function updateLockLogin($Email, $amountLogin, $status)
    {
        $model = $this->model("TaiKhoanModel");
        $model->updateLockLogin($Email, $amountLogin, $status);
    }

    /*-------------------------------------- Favourite -------------------------------------- */
// Hàm increaseFavourite - thực hiện chức năng chính của hàm increaseFavourite
    function increaseFavourite()
    {
        $IDKH = isset($_SESSION["logined"][0]["IDTK"]) ? $_SESSION["logined"][0]["IDTK"] : null;
        $IDSP = isset($_POST["IDSP"]) ? $_POST["IDSP"] : null;

        $model = $this->model("SanPhamModel");

        if (isset($_SESSION["logined"])) {
            $model->increaseFavourite($IDKH, $IDSP);
            echo "Sản phẩm đã thêm vào danh sách yêu thích";
        } else {
            echo -1;
        }
    }
    /*-------------------------------------- Increase Cart -------------------------------------- */
// Hàm increaseCart - thực hiện chức năng chính của hàm increaseCart
    function increaseCart()
    {
        $IDKH = isset($_SESSION["logined"][0]["IDTK"]) ? $_SESSION["logined"][0]["IDTK"] : null;
        $IDSP = isset($_POST["IDSP"]) ? $_POST["IDSP"] : null;
        $Amount = isset($_POST["Amount"]) ? $_POST["Amount"] : null;
        $size = isset($_POST["Size"]) ? $_POST["Size"] : null;
        $dateIncrease = new DateTime();
        $model = $this->model("GioHangModel");
        $status = 1;

        if (isset($_SESSION["logined"])) {
            $model->increaseCart($IDKH, $IDSP, $Amount, $size, $dateIncrease, $status);
        } else {
            echo 1;
        }
    }

    /*-------------------------------------- Load Cart -------------------------------------- */
// Hàm loadCart - thực hiện chức năng chính của hàm loadCart
    function loadCart()
    {
        // $data = isset($_POST["items"]) ? $_POST["items"] : null;
        $IDKH = isset($_SESSION["logined"][0]["IDTK"]) ? $_SESSION["logined"][0]["IDTK"] : null;

        // $items = implode(',', explode('-', $data));

        $model = $this->model("GioHangModel");
        $result = $model->loadCart($IDKH);

        echo $result;
    }

    /*-------------------------------------- Update Cart -------------------------------------- */
// Hàm updateCart - thực hiện chức năng chính của hàm updateCart
    function updateCart()
    {
        $IDKH = isset($_SESSION["logined"][0]["IDTK"]) ? $_SESSION["logined"][0]["IDTK"] : null;
        $IDCart = isset($_POST["IDCart"]) ? $_POST["IDCart"] : null;
        $amount = isset($_POST["amount"]) ? $_POST["amount"] : null;
        $IDSP = isset($_POST["IDSP"]) ? $_POST["IDSP"] : null;

        $model = $this->model("GioHangModel");
        $model->updateCart($IDCart, $amount, $IDKH, $IDSP);
    }
    /*-------------------------------------- Place An Order Cart -------------------------------------- */
// Hàm placeAnOrder - thực hiện chức năng chính của hàm placeAnOrder
    function placeAnOrder()
    {
        $data = isset($_POST["items"]) ? $_POST["items"] : null;
        $IDSP = implode(",", explode('-', $data));

        $IDKH = isset($_SESSION["logined"][0]["IDTK"]) ? $_SESSION["logined"][0]["IDTK"] : null;
        $methodPay = isset($_POST["methodPay"]) ? $_POST["methodPay"] : null;
        $name = isset($_POST["name"]) ? $_POST["name"] : null;
        $address = isset($_POST["address"]) ? $_POST["address"] : null;
        $phone = isset($_POST["phone"]) ? $_POST["phone"] : null;
        $email = isset($_POST["email"]) ? $_POST["email"] : null;
        $noted = isset($_POST["noted"]) ? $_POST["noted"] : null;
        $totalPrice = isset($_POST["total_Paypal"]) ? $_POST["total_Paypal"] : null;
        $reduce = isset($_POST["reduce"]) ? $_POST["reduce"] : null;

        $model = $this->model("GioHangModel");
        $result = $model->placeAnOrder($IDKH, $methodPay, $name, $address, $phone, $email, $noted, $IDSP, $reduce, $totalPrice);

        echo $result;
    }

// Hàm sendMail - thực hiện chức năng chính của hàm sendMail
    function sendMail()
    {
        $email = isset($_POST["email"]) ? $_POST["email"] : null;
        $name = isset($_POST["name"]) ? $_POST["name"] : null;
        $model = $this->model("GioHangModel");

        $model->sendMail($email, $name);
    }

    /*-------------------------------------- Detail Product -------------------------------------- */
// Hàm loadDetail - thực hiện chức năng chính của hàm loadDetail
    function loadDetail()
    {
        $IDSP = isset($_POST["IDSP"]) ? $_POST["IDSP"] : null;
        $model = $this->model(("ChiTietSPModel"));
        $result = $model->getDetailProduct($IDSP);

        echo $result;
    }

    /*-------------------------------------- Delete Cart -------------------------------------- */
// Hàm deleteCart - thực hiện chức năng chính của hàm deleteCart
    function deleteCart()
    {
        $IDKH = isset($_SESSION["logined"][0]["IDTK"]) ? $_SESSION["logined"][0]["IDTK"] : null;
        $IDSP = isset($_POST["IDSP"]) ? $_POST["IDSP"] : null;
        $status = 0;
        $model = $this->model(("GioHangModel"));

        $result = $model->deleteCart($IDSP, $IDKH, $status);
    }

    /*-------------------------------------- Undo item -------------------------------------- */
// Hàm undoItem - thực hiện chức năng chính của hàm undoItem
    function undoItem()
    {
        $IDKH = isset($_SESSION["logined"][0]["IDTK"]) ? $_SESSION["logined"][0]["IDTK"] : null;
        $model = $this->model(("GioHangModel"));

        $result = $model->undoItem($IDKH);
        
        echo $result;
    }


    /*-------------------------------------- Changed Avatar-------------------------------------- */
// Hàm changedAvatar - thực hiện chức năng chính của hàm changedAvatar
    function changedAvatar()
    {
        $IDKH = isset($_SESSION["logined"][0]["IDTK"]) ? $_SESSION["logined"][0]["IDTK"] : null;
        $dir = "Public/image/Avatar";
        $file = $_FILES["Avatar"]["tmp_name"];
        $date = date("Y_m_d_H_s_i");
        $nameFile = explode('.', $_FILES["Avatar"]["name"]);
        $path = $dir . "/" . $nameFile[0] . $date . '.' . $nameFile[1];

        if (!file_exists($dir)) {
            mkdir($dir);
        }

        $arrayFile = array("jpg", "png", "jpeg", "gif");
        $fileName = pathinfo($_FILES["Avatar"]["name"], PATHINFO_EXTENSION);
        $checkFile = false;

        foreach ($arrayFile as $item) {
            if ($fileName == $item) {
                $checkFile = true;
            }
        }

        if ($_FILES["Avatar"]["size"] > 1000000) {
            echo 2;
        } else if ($checkFile == true) {
            move_uploaded_file($file, $path);

            $model = $this->model(("TaiKhoanModel"));

            $result = $model->changedAvatar($IDKH, $path);

            $_SESSION["logined"][0]["image"] =  $result;

            echo $path;
        } else {
            echo 1;
        }
    }
}
