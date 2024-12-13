<?php
// Định nghĩa lớp chính và các thuộc tính, phương thức của lớp
    class Event extends controller
    {
        private $model;
        private $image;
        private $ID;
        
// Hàm __construct - thực hiện chức năng chính của hàm __construct
        function __construct()
        {
            $this->model = $this->modelAdmin("EventModel");
        }

// Hàm show - thực hiện chức năng chính của hàm show
        function show()
        {
            $categories = $this->modelAdmin("ProductModel")->apiCategories();
            
            self::viewAdmin('master', 
                            [   'page' => "Events",
                                'categories' => json_decode($categories,true)
                            ]);
        }

// Hàm apiListEvent - thực hiện chức năng chính của hàm apiListEvent
        function apiListEvent()
        {
            $keyword = isset($_POST["keyword"]) ? $_POST["keyword"] : null;

            $result = $this->model->apiListEvent($keyword);

            echo $result;
        }

// Hàm insertEvent - thực hiện chức năng chính của hàm insertEvent
        function insertEvent()
        {
            $name = isset($_POST["event--name"]) ? $_POST["event--name"] : null;
            $content = isset($_POST["event--content"]) ? $_POST["event--content"] : null;
            $dateStart = isset($_POST["event--datestart"]) ? $_POST["event--datestart"] : null;
            $dateEnd = isset($_POST["event--dateend"]) ? $_POST["event--dateend"] : null;
            $categories = isset($_POST["event-categories"]) ? $_POST["event-categories"] : null;
            $discount = isset($_POST["event-discount"]) ? $_POST["event-discount"] : null;
            $gifCode = isset($_POST["event--code"]) ? $_POST["event--code"] : null;

            $this->model->insertEvent($name,$content,$dateStart,$dateEnd,$this->image);
        

            if(!empty($gifCode))
            {
                $IDSK = $this->model->getSK();

                $this->model->insertGiftCode($IDSK, $gifCode, $discount);
            }

            if(!empty($discount) && !empty($categories))
            {
                $this->updateDiscount($categories,$discount);
            }
        }

// Hàm updateDiscount - thực hiện chức năng chính của hàm updateDiscount
        function updateDiscount($categories,$discount)
        {
            $products = $this->getProductByCategories($categories);
            $IDSK = $this->model->getSK();

            foreach($products as $item)
            {
                $this->model->updateDiscount($IDSK,$item["ID"],$discount);
            }
        }

// Hàm getProductByCategories - thực hiện chức năng chính của hàm getProductByCategories
        function getProductByCategories($ID)
        {
            $result = $this->model->getProductByCategories($ID);

            return json_decode($result,true);
        }

// Hàm updateEvent - thực hiện chức năng chính của hàm updateEvent
        function updateEvent()
        {
            $name = isset($_POST["event--name"]) ? $_POST["event--name"] : null;
            $content = isset($_POST["event--content"]) ? $_POST["event--content"] : null;
            $dateStart = isset($_POST["event--datestart"]) ? $_POST["event--datestart"] : null;
            $dateEnd = isset($_POST["event--dateend"]) ? $_POST["event--dateend"] : null;

            $this->model->updateEvent($this->ID,$name,$content,$dateStart,$dateEnd, $this->image);
        }

// Hàm removeEvent - thực hiện chức năng chính của hàm removeEvent
        function removeEvent()
        {
            $ID = isset($_POST["ID"]) ? $_POST["ID"] : null;

            $this->model->removeEvent($ID);
        }

        
// Hàm ChangedImage - thực hiện chức năng chính của hàm ChangedImage
        function ChangedImage()
        {            
            $dir = "Public/image/SuKien/";
            $file1 = $_FILES["Image"]["tmp_name"];
            $path1 = $dir .$_FILES["Image"]["name"];

            if(!file_exists($dir))
            {
                mkdir($dir);
            }

            if ($_FILES["Image"]["size"] > 5000000) {
                echo 2;
                return;
            }

            move_uploaded_file($file1,$path1);

            $this->image = $path1;
            $this->insertEvent();
        }
    }
?>