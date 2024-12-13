// Điều kiện kiểm tra
if(document.querySelector('.MainProduct-Menu__Mobile'))
{
    document.querySelector('.MainProduct-Menu__Mobile').onclick = function(){
        document.querySelector('.MainProduct__Menu').style.transform = "translateX(0%)";
        document.querySelector('.MainProduct-Menu__Layout').style.display = "block";
    }
}

// Điều kiện kiểm tra
if(document.querySelector('.MainProduct-Menu__Mobile--Close'))
{
    document.querySelector('.MainProduct-Menu__Mobile--Close').onclick = function(){
        document.querySelector('.MainProduct__Menu').style.transform = "translateX(100%)";
        document.querySelector('.MainProduct-Menu__Layout').style.display = "none";
    }
}

// Điều kiện kiểm tra
if(document.querySelector('.MainProduct-Menu__Layout'))
{
    document.querySelector('.MainProduct-Menu__Layout').onclick = function(){
        document.querySelector('.MainProduct__Menu').style.transform = "translateX(100%)";
        document.querySelector('.MainProduct-Menu__Layout').style.display = "none";
        console.log("zxcxz");
    }
}


document.querySelector('.more-information').onclick = function(){
    showHiddenCategory('less-information','more-information');
    
// Khởi tạo biến arrShow
    var arrShow = document.querySelector('.information--mobile');

    arrShow.style.height = 'unset';
    arrShow.style.scale = '1';
}

document.querySelector('.less-information').onclick = function(){
    showHiddenCategory('more-information','less-information');
    
// Khởi tạo biến arrShow
    var arrShow = document.querySelector('.information--mobile');

    arrShow.style.height = '0px';
    arrShow.style.scale = '0';
}



document.querySelector('.more-Categories').onclick = function(){
    showHiddenCategory('less-Categories','more-Categories');
    
// Khởi tạo biến arrShow
    var arrShow = document.querySelectorAll('.Categories__Contain');

    CategoriesShow(arrShow,"block");
}

document.querySelector('.less-Categories').onclick = function(){
    showHiddenCategory('more-Categories','less-Categories');

// Khởi tạo biến arrShow
    var arrShow = document.querySelectorAll('.Categories__Contain');

    CategoriesShow(arrShow,"none");

// Khởi tạo biến arrLess
    var arrLess = document.querySelectorAll('.Categories--Hidden');

    CategoriesShow(arrLess,"none");

    showHiddenCategory('more-Face','less-Face');
    showHiddenCategory('more-skinLeather','less-skinLeather');
    showHiddenCategory('more-cleanLeather','less-cleanLeather');
    showHiddenCategory('more-skinCare','less-skinCare');
}

document.querySelector('.more-Face').onclick = function(){
    showHiddenCategory('less-Face','more-Face');

// Khởi tạo biến arrShow
    var arrShow = document.querySelectorAll('.Categories--Show__Face');

    CategoriesShow(arrShow,"block");
}

document.querySelector('.less-Face').onclick = function(){
    showHiddenCategory('more-Face','less-Face');

// Khởi tạo biến arrShow
    var arrShow = document.querySelectorAll('.Categories--Show__Face');

    CategoriesShow(arrShow,"none");
}

document.querySelector('.more-cleanLeather').onclick = function(){
    showHiddenCategory('less-cleanLeather','more-cleanLeather');

// Khởi tạo biến arrShow
    var arrShow = document.querySelectorAll('.Categories--Show__cleanLeather');

    CategoriesShow(arrShow,"block");
}

document.querySelector('.less-cleanLeather').onclick = function(){
    showHiddenCategory('more-cleanLeather','less-cleanLeather');

// Khởi tạo biến arrShow
    var arrShow = document.querySelectorAll('.Categories--Show__cleanLeather');

    CategoriesShow(arrShow,"none");
}

document.querySelector('.more-skinLeather').onclick = function(){
    showHiddenCategory('less-skinLeather','more-skinLeather');

// Khởi tạo biến arrShow
    var arrShow = document.querySelectorAll('.Categories--Show__skinLeather');

    CategoriesShow(arrShow,"block");
}

document.querySelector('.less-skinLeather').onclick = function(){
    showHiddenCategory('more-skinLeather','less-skinLeather');

// Khởi tạo biến arrShow
    var arrShow = document.querySelectorAll('.Categories--Show__skinLeather');

    CategoriesShow(arrShow,"none");
}

document.querySelector('.more-skinCare').onclick = function(){
    showHiddenCategory('less-skinCare','more-skinCare');

// Khởi tạo biến arrShow
    var arrShow = document.querySelectorAll('.Categories--Show__skinCare');

    CategoriesShow(arrShow,"block");
}

document.querySelector('.less-skinCare').onclick = function(){

    showHiddenCategory('more-skinCare','less-skinCare');

// Khởi tạo biến arrShow
    var arrShow = document.querySelectorAll('.Categories--Show__skinCare');

    CategoriesShow(arrShow,"none");
}

document.querySelector('.close-MenuMobile').onclick = function(){
    document.querySelector('.Layout-check__Mobile').checked = false;
}

// Hàm CategoriesShow - thực hiện chức năng chính của hàm CategoriesShow
function CategoriesShow(nameClass,status)
{
// Khởi tạo biến i=0;
    for(var i=0; i<nameClass.length; i++)
    {
// Điều kiện kiểm tra
        if(status == "block")
        {
            nameClass[i].style.display = "block";
        }
// Điều kiện kiểm tra
        else
        {
            nameClass[i].style.display = "none";
        }
    }
}

// Hàm showHiddenCategory - thực hiện chức năng chính của hàm showHiddenCategory
function showHiddenCategory(nameShow,nameHidden)
{
    document.querySelector('.'+nameShow).style.display = "block";
    document.querySelector('.'+nameHidden).style.display = "none";
}
