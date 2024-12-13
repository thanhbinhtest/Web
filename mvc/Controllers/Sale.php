<?php
// Định nghĩa lớp chính và các thuộc tính, phương thức của lớp
    class Sale extends Controller
    {
// Hàm show - thực hiện chức năng chính của hàm show
        function show()
        {
            $model = $this->model("SanPhamModel");
            $brand = $model->getBrand();
            $origin = $model->getOrigin();
            $color = $model->getColor();
            $size = $model->getSize();
            $category = $model->getCategories();

            self::view("master",
                    [  
                        "page" => "Sale",
                        "brand" => $brand,
                        "origin" => $origin,
                        "color" => $color,
                        "size" => $size, 
                        "category" => json_decode($category,true),
                        "title" => "Khuyến mãi"
                    ]);
                    
        }
    }
