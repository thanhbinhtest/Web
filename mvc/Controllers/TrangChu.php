<?php
// Định nghĩa lớp chính và các thuộc tính, phương thức của lớp
    class TrangChu extends Controller
    {
// Hàm show - thực hiện chức năng chính của hàm show
        function show()
        {
            $temp = self::model("SanPhamModel");
            $result = $temp->saleHome();
            $proDuctSale = $temp->productSale();
            $bestProDuctSelling = $temp->bestProductSelling();
            $getStarProduct = $temp->getStarProduct();
            $news = json_decode($this->model("TinTucModel")->loadNews(null,false,9),true);
            
            self::view("master",
                ["product" => $result,
                 "page" => "TrangChu",
                 "productSale" => $proDuctSale,
                 "bestProSelling" => $bestProDuctSelling,
                 "star"=> json_decode($getStarProduct,true),
                 "news" => $news,
                ]
            );
        }

// Hàm loadBannerEvent - thực hiện chức năng chính của hàm loadBannerEvent
        function loadBannerEvent()
        {
            $result = $this->modelAdmin("EventModel")->apiListEvent();

            echo $result;
        }
    }
?>