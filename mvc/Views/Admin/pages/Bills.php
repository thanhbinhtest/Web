<div class="bill__container">
    <div class="customer bills">
        <div class="customer__title">
            <h1>Danh sách hóa đơn</h1>
            <div class="customer__search">
                <input type="text" class="customer__search--content" placeholder="Tìm kiếm theo (ID hoặc tháng)">
                <i class="fa-solid fa-magnifying-glass customer__search--action"></i>
            </div>
        </div>

        <div class="customer__table">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>IDKH</th>
                        <th>Ngày đặt</th>
                        <th>Phí vận chuyển</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody class="table-bill">

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

    <div class="detail-bills">
        <div class="back-bills">
            <i class="fa-solid fa-right-to-bracket back-bills__action"></i>
            Quay lại danh sách hóa đơn
        </div>

        <div class="customer__table bills-detail">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Tên khách hàng</th>
                        <th>Địa chỉ</th>
                        <th>Điện thoại</th>
                        <th>Email</th>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Kích thước</th>
                        <th>Giá</th>
                        <th>Thanh toán</th>
                        <th>Ghi chú</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody class="detail-bill__table">

                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="../Public/js/admin/bills.js"></script>
