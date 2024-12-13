<?php
// Định nghĩa lớp chính và các thuộc tính, phương thức của lớp
    class Home extends controller
    {
        private $model;

// Hàm __construct - thực hiện chức năng chính của hàm __construct
        function __construct()
        {
            $this->model = $this->modelAdmin("HomeModel");
        }
        
// Hàm show - thực hiện chức năng chính của hàm show
        function show()
        {
            self::viewAdmin('master',[
                "page" => "Home",
            ]);
            
        }

// Hàm changedAccount - thực hiện chức năng chính của hàm changedAccount
        function changedAccount($IDKH, $Name)
{
    // Gọi hàm updateUserName để cập nhật tên người dùng
    $result = $this->model->updateUserName($IDKH, $Name);

    // Kiểm tra kết quả của hàm và thực hiện các xử lý phù hợp
    if ($result) {
        // Nếu cập nhật thành công, bạn có thể thực hiện các xử lý khác ở đây
    } else {
        // Nếu cập nhật không thành công, bạn có thể xử lý lỗi ở đây
    }
}

// Hàm amountNewBills - thực hiện chức năng chính của hàm amountNewBills
        function amountNewBills()
        {
            $result = $this->model->amountNewBills();

            echo $result;
        }

// Hàm amountAccount - thực hiện chức năng chính của hàm amountAccount
        function amountAccount()
        {
            $result = $this->model->amountAccount();

            echo $result;
        }

// Hàm amountProductSelled - thực hiện chức năng chính của hàm amountProductSelled
        function amountProductSelled()
        {
            $result = $this->model->amountProductSelled();

            echo $result;
        }

// Hàm amountProduct - thực hiện chức năng chính của hàm amountProduct
        function amountProduct()
        {
            $result = $this->model->amountProduct();

            echo $result;
        }
        
// Hàm amountLogined - thực hiện chức năng chính của hàm amountLogined
        function amountLogined()
        {
            $result = $this->model->amountLogined(); 

            echo $result;
        }

// Hàm apiTopProductSellest - thực hiện chức năng chính của hàm apiTopProductSellest
        function apiTopProductSellest()
        {
            $result = $this->model->apiTopProductSellest();
            
            echo $result;
        }
        
// Hàm apiNewUser - thực hiện chức năng chính của hàm apiNewUser
        function apiNewUser()
        {
            $result = $this->model->apiNewUser();
            
            echo $result; 
        }

// Hàm productSelledOfMonth - thực hiện chức năng chính của hàm productSelledOfMonth
        function productSelledOfMonth()
        {
            $result = $this->model->productSelledOfMonth();
            
            echo $result; 
        }

// Hàm productDiscountOfMonth - thực hiện chức năng chính của hàm productDiscountOfMonth
        function productDiscountOfMonth()
        {
            $result = $this->model->productDiscountOfMonth();
            
            echo $result; 
        }

// Hàm revenueOfMonth - thực hiện chức năng chính của hàm revenueOfMonth
        function revenueOfMonth()
        {
            $result = $this->model->revenueOfMonth();
            
            echo $result; 
        }

// Hàm billOfMonth - thực hiện chức năng chính của hàm billOfMonth
        function billOfMonth()
        {
            $result = $this->model->billOfMonth();
            
            echo $result; 
        }

// Hàm topCustomerLoyal - thực hiện chức năng chính của hàm topCustomerLoyal
        function topCustomerLoyal()
        {
            $result = $this->model->topCustomerLoyal();
            
            echo $result; 
        }

// Hàm topCustomerRank - thực hiện chức năng chính của hàm topCustomerRank
        function topCustomerRank()
        {
            $result = $this->model->topCustomerRank();
            
            echo $result; 
        }

// Hàm chartProductSelled - thực hiện chức năng chính của hàm chartProductSelled
        function chartProductSelled()
        {
            $result = $this->model->chartProductSelled();
            
            echo $result; 
        }

// Hàm logOut - thực hiện chức năng chính của hàm logOut
        function logOut()
        {
            if(isset($_SESSION["logined"]))
            {
                $this->model("TaiKhoanModel")->LogOut($_SESSION["email"]);

                unset($_SESSION["logined"]);
                unset($_SESSION["hoTen"]);
                unset($_SESSION["diachi"]);
                unset($_SESSION["sdt"]);
                unset($_SESSION["email"]);
            }
        }
    }
?>