$(document).ready(function () {
  showListEvent();

// Khởi tạo biến eventInsert
  const eventInsert = document.querySelector(".event__inserts");
// Khởi tạo biến editCustomerClose
  const editCustomerClose = document.querySelector(".customer-edit__close");

  eventInsert.addEventListener("click", function () {
    document.getElementById("cbCheckLabel").checked = true;
    $('.title-edit').html("Insert Event");
    $('.products-create__combo--action').val(`Insert`);
    $('.products-create__combo').addClass('insert-event');
    $('.products-create__combo').removeClass('update-event');

    resetValue(null,null,null,null,null);

    $(".insert-event").submit(function(){
      $.ajax({
        method: $(this).attr("method"),
        url: "./Event/ChangedImage",
        enctype: $(this).attr("enctype"),
        data: new FormData(this),
        cache: false, // Ngăn trình duyệt không cache request này.
        contentType: false, // Không cho jQuery gửi Content Type, nếu không sẽ làm mất chuỗi
        processData: false, // không cho jquery tự động xử lý data thành query string
      }).done(function (data) {
// Điều kiện kiểm tra
        if (data == 2) {
          $(".Image-error").html("Kích thước file quá lớn. Vui lòng chọn file khác");
        } else {
          $(".Image-error").html("");
        }
      });  
    })
  });

  editCustomerClose.addEventListener("click", function () {
    document.getElementById("cbCheckLabel").checked = false;
  });

  //cập nhật ảnh khi thay đổi
  // $(".image-file3").change(function () {
// Khởi tạo biến var
  //   var file = $(this)[0].files[0].name;
  //   document.querySelector(".products__insert--image-3").src = "../Public/image/SuKien/" + file;
  // });

  //tìm kiếm
  $('.events_search').keyup(function(){
    showListEvent();
  })

// Hàm showListEvent - thực hiện chức năng chính của hàm showListEvent
  function showListEvent() {
// Khởi tạo biến keyword
    let keyword = $('.events_search').val();

    $.post("./Event/apiListEvent", {keyword:keyword} ,function (data) {
// Khởi tạo biến obj
      let obj = JSON.parse(data);
// Khởi tạo biến result
      let result = "";

      obj.forEach((element) => {
        result +=
                  "<tr>" +
                      "<td scope='row'>" +element.ID +"</td>" +
                      "<td> <img class='events-image' src='" +"../" + element.image +"'></img></td>" +
                      "<td>" + element.tenSK +"</td>" +
                      "<td class='events-description'>" +
                          "<p class='text-conllapse'>" +element.noiDung +"</p></td>" +
                      "<td style='color: #c388f6'>"+element.codes+"</td>"+
                      "<td style='color: #ad1414;'>-"+element.giagiam+ '%' +"</td>"+
                      "<td>" +element.ngayBD +"</td>" +
                      "<td>" +element.ngayKT +"</td>" +
                      "<td class='card-customer__item--action'>" +
                          "<i class='fa-solid fa-trash event--delete' data-idevent='" +element.ID +"'></i>" +
                      "</td>" +
                  "</tr>";
      });

      $(".list-events").html(result);

      $('.event--delete').click(function(){
// Khởi tạo biến ID
        let ID = $(this).attr("data-idevent");

        $.post("./Event/removeEvent", {ID:ID}, function(){
          showListEvent();
        })
      })
    });
  }

// Hàm resetValue - thực hiện chức năng chính của hàm resetValue
  function resetValue(name,content,dateStart,dateEnd,image)
  {
    $("#products__insert--name").val(name);
    $("#products__insert--content").val(content);
    $("#products__insert--dateStart").val(dateStart);
    $("#products__insert--dateEnd").val(dateEnd);
    document.querySelector(".products__insert--image-3").setAttribute("src","../" + image);
  }
});
