<div class="events">
    <h1 class="title title--history">Lịch sử hóa đơn</h1>

    <div class="events-top">
        <select class="categories__product form-select">

        </select>

        <div class="events-top__action">
            <div class="customer__search">
                <input type="text" class="customer__search--content events_search" placeholder="Nhập ID hóa đơn">
                <i class="fa-solid fa-magnifying-glass events-action__search"></i>
            </div>
        </div>

        <button class="export--revenue">Xuất</button>
    </div>

    <div class="events-bottom">
        <div class="events-bottom__content">
            <table class="table table__history">
                <thead>
                    <tr class="table-dark table-active">
                        <th scope="col">ID</th>
                        <th scope="col">Khách hàng</th>
                        <th scope="col">Sản phẩm</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Tổng cộng</th>
                        <th scope="col">Ngày bán</th>
                        <th scope="col">Hành động</th>
                    </tr>
                </thead>
                <tbody class="list-bills">

                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js">
</script>
<script src="../Public/js/admin/histories.js"></script>
