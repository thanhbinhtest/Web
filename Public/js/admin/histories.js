$(document).ready(function () {
// Khởi tạo biến IDCategory
  let IDCategory = 0;
  apiListBill();

  //tìm kiếm
  $(".events_search").keyup(function () {
    apiListBill(IDCategory);
  });

// Hàm apiListBill - thực hiện chức năng chính của hàm apiListBill
  function apiListBill(IDCategory) {
// Khởi tạo biến keyword
    let keyword = $(".events_search").val();
    
    $.post("./Histories/apiListBill", { keyword: keyword, IDCategory:IDCategory }, function (data) {
// Khởi tạo biến obj
      let obj = JSON.parse(data);
// Khởi tạo biến result
      let result = "";
      obj.forEach((element) => {
        result += "<tr>" + "<td>" + element.ID + "</td>" + "<td>" + element.hoTen + "</td>" + "<td>" + element.tenSP + "</td>" + "<td class='events-description'>" + element.soLuong + "</td>" + "<td>" + changedPrice(element.total - 0) + "</td>" + "<td>" + element.ngayBan + "</td>" + "<td class='card-customer__item--action'>" + "<i class='fa-solid fa-trash event--delete' data-idbills='" + element.ID + "'></i>" + "</td>" + "</tr>";
      });

      $(".list-bills").html(result);

      $(".event--delete").click(function () {
// Khởi tạo biến ID
        let ID = $(this).attr("data-idbills");

        $.post("./Histories/removeBill", { ID: ID }, function () {
          apiListBill();
        });
      });
    });
  }

  //load categories product
  categories();
// Hàm categories - thực hiện chức năng chính của hàm categories
  function categories(){
    $.post("../SanPham/getCategories", function (data) {

// Khởi tạo biến obj
      var obj = JSON.parse(data);

// Khởi tạo biến html
      var html = `<option value='0'>Tất cả</option>`;
      
      obj.forEach(p => {
        html += `<option value=`+p.ID+`>`+p.tenTL+`</option>`;
      })

      $('.categories__product').html(html);
    })
  }

  $('.categories__product').change(function(){
    IDCategory = $(this).val();
    console.log(IDCategory);
    apiListBill(IDCategory);
  })

  //export data renevue to excel
  $('.export--revenue').click(function() {
    $.post("./Histories/apiListBill", { keyword: null }, function (data) {
// Khởi tạo biến table
      let table = document.getElementsByTagName("table");
      TableToExcel.convert(table[0], {
          name: `ReportRenevue.xlsx`,
          sheet: {
              name: 'Renevue'
          }
      });
    });
  })

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
});
