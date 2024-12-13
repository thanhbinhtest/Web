$(document).ready(function(){

    //realtime logined
// Khởi tạo biến currentLogined
    let currentLogined = function(){
        $.post("./Home/amountLogined", function(data){
            $('.currentLogined').html(data);
        })
    }

    currentLogined();

    //realtime register
// Khởi tạo biến currentRegister
    let currentRegister = function(){
        $.post("./Home/amountAccount", function(data){
            $('.currentAccount').html(data);
        })
    }

    currentRegister();

    //realtime selled
// Khởi tạo biến currentSelled
    let currentSelled = function(){
        $.post("./Home/amountProductSelled", function(data){
            $('.currentSelled').html(data);
        })
    }

    currentSelled();

    //realtime product
// Khởi tạo biến currentProduct
    let currentProduct = function(){
        $.post("./Home/amountProduct", function(data){
            $('.currentProduct').html(data);
        })
    }

    currentProduct();

    //realtime top product sellest
// Khởi tạo biến currentProductSellest
    let currentProductSellest = function(){
        $.post("./Home/apiTopProductSellest", function(data){
// Khởi tạo biến obj
            let obj = JSON.parse(data);
// Khởi tạo biến result
            let result = '';

            obj.forEach(element => {
                result += `<div class="card-product__selles--item">
                            <img src=`+ '../' + element.image +` alt="">
                            <p>`+element.tenSP+`</p>
                            <p>`+ changedPrice(element.total - 0)+`</p>
                        </div>`;
            });

            $('.card-product__selles--items').html(result);
        })
    }

    currentProductSellest();

    //realtime new usert
// Khởi tạo biến currentNewUser
    let currentNewUser = function(){
        $.post("./Home/apiNewUser", function(data){
// Khởi tạo biến obj
            let obj = JSON.parse(data);
// Khởi tạo biến result
            let result = '';

            obj.forEach(element => {
                result += `<div class="card__user--item card-item">
                                <img class="card__user--item-image" src=`+ '../' +element.image+` alt="">
                                <p class="card-item--name">`+element.hoTen+`</p>
                                <p>`+element.role+`</p>
                            </div>`;
            });
            
            $('.card__user--items').html(result);
        })
    }

    currentNewUser();

    //realtime product saled of month
// Khởi tạo biến productSellOfMonth
    let productSellOfMonth = function(){
        $.post("./Home/productSelledOfMonth", function(data){
            
            $('.productSell__OfMonth').html(changedPrice(data - 0) );
        })
    }

    productSellOfMonth();

    //realtime product discount of month
// Khởi tạo biến productDiscountOfMonth
    let productDiscountOfMonth = function(){
        $.post("./Home/productDiscountOfMonth", function(data){
            
            $('.productDiscount__OfMonth').html(changedPrice(data - 0));
        })
    }

    productDiscountOfMonth();

    //realtime revenue of month
// Khởi tạo biến revenueOfMonth
    let revenueOfMonth = function(){
        $.post("./Home/revenueOfMonth", function(data){
            
            $('.revenue__OfMonth').html(changedPrice(data - 0));
        })
    }

    revenueOfMonth();

    //realtime bill of month
// Khởi tạo biến billOfMonth
    let billOfMonth = function(){
        $.post("./Home/billOfMonth", function(data){
            
            $('.bill__OfMonth').html(changedPrice(data - 0));
        })
    }

    billOfMonth();

    //realtime top 3 customer loyal
// Khởi tạo biến topCustomerLoyal
    let topCustomerLoyal = function(){
        $.post("./Home/topCustomerLoyal", function(data){
// Khởi tạo biến obj
            let obj = JSON.parse(data);
// Khởi tạo biến result
            let result = '';

            obj.forEach(element => {
                result +=  `<div class="card-customer__item--content">
                                <img src=`+ '../' + element.image+` alt="">
                                <p class="card-item--name">`+element.hoTen+`</p>
                                <p>`+element.amount+`</p>
                                <p>`+changedPrice(element.total - 0)+`</p>
                            </div>`;
            });

            $('.Card-customer__Loyal').html(result);
        })
    }

    topCustomerLoyal();

    //realtime top 3 customer loyal
// Khởi tạo biến topCustomerRank
    let topCustomerRank = function(){
        $.post("./Home/topCustomerRank", function(data){
// Khởi tạo biến obj
            let obj = JSON.parse(data);
// Khởi tạo biến result
            let result = '';

            obj.forEach(element => {
                result +=  `<div class="card-customer__item--content card-customer__ranks">
                                <img src=`+ '../' +element.image+` alt="">
                                <p class="card-item--name">`+element.hoTen+`</p>
                                <p>`+getRank(element.ranks)+`</p>
                            </div>`;
            });

            $('.card-customer__Highest-Rate').html(result);
        })
    }

    topCustomerRank();

    //sau 30p load 1 lần
    // setInterval(() => {
    //     currentNewUser();
    //     currentProductSellest();
    //     topCustomerLoyal();
    //     topCustomerRank();
    // }, 30000);

    //sau 1s load 1 lần
    // setInterval(() => {
    //     currentSelled();
    //     currentLogined();
    //     currentRegister();
    //     currentProduct();
    //     billOfMonth();
    //     revenueOfMonth();
    //     productSellOfMonth();
    //     productDiscountOfMonth();
    // }, 1000);

    //event 
    apiEvent();

// Hàm apiEvent - thực hiện chức năng chính của hàm apiEvent
    function apiEvent()
    {
        $.post("./Event/apiListEvent", function(data){
// Khởi tạo biến obj
            let obj = JSON.parse(data);
// Khởi tạo biến result
            let result = '';

            obj.forEach(element => {
                result += `<div class="card__event-item card-item">
                                <img class="card__user--item-image" src=`+ '../' + element.image+` alt="">
                                <p class="card-item--name">`+element.tenSK+`</p>
                                <i class="fa-solid fa-circle-info" data-id=`+element.ID+`></i>
                            </div>`;
            });
            
            $('.card__event--items').html(result);
        })
    }

    //hiển thị rank theo điểm
// Hàm getRank - thực hiện chức năng chính của hàm getRank
    function getRank(point)
    {
// Khởi tạo biến rank
        let rank = "";

        switch(point)
        {
            case 1: rank = "Đồng";
                    break;
            case 2: rank = "Bạc";
                    break;
            case 3: rank = "Vàng";
                    break;
            case 4: rank = "Kim cương";
                    break;
            case 5: rank = "Tinh anh";
                    break;
            default: rank = "Hội viên";
                    break;
        }

        return rank;
    }

    //định giá tiền VNĐ
// Hàm changedPrice - thực hiện chức năng chính của hàm changedPrice
    function changedPrice(price) {
// Khởi tạo biến priceChanged
        var priceChanged = price.toLocaleString("vi-VN", {
          style: "currency",
          currency: "VND",
        });
      
        return priceChanged;
    }
      
    amountNewBills();

// Hàm amountNewBills - thực hiện chức năng chính của hàm amountNewBills
    function amountNewBills()
    {
        $.post("./Home/amountNewBills", function(data){
// Khởi tạo biến obj
            let obj = JSON.parse(data);

            $('.amount-notify--bills').html(obj.length);
        })
    }

    $('.notifycation').click(function(){

        $('.notify-bills').fadeIn(500);

        $.post("./Home/amountNewBills", function(data){
// Khởi tạo biến obj
            let obj = JSON.parse(data);
// Khởi tạo biến result
            let result = "";

            obj.forEach(element => {
                result += ` <a href="Bills" class="notify-bills__item">
                                <img src=`+ '../' + element.image+` alt="">
                                <div class="notify-bills__item--content">
                                    <p>`+element.hoTen+`</p>
                                    <p>`+element.ngayDat+`</p>
                                </div>
                                <p class='notify-bills__status'>`+element.tinhTrang+`</p>
                            </a>`;
            })

            $('.notify-bills__container').html(result);
        })
    })

    $('.notify-close').click(function(){
        $('.notify-bills').fadeOut(500);
    })
})