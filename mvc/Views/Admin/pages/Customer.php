<input type="checkbox" hidden id="cbCheckLabel">
<label for="cbCheckLabel" class="customer-edit__background"></label>

<div class="customer-edit">
    <div class="customer-edit__Container">
        <div class="customer-edit__title">
            <h1>Chỉnh sửa hồ sơ</h1>
            <i class="fa-solid fa-xmark customer-edit__close"></i>
        </div>

        <div class="customer-edit__content">

        </div>
    </div>
</div>
<style>
.customer--container{
    max-height: 500px; /* Đặt chiều cao tối đa cho phần tử */
    overflow-y: auto;
}
</style>
<div class="customer customer--container">
    <div class="customer__title">
        <h1>Danh sách khách hàng</h1>
        <div class="customer__search">
            <input type="text" class="customer__search--content" placeholder="Tìm kiếm theo (ID hoặc Tên)">
            <i class="fa-solid fa-magnifying-glass customer__search--action"></i>
        </div>
    </div>
    <div class="customer__table">
        <table class="table">
            <thead>
                <tr class="table-dark customer__table--thead">
                    <th>ID</th>
                    <th>Ảnh đại diện</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Ngày sinh</th>
                    <th>Điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Hạng</th>
                    <th>Vai trò</th>
                    <th>Hành động</th>
                </tr>
            </thead>

            <tbody class="customer__items">

            </tbody>
        </table>
    </div>

    <div class="customer__pagination">
        <p>Hiển thị từ <span class="customer__pagionation--fromPage"></span> đến
            <span class="customer__pagination--toPage"></span> trên tổng số
            <span class="customer__pagination--entries"></span> mục
        </p>

        <div class="customer__pagination-contain">
            <i class="fa-solid fa-arrow-left-long previousPage"></i>
            <div class="customer__pagination--item">
                <input class="customer__pagination--item-page" min=0 value="0" type="text">
            </div>
            <i class="fa-solid fa-arrow-right-long nextPage"></i>
        </div>
    </div>
</div>

<script src="../Public/js/admin/customer.js"></script>
