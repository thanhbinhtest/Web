// Khởi tạo biến checkIndex
var checkIndex = location.href.indexOf("TrangChu");

    // Section 11 - slider
// Khởi tạo biến list
    const list = document.querySelector(".About .About_slider");
// Khởi tạo biến item
    const item = document.querySelectorAll(".About .About_slider .About_item");
// Khởi tạo biến dots
    const dots = document.querySelectorAll(".About .About_slider .dots li");

// Khởi tạo biến slideBanner
    const slideBanner = document.querySelector('.section__1--slide');
// Khởi tạo biến countBanner
    const countBanner = document.querySelectorAll('.slide--subItem');
// Khởi tạo biến slideMain
    const slideMain = document.querySelector('.Iteams__Brand');
// Khởi tạo biến slideSale
    const slideSale = document.querySelector('.Contain__ProductSale');
// Khởi tạo biến slideProSale=
    const slideProSale= document.querySelector('.Item__Sale');
// Khởi tạo biến countProSale
    const countProSale = document.querySelectorAll('.proDuct__Lenght');
// Khởi tạo biến slideNews
    const slideNews = document.querySelector('.Contain__New');

// Khởi tạo biến lengthNews
    const lengthNews = document.querySelectorAll('.NewItem');
// Khởi tạo biến lenghtBrand
    const lenghtBrand = document.querySelectorAll('.subItem__Brand');
// Khởi tạo biến countpProdDuct__sale
    const countpProdDuct__sale = document.querySelectorAll('.prodDuct__sale--PageMain');

// Khởi tạo biến preSlideBanner
    var preSlideBanner = document.querySelector('.left__Banner');
// Khởi tạo biến nextSlideBanner
    var nextSlideBanner = document.querySelector('.right__Banner');
// Khởi tạo biến nextSlide
    var nextSlide = document.querySelector('.rigthBrand');
// Khởi tạo biến preSlide
    var preSlide = document.querySelector('.leftBrand');
// Khởi tạo biến nextSlideSale
    var nextSlideSale = document.querySelector('.right__Sale');
// Khởi tạo biến preSlideSale
    var preSlideSale = document.querySelector('.left__Sale');
// Khởi tạo biến nextSlideProSale
    var nextSlideProSale = document.querySelector('.product__Right');
// Khởi tạo biến preSlideProSale
    var preSlideProSale = document.querySelector('.product__Left');
// Khởi tạo biến nextSlideNews=
    var nextSlideNews= document.querySelector('.newRight');
// Khởi tạo biến preSlideNews=
    var preSlideNews= document.querySelector('.newLeft');
    
// Điều kiện kiểm tra
    if(nextSlide != null)
    {
        nextSlide.addEventListener("click",() => slider('right'));
    }
// Điều kiện kiểm tra
    if(preSlide != null)
    {
        preSlide.addEventListener("click",() => slider('left'));
    }

// Điều kiện kiểm tra
    if(nextSlideSale != null)
    {
        nextSlideSale.addEventListener("click",() => slider('rightSale'));
    }

// Điều kiện kiểm tra
    if(preSlideSale != null)
    {
        preSlideSale.addEventListener("click",() => slider('leftSale'));
    }

// Điều kiện kiểm tra
    if(nextSlideProSale != null)
    {
        nextSlideProSale.addEventListener("click",() => slider('productRight'));
    }

// Điều kiện kiểm tra
    if(preSlideProSale != null)
    {
        preSlideProSale.addEventListener("click",() => slider('productLeft'));
    }

// Điều kiện kiểm tra
    if(nextSlideBanner != null)
    {
        nextSlideBanner.addEventListener("click",() => slider('bannerRight'));
    }
    
// Điều kiện kiểm tra
    if(preSlideBanner != null)
    {
        preSlideBanner.addEventListener("click",() => slider('bannerLeft'));
    }

// Điều kiện kiểm tra
    if(preSlideNews != null)
    {
        preSlideNews.addEventListener("click",() => slider('newLeft'));
    }

// Điều kiện kiểm tra
    if(nextSlideNews != null)
    {
        nextSlideNews.addEventListener("click",() => slider('newRight'));
    }
    
    
// Khởi tạo biến index
    var index = 0;
// Khởi tạo biến indexSale
    var indexSale = 0;
// Khởi tạo biến indexProSale
    var indexProSale = 0;
// Khởi tạo biến indexBanner
    var indexBanner = 0;
// Khởi tạo biến indexNew
    var indexNew = 0;
    
// Khởi tạo biến active
    let active = 0;
// Khởi tạo biến lengthItems
    let lengthItems = item.length-1;

// Hàm updateDisplay - thực hiện chức năng chính của hàm updateDisplay
    function updateDisplay() {
        item.forEach((slide, index) => {
// Khởi tạo biến distance
            const distance = Math.abs(index - active);
// Khởi tạo biến translateValue
            const translateValue = index - active;
            slide.style.opacity = distance === 0 ? 1 : 0.5;
        });
    
        dots.forEach((dot, index) => {
            dot.classList.toggle("dots_active", index === active);
        });
    }
    
// Hàm nextSlideDots - thực hiện chức năng chính của hàm nextSlideDots
    function nextSlideDots() {
// Điều kiện kiểm tra
        if (active + 1 > lengthItems) {
            active = 0;
        } else {
            active = active + 1;
        }
        updateDisplay();
    }
    
    dots.forEach((dot, index) => {
        dot.addEventListener("click", function () {
            active = index;
            updateDisplay();
        });
    });
    
    // Tự động chuyển đổi sau mỗi 3 giây
    setInterval(nextSlideDots, 3000);
    
    // Khởi tạo hiển thị mặc định
    updateDisplay();


// Hàm slider - thực hiện chức năng chính của hàm slider
    function slider(param)
    {
// Điều kiện kiểm tra
        if(param === "right")
        {
            index++;
    
// Điều kiện kiểm tra
            if(screen.width > 1024)
            {
// Điều kiện kiểm tra
                if(index > getLength(lenghtBrand.length,6))
                {
                    index = 0;
                }
            }
// Điều kiện kiểm tra
            else
            {
// Điều kiện kiểm tra
                if(screen.width > 750)
                {
// Điều kiện kiểm tra
                    if(index > getLength(lenghtBrand.length,4))
                    {
                        index = 0;
                    }   
                }
// Điều kiện kiểm tra
                else
                {
// Điều kiện kiểm tra
                    if(index > getLength(lenghtBrand.length,2))
                    {
                        index = 0;
                    }   
                }

            }

            updateSlide("right")
        }        
// Điều kiện kiểm tra
        else if(param === "left")
        {
            index--;
// Điều kiện kiểm tra
            if(screen.width > 1024)
            {
// Điều kiện kiểm tra
                if(index < 0)
                {
                    index = getLength(lenghtBrand.length,6);
                }
            }
// Điều kiện kiểm tra
            else
            {    
// Điều kiện kiểm tra
                if(screen.width > 750)
                {
// Điều kiện kiểm tra
                    if(index < 0)
                    {
                        index = getLength(lenghtBrand.length,4);
                    }
                }
// Điều kiện kiểm tra
                else
                {
// Điều kiện kiểm tra
                    if(index < 0)
                    {
                        index = getLength(lenghtBrand.length,2);
                    }
                }
            }

            updateSlide("left");
        }
// Điều kiện kiểm tra
        else if(param === "rightSale")
        {
            indexSale++;
    
// Điều kiện kiểm tra
            if(indexSale > countpProdDuct__sale.length - 1)
            {
                indexSale = 0;
            }

            updateSlide("rightSale")
        }
// Điều kiện kiểm tra
        else if(param === "leftSale")
        {
            indexSale--;

// Điều kiện kiểm tra
            if(indexSale < 0)
            {
                indexSale = countpProdDuct__sale.length - 1;
            }
            
            updateSlide("leftSale")
        }
// Điều kiện kiểm tra
        else if(param === "productRight")
        {
            indexProSale++;
            
// Điều kiện kiểm tra
            if(screen.width <= 1024)
            {
// Điều kiện kiểm tra
                if(indexProSale > getLength(countProSale.length,1))
                {
                    indexProSale = 0;
                }
            }
// Điều kiện kiểm tra
            else
            {
// Điều kiện kiểm tra
                if(indexProSale > getLength(countProSale.length,4))
                {
                    indexProSale = 0;
                }
            }

            updateSlide("productRight")
        }
// Điều kiện kiểm tra
        else if(param === "productLeft")
        {
            indexProSale--;
    
// Điều kiện kiểm tra
            if(screen.width <= 1024)
            {
// Điều kiện kiểm tra
                if(indexProSale < 0)
                {
                    indexProSale = getLength(countProSale.length,1);
                }
            }
// Điều kiện kiểm tra
            else
            {
// Điều kiện kiểm tra
                if(indexProSale < 0)
                {
                    indexProSale = getLength(countProSale.length,4);
                }
            }

            updateSlide("productLeft")
        }
// Điều kiện kiểm tra
        else if(param === "bannerRight")
        {
            indexBanner++;
    
// Điều kiện kiểm tra
            if(indexBanner > countBanner.length - 1)
            {
                indexBanner = 0;
            }
            
            updateSlide("bannerRight")
        }
// Điều kiện kiểm tra
        else if(param === "bannerLeft")
        {
            indexBanner--;
    
// Điều kiện kiểm tra
            if(indexBanner < 0)
            {
                indexBanner = countBanner.length - 1;
            }
            updateSlide("bannerLeft")
        }
// Điều kiện kiểm tra
        else if(param === "newRight")
        {
            indexNew++;
            
// Điều kiện kiểm tra
            if(indexNew > lengthNews.length - 3)
            {
                indexNew = 0;
            }
            
            updateSlide("newRight")
        }
// Điều kiện kiểm tra
        else if(param === "newLeft")
        {
            indexNew--;
    
// Điều kiện kiểm tra
            if(indexNew < 0)
            {
                indexNew = lengthNews.length - 3;
            }
            updateSlide("newLeft")
        }
    
// Hàm updateSlide - thực hiện chức năng chính của hàm updateSlide
        function updateSlide(value)
        {
// Điều kiện kiểm tra
            if(screen.width <= 736){
// Điều kiện kiểm tra
                if(value === "left" || value === "right")
                {
                    slideMain.style.transform = `translateX(-${index * 100}%)`;
                }
// Điều kiện kiểm tra
                else if(value === "rightSale" || value === "leftSale")
                {
                    slideSale.style.transform = `translateX(-${indexSale * 100}%)`;
                }
// Điều kiện kiểm tra
                else if(value === "productRight" || value === "productLeft")
                {
                    slideProSale.style.transform = `translateX(-${indexProSale * 100}%)`;
                }
// Điều kiện kiểm tra
                else if(value === "bannerRight" || value === "bannerLeft")
                {
                    slideBanner.style.transform = `translateX(-${indexBanner * 100}%)`;
                }
// Điều kiện kiểm tra
                else if(value === "newRight" || value === "newLeft")
                {
                    slideNews.style.transform = `translateX(-${indexNew * 100}%)`;
                }
                }
// Điều kiện kiểm tra
                else if(screen.width > 736 && screen.width < 1024){
// Điều kiện kiểm tra
                    if(value === "left" || value === "right")
                    {
                        slideMain.style.transform = `translateX(-${index * 100}%)`;
                    }
// Điều kiện kiểm tra
                    else if(value === "rightSale" || value === "leftSale")
                    {
                        slideSale.style.transform = `translateX(-${indexSale * 85}%)`;
                    }
// Điều kiện kiểm tra
                    else if(value === "productRight" || value === "productLeft")
                    {
                        slideProSale.style.transform = `translateX(-${indexProSale * 85}%)`;
                    }
// Điều kiện kiểm tra
                    else if(value === "bannerRight" || value === "bannerLeft")
                    {
                        slideBanner.style.transform = `translateX(-${indexBanner * 85}%)`;
                    }
// Điều kiện kiểm tra
                    else if(value === "newRight" || value === "newLeft")
                    {
                        slideNews.style.transform = `translateX(-${indexNew * 85}%)`;
                    }
                }
// Điều kiện kiểm tra
                else{
// Điều kiện kiểm tra
                    if(value === "left" || value === "right")
                    {
                        slideMain.style.transform = `translateX(-${index * 100}%)`;
                    }
// Điều kiện kiểm tra
                    else if(value === "rightSale" || value === "leftSale")
                    {
                        slideSale.style.transform = `translateX(-${indexSale * 24}%)`;
                    }
// Điều kiện kiểm tra
                    else if(value === "productRight" || value === "productLeft")
                    {
                        slideProSale.style.transform = `translateX(-${indexProSale * 25}%)`;
                    }
// Điều kiện kiểm tra
                    else if(value === "bannerRight" || value === "bannerLeft")
                    {
                        slideBanner.style.transform = `translateX(-${indexBanner * 33.333}%)`;
                    }
// Điều kiện kiểm tra
                    else if(value === "newRight" || value === "newLeft")
                    {
                        slideNews.style.transform = `translateX(-${indexNew * 100}%)`;
                    }
            }    
        }
    }
    
// Điều kiện kiểm tra
    if(screen.width > 1024)
    {
// Điều kiện kiểm tra
        if(nextSlide != null && nextSlideSale != null && nextSlideProSale != null && nextSlideProSale && nextSlideNews != null && nextSlide != null)
        {
            setInterval(() =>
            {
                nextSlide.click();
                nextSlideSale.click();
                nextSlideProSale.click();
                nextSlideNews.click();
                nextSlideBanner.click();
            },3000);
        }
    }

/* Chi tiết sản phẩm */
// Khởi tạo biến temp
var temp = document.querySelectorAll('.detailProduct--Image');
// Khởi tạo biến slideDetails
const slideDetails = document.querySelector('.detailProduct__mainImage');

// Khởi tạo biến indexDetail
var indexDetail = 0;

// Điều kiện kiểm tra
if(temp.length > 0) {
    temp[0].onclick = function()
    {
        document.querySelector('.showMainImage').src = temp[0].src;
        indexDetail = 0;
        updateSlideDetail()
    }

    temp[1].onclick = function()
    {
        document.querySelector('.showMainImage').src = temp[1].src;
        indexDetail = 1;
        updateSlideDetail()
    }
    temp[2].onclick = function()
    {
        document.querySelector('.showMainImage').src = temp[2].src;
        indexDetail = 2;
        updateSlideDetail()
        console.log(indexDetail);
    }
}


// Hàm updateSlideDetail - thực hiện chức năng chính của hàm updateSlideDetail
function updateSlideDetail()
{
// Điều kiện kiểm tra
    if(screen.width <= 736)
    {
        slideDetails.style.transform = `translateX(-${indexDetail * 100}%)`;
    }
// Điều kiện kiểm tra
    else if(screen.width > 736 && screen.width < 1024)
    {
        slideDetails.style.transform = `translateX(-${indexDetail * 5}%)`;
    }
// Điều kiện kiểm tra
    else
    {
        slideDetails.style.transform = `translateX(-${indexDetail * 85}%)`;
    }
}

/* tab__selection */

// Khởi tạo biến tabDetail
var tabDetail = document.querySelectorAll('.tab__selection');

changeColor(tabDetail,0);

// Điều kiện kiểm tra
if(tabDetail.length > 0)
{
    tabDetail[0].onclick = function()
    {
        changeDisplay(".tabDescription",'.guideBuyProduct','.provisionService')
        changeColor(tabDetail, 0);
    }
    tabDetail[1].onclick = function()
    {
        changeDisplay(".guideBuyProduct",'.tabDescription','.provisionService')
        changeColor(tabDetail, 1);
    }
    tabDetail[2].onclick = function()
    {
        changeDisplay(".provisionService",'.guideBuyProduct','.tabDescription')
        changeColor(tabDetail, 2);
    }
}

// Hàm changeDisplay - thực hiện chức năng chính của hàm changeDisplay
function changeDisplay(nameChange, name1, name2)
{
    document.querySelector(nameChange).style.display = "block";
    document.querySelector(name1).style.display = "none";
    document.querySelector(name2).style.display = "none";
}

// Hàm changeColor - thực hiện chức năng chính của hàm changeColor
function changeColor(tabDetail, index)
{
// Khởi tạo biến i
    for(var i = 0; i < tabDetail.length; i++)
    {
// Điều kiện kiểm tra
        if(index == i)
        {
            tabDetail[i].style.color = "var(--footer--color);";
            tabDetail[i].style.borderColor = "var(--footer--color);";
        }
// Điều kiện kiểm tra
        else if(index != i)
        {
            tabDetail[i].style.color = "#222222";
            tabDetail[i].style.borderColor = "transparent";
        }
    }
}

/* Product Involve */

// Khởi tạo biến containInvolve
var containInvolve = document.querySelector('.productInvolve__Items');
// Khởi tạo biến countProdductInvolve
var countProdductInvolve = document.querySelectorAll('.productInvolve--Item');
// Khởi tạo biến tabLeft
var tabLeft = document.querySelector('.productInvolveLeft');
// Khởi tạo biến tabRight
var tabRight = document.querySelector('.productInvolveRight');

// Điều kiện kiểm tra
if(tabLeft != null && tabRight != null)
{
    tabLeft.addEventListener("click", () => slideInvolve("InvolveLeft"));
    tabRight.addEventListener("click", () => slideInvolve("InvolveRight"));
}
// Khởi tạo biến InvolveIndex
var InvolveIndex = 0;

// Hàm slideInvolve - thực hiện chức năng chính của hàm slideInvolve
function slideInvolve(value)
{
// Điều kiện kiểm tra
    if(value === "InvolveRight")
    {
        InvolveIndex++;

// Điều kiện kiểm tra
        if(screen.width > 1024)
        {
// Điều kiện kiểm tra
            if(InvolveIndex > getLength(countProdductInvolve.length, 4))
            {
                InvolveIndex = 0;
            }
        }
// Điều kiện kiểm tra
        else
        {            
// Điều kiện kiểm tra
            if(screen.width > 723)
            {
// Điều kiện kiểm tra
                if(InvolveIndex > getLength(countProdductInvolve.length, 5))
                {
                    InvolveIndex = 0;
                }
            }
// Điều kiện kiểm tra
            else
            {
// Điều kiện kiểm tra
                if(InvolveIndex > getLength(countProdductInvolve.length, 2))
                {
                    InvolveIndex = 0;
                }
            }
        }
    }
// Điều kiện kiểm tra
    else
    {
// Điều kiện kiểm tra
        if(value === "InvolveLeft")
        {
            InvolveIndex--;

// Điều kiện kiểm tra
            if(screen.width > 1024)
            {
// Điều kiện kiểm tra
                if(InvolveIndex < 0)
                {
                    InvolveIndex = getLength(countProdductInvolve.length, 4);
                }
            }
// Điều kiện kiểm tra
            else
            {
// Điều kiện kiểm tra
                if(screen.width > 723)
                {
// Điều kiện kiểm tra
                    if(InvolveIndex < 0)
                    {
                        InvolveIndex = getLength(countProdductInvolve.length, 5);
                    }
                }
// Điều kiện kiểm tra
                else
                {
// Điều kiện kiểm tra
                    if(InvolveIndex < 0)
                    {
                        InvolveIndex = getLength(countProdductInvolve.length, 2);
                    }
                }
            }
        }
    }

    updateSlideInvolve();
}

// Hàm updateSlideInvolve - thực hiện chức năng chính của hàm updateSlideInvolve
function updateSlideInvolve(){
    containInvolve.style.transform = `translateX(-${InvolveIndex * 100}%)`;
}

/* tăng giảm số lượng */

// Điều kiện kiểm tra
if(document.querySelector('.reduce') != null && document.querySelector('.increase') != null){
    document.querySelector('.reduce').addEventListener("click",() => userMount("reduce"));
    document.querySelector('.increase').addEventListener("click",() => userMount("increase"));

// Khởi tạo biến mount
    var mount = document.querySelector('.mount');

// Khởi tạo biến mountChange
    var mountChange = 1;

// Hàm userMount - thực hiện chức năng chính của hàm userMount
    function userMount(value)
    {
// Điều kiện kiểm tra
        if(value === "reduce")
        {
// Điều kiện kiểm tra
            if(mountChange > 1)
            {
                mountChange--;
            }
        }
// Điều kiện kiểm tra
        else if(value === "increase")
        {
            mountChange++;
        }

        mount.value = mountChange;
    }
}

// Hàm getLength - thực hiện chức năng chính của hàm getLength
function getLength(lenghtName,amount)
{
// Điều kiện kiểm tra
    if(lenghtName % amount == 0)
    {
        return (lenghtName / amount) - 1;
    }
// Điều kiện kiểm tra
    else
    {
        return parseInt(lenghtName / amount);
    }
}







