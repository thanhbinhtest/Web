<?php
// Định nghĩa lớp chính và các thuộc tính, phương thức của lớp
    class Branch extends controller
    {
        private $model;

// Hàm __construct - thực hiện chức năng chính của hàm __construct
        function __construct()
        {
            $this->model = $this->modelAdmin("ProductModel");
        }

// Hàm show - thực hiện chức năng chính của hàm show
        function show()
        {
            self::viewAdmin('master', ["page" => "Branch"]);
        }
        
// Hàm insertCategories - thực hiện chức năng chính của hàm insertCategories
        function insertCategories()
        {
            $name = isset($_POST["name"]) ? $_POST["name"] : null;
            $category = isset($_POST["category"]) ? $_POST["category"] : null;

            $this->model->insertCategories($name,$category);
        }
        
// Hàm removeCategories - thực hiện chức năng chính của hàm removeCategories
        function removeCategories()
        {
            $ID = isset($_POST["ID"]) ? $_POST["ID"] : null;

            $this->model->removeCategories($ID);
        }

// Hàm updateCategories - thực hiện chức năng chính của hàm updateCategories
        function updateCategories()
        {
            $ID = isset($_POST["ID"]) ? $_POST["ID"] : null;
            $name = isset($_POST["name"]) ? $_POST["name"] : null;
            $category = isset($_POST["category"]) ? $_POST["category"] : null;

            $this->model->updateCategories($ID,$name,$category);
        }
        
// Hàm insertProduce - thực hiện chức năng chính của hàm insertProduce
        function insertProduce()
        {
            $name = isset($_POST["name"]) ? $_POST["name"] : null;
            $this->model->insertProduce($name);
        }

// Hàm updateProduce - thực hiện chức năng chính của hàm updateProduce
        function updateProduce()
        {
            $ID = isset($_POST["ID"]) ? $_POST["ID"] : null;
            $name = isset($_POST["name"]) ? $_POST["name"] : null;

            $this->model->updateProduce($ID,$name);
        }     
        
// Hàm removeProduce - thực hiện chức năng chính của hàm removeProduce
        function removeProduce()
        {
            $ID = isset($_POST["ID"]) ? $_POST["ID"] : null;
            
            $this->model->removeProduce($ID);
        }

        public function insertBrand()
        {
            $name = isset($_POST["name"]) ? $_POST["name"] : null;

            $this->model->insertBrand($name);
        }

// Hàm updateBrand - thực hiện chức năng chính của hàm updateBrand
        function updateBrand()
        {
            $ID = isset($_POST["ID"]) ? $_POST["ID"] : null;
            $name = isset($_POST["name"]) ? $_POST["name"] : null;

            $this->model->updateBrand($ID,$name);  
        }

// Hàm removeBrand - thực hiện chức năng chính của hàm removeBrand
        function removeBrand()
        {
            $ID = isset($_POST["ID"]) ? $_POST["ID"] : null;

            $this->model->removeBrand($ID);
        }
    }
?>