$(document).ready(function () {
  $(".check--Bill--icon").click(function () {
// Điều kiện kiểm tra
    if ($(this).hasClass("fa-check")) {
      $(this).removeClass("fa-check").addClass("fa-xmark");
    } else if ($(this).hasClass("fa-xmark")) {
      $(this).removeClass("fa-xmark").addClass("fa-check");
    }
  });

// Khởi tạo biến amountElement
  let amountElement = 10;
  /* -------------------------------------------- Customer --------------------------------------------*/
  lengthListCustomer();
  loadListCustomer();

  //hiển thị danh sách customer
// Hàm loadListCustomer - thực hiện chức năng chính của hàm loadListCustomer
  function loadListCustomer() {
// Khởi tạo biến keyword
    let keyword = getValueInput("customer__search--content");
// Khởi tạo biến page
    let page = getValueInput("customer__pagination--item-page");

    $.post("./Customer/apiListCustomer", { keyword: keyword, page: page, amountElement: amountElement }, function (data) {
// Khởi tạo biến obj
      let obj = JSON.parse(data);
// Khởi tạo biến result
      let result = "";
// Khởi tạo biến index
      let index = 0;
      obj.forEach((element) => {
        result +=
          "<tr class='customer__item'>" +
          "<td>" +
          "<p class='customer__item--ID' data-idcustomer='" +
          element.ID +
          "'>" +
          element.ID +
          "</p>" +
          "</td>" +
          "<td><img class='customer__item--image' src='" +
          "../" +
          element.image +
          "' alt=''></td>" +
          "<td>" +
          "<p>" +
          element.hoTen +
          "</p>" +
          "</td>" +
          "<td>" +
          "<p>" +
          element.email +
          "</p>" +
          "</td>" +
          "<td>" +
          "<p>" +
          element.ngaysinh +
          "</p>" +
          "</td>" +
          "<td>" +
          "<p>" +
          element.sdt +
          "</p>" +
          "</td>" +
          "<td>" +
          "<p>" +
          element.diachi +
          "</p>" +
          "</td>" +
          "<td>" +
          "<p class='customer__item--ranks'>" +
          changedRank(element.ranks) +
          "</p>" +
          "</td>" +
          "<td>" +
          "<p class='customer__item--roles'>" +
          element.role +
          "</p>" +
          "</td>" +
          "<td>" +
          "<div class='card-customer__item--action' data-idedit='" +
          element.ID +
          "'>" +
          "<div class='customer__pagination--check-delete'>" +
          "<p class='customer__pagination--check--icon customer__pagination--check--cancel'><i class='fa-solid fa-arrow-rotate-left'></i>Hủy" +
          "</p>" +
          "<p class='customer__pagination--check--icon customer__pagination--check-tick' data-idremove='" +
          element.ID +
          "'><i class='fa-solid fa-circle-check'></i> Xóa</p>" +
          "</div>" +
          "<i class='fa-solid fa-pen-to-square card-customer__edit' data-idcustomer='" +
          element.ID +
          "'></i>" +
          "<i class='fa-solid fa-trash card-customer__delete' data-index='" +
          index +
          "'></i>" +
          "</div>" +
          "</td>" +
          "</tr>";

        index++;
      });

      $(".customer__items").html(result);

      //load form edit
      loadFormEditCustomer();

      //load form check delete
      $(".card-customer__delete").click(function () {
// Khởi tạo biến indexDelete
        let indexDelete = $(this).attr("data-index");
// Khởi tạo biến formCheckDelete
        const formCheckDelete = document.querySelectorAll(".customer__pagination--check-delete");

        formCheckDelete.forEach((e) => {
          e.style.display = "none";
        });

        formCheckDelete[indexDelete].style.display = "flex";

        $(".customer__pagination--check--cancel").click(function () {
          formCheckDelete[indexDelete].style.display = "none";
        });

        $(".customer__pagination--check-tick").click(function () {
// Khởi tạo biến ID
          let ID = $(this).attr("data-idremove");

          $.post("./Customer/removeCustomer", { ID: ID }, function (data) {
            loadListCustomer();
          });
        });
      });
    });
  }

  //phân trang cho danh sách customer
// Hàm lengthListCustomer - thực hiện chức năng chính của hàm lengthListCustomer
  function lengthListCustomer() {
// Khởi tạo biến keyword
    let keyword = getValueInput("customer__search--content");
    $.post("./Customer/lengthListCustomer", { keyword: keyword }, function (data) {
      length = data / amountElement;
// Khởi tạo biến page
      let page = getValueInput("customer__pagination--item-page");

      $(".previousPage").click(function () {
// Điều kiện kiểm tra
        if (page > 0) {
          page = Number(page - 1);
          $(".customer__pagination--item-page").val(page);
          loadListCustomer();
          $(".customer__pagionation--fromPage").html(page);
        }
      });

      $(".nextPage").click(function () {
// Điều kiện kiểm tra
        if (page < length - 1) {
          page = Number(page + 1);
          $(".customer__pagination--item-page").val(page);
          loadListCustomer();
          $(".customer__pagionation--fromPage").html(page);
        }
      });

      $(".customer__pagination--totalPage").html(parseInt(length > 0 ? length : 0));
      $(".customer__pagination--entries").html(parseInt(length > 0 ? length: 0));
      $(".customer__pagionation--fromPage").html(page);
    });
  }

  //search customer
  $(".customer__search--content").keyup(function () {
    $(".customer__pagination--item-page").val(0);
    loadListCustomer();
    lengthListCustomer();
  });

// Hàm loadFormEditCustomer - thực hiện chức năng chính của hàm loadFormEditCustomer
  function loadFormEditCustomer() {
    //hiển thị form edit
// Khởi tạo biến editCustomerClose
    const editCustomerClose = document.querySelector(".customer-edit__close");
// Khởi tạo biến editCustomer
    const editCustomer = document.querySelectorAll(".card-customer__edit");

    editCustomer.forEach((element) => {
      element.addEventListener("click", function () {
        document.getElementById("cbCheckLabel").checked = true;

// Khởi tạo biến IDCustomer
        let IDCustomer = $(this).attr("data-idcustomer");

        $.post("./Customer/apiListCustomer", { keyword: IDCustomer, page: 0, amountElement: amountElement }, function (data) {
// Khởi tạo biến obj
          let obj = JSON.parse(data);
// Khởi tạo biến formCustomer
          let formCustomer = "";

          obj.forEach((element) => {
            formCustomer +=
              "<form class='customer-edit__left submitFile' method='POST' action='./Customer/changedAvatar&ID=" +
              element.ID +
              "' enctype='multipart/form-data'>" +
              "<div class='customer-edit__left-image'>" +
              "<img class='customer-edit__image' src='" +
              "../" +
              element.image +
              "' alt=''>" +
              "<input type='file' hidden name='Avatar' id='customer-edit--file' value='" +
              element.image +
              "'>" +
              "<label for='customer-edit--file'><i class='fa-solid fa-plus customer-edit__action--image'></i></label>" +
              "</div>" +
              "</form>" +
              "<p class='Image-error'></p>" +
              "<div class='customer-edit__right'>" +
              "<div class='products__insert--content'>" +
              "<input type='text' class='customer-edit--name' id='products__insert--name' placeholder=' ' value='" +
              element.hoTen +
              "'>" +
              "<label class='label--input update-customer' for='products__insert--name'>Name</label>" +
              "</div>" +
              "<div class='products__insert--content'>" +
              "<input type='email' disabled class='customer-edit--email' id='products__insert--name' placeholder=' ' value='" +
              element.email +
              "'>" +
              "<label class='label--input  update-email' for='products__insert--name'>Email</label>" +
              "</div>" +
              "<div class='products__insert--content'>" +
              "<input type='Date' class='customer-edit--birthDay' id='products__insert--name' placeholder=' ' value='" +
              element.ngaysinh +
              "'>" +
              "<label class='label--input update-birthDay' for='products__insert--name'>Birth Day</label>" +
              "</div>" +
              "<div class='products__insert--content'>" +
              "<input type='number' class='customer-edit--phone' id='products__insert--name' placeholder=' ' value='" +
              element.sdt +
              "'>" +
              "<label class='label--input update-phone' for='products__insert--name'>Phone</label>" +
              "</div>" +
              "<div class='products__insert--content'>" +
              "<input type='text' class='customer-edit--address' id='products__insert--name' placeholder=' ' value='" +
              element.diachi +
              "'>" +
              "<label class='label--input update-address' for='products__insert--name'>Address</label>" +
              "</div>" +
              "<div class='products__insert--content'>" +
              "<input type='text' class='customer-edit--rank' id='products__insert--name' placeholder=' ' value='" +
              element.ranks +
              "'>" +
              "<label class='label--input update-rank' for='products__insert--name'>Rank</label>" +
              "</div>" +
              "<div class='products__insert--content'>" +
              // "<input disabled type='text' class='customer-edit--role' id='products__insert--name' placeholder=' ' value='" +
              // element.role +
              // "'>" +
              // "<label class='label--input update-role' for='products__insert--name'>Role</label>" +
              "<select class='form-select customer-edit--role' name='select-roles' aria-label='Default select example'>";

// Điều kiện kiểm tra
                if(element.role == "Admin")
                {
                  formCustomer += "<option option value='Admin' selected>Admin</option>"+
                                   "<option option value='user'>user</option>";
                }
// Điều kiện kiểm tra
                else
                {
                  formCustomer += "<option option value='user' selected>user</option>"+
                                  "<option option value='Admin'>Admin</option>";
                }

                formCustomer += "</select>"+
                "</div>" +
                "<div class='customer-edit__action'>" +
                "<button class='customer-edit--action-update' data-idcustomer='" +
                element.ID +
                "'><i class='fa-solid fa-pen-to-square'></i>Update</button>" +
                "</div>" +
                "</div>";
          });
          $(".customer-edit__content").html(formCustomer);

          $(".submitFile").submit(function (event) {
            $.ajax({
              method: $(this).attr("method"),
              url: $(this).attr("action"),
              enctype: $(this).attr("enctype"),
              data: new FormData(this),
              cache: false, // Ngăn trình duyệt không cache request này.
              contentType: false, // Không cho jQuery gửi Content Type, nếu không sẽ làm mất chuỗi
              processData: false, // không cho jquery tự động xử lý data thành query string
            }).done(function (data) {
// Điều kiện kiểm tra
              if (data == 0) {
                $(".Image-error").html("Chỉ hỗ trợ File {jpg,png,jpeg,gif}");
              } else if (data == 2) {
                $(".Image-error").html("Kích thước file quá lớn. Vui lòng chọn file khác");
              } else {
                $(".Image-error").html("");
                document.querySelector(".customer-edit__image").src = "../" + data;
                loadListCustomer();
              }
            });

            event.preventDefault();
          });

          $("#customer-edit--file").change(function () {
// Khởi tạo biến file
            var file = $(this)[0].files[0].name;
            document.querySelector(".customer-edit__image").src = "./Public/image/Avatar/" + file;
            
            $('.submitFile').submit();  
          });  
        

          $(".customer-edit--action-update").click(function () {
// Khởi tạo biến ID
            let ID = $(this).attr("data-idcustomer");
// Khởi tạo biến name
            let name = getValueInput("customer-edit--name");
// Khởi tạo biến birthDay
            let birthDay = getValueInput("customer-edit--birthDay");
// Khởi tạo biến phone
            let phone = getValueInput("customer-edit--phone");
// Khởi tạo biến address
            let address = getValueInput("customer-edit--address");
// Khởi tạo biến rank
            let rank = getValueInput("customer-edit--rank");
// Khởi tạo biến role
            let role = getValueInput("customer-edit--role");
            $.post("./Customer/updateCustomer", { ID: ID, name: name, birthDay: birthDay, phone: phone, address: address, rank: rank, role: role }, function () {
              loadListCustomer();
            });
          });
        });
      });
    });

    editCustomerClose.addEventListener("click", function () {
      document.getElementById("cbCheckLabel").checked = false;
    });
  }


  //change ranks 
// Hàm changedRank - thực hiện chức năng chính của hàm changedRank
  function changedRank(rank)
  {
// Khởi tạo biến result
    let result = "";

    switch (rank)
    {
      case '1': result = "Đồng";
        break;
      case '2': result = "Bạc";
        break;
      case '3': result = "Vàng";
        break;
      case '4': result = "Kim cương";
        break;
      default: result = "Thành viên";
        break;
    }
    
    return result;
  }

  //lấy giá trị thẻ input
// Hàm getValueInput - thực hiện chức năng chính của hàm getValueInput
  function getValueInput(nameClass) {
// Khởi tạo biến value
    let value = $("." + nameClass).val();

    return value;
  }
});
