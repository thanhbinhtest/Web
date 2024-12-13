<input type="checkbox" hidden id="cbCheckLabel">
<label for="cbCheckLabel" class="customer-edit__background"></label>

<div class="products-create__combo">
    <div class="customer-edit__title">
        <h1>Tạo Combo</h1>
        <i class="fa-solid fa-xmark customer-edit__close"></i>
    </div>
    <div class="products__insert--content">
        <input type="text" id="products__insert--combo-create" placeholder=" ">
        <label class="label--input" for="products__insert--combo-create">Combo</label>
    </div>
    <button class="products-create__combo--action">Tạo</button>
</div>

<style>
.product__insert-top {
    max-height: 500px; /* Đặt chiều cao tối đa cho phần tử */
    overflow-y: auto; /* Kích hoạt thanh trượt dọc khi cần thiết */
}
.customer{
    max-height: 500px; /* Đặt chiều cao tối đa cho phần tử */
    overflow-y: auto; /* Kích hoạt thanh trượt dọc khi cần thiết */
}
</style>

<div class="customer products">
    <div class="product__insert-top">
        <div class="products__insert--title">
            <h1>Thêm Sản Phẩm</h1>
            <p class="products__insert--back"><i class="fa-solid fa-arrow-right-to-bracket"></i>Quay lại danh sách sản phẩm</p>
        </div>
        <form method="POST" enctype="multipart/form-data" action="./Product/ChangedImage" class="products__insert submitFile">
            <div class="products__insert--images">
                <label for="file1">
                    <img src="" alt="" class="products__insert--image-1">
                    <input type="file" name="Image1" hidden id="file1" class="image-file1">
                    <i class="fa-solid fa-image edit-product__image"></i>
                </label>
                <label for="file2">
                    <img src="" alt="" class="products__insert--image-2">
                    <input type="file" name="Image2" hidden id="file2" class="image-file2">
                    <i class="fa-solid fa-image edit-product__image"></i>
                </label>
                <label for="file3">
                    <img src="" alt="" class="products__insert--image-3">
                    <input type="file" name="Image3" hidden id="file3" class="image-file3">
                    <i class="fa-solid fa-image edit-product__image"></i>
                </label>
            </div>
            <p class='Image-error'> </p>
            <div class="products__insert--grid">
                <div class="products__insert--content">
                    <select name="" id="products__insert--category">
                    </select>
                </div>
                <div class="products__insert--content">
                    <select name="" id="products__insert--brand">
                    </select>
                </div>
                <div class="products__insert--content">
                    <select name="" id="products__insert--size">
                    </select>
                </div>
                <div class="products__insert--content">
                    <select name="" id="products__insert--color">
                    </select>
                </div>
                <div class="products__insert--content">
                    <select name="" id="products__insert--produce">
                    </select>
                </div>
                <div class="products__insert--content products__insert--content-combo">
                    <select name="" id="products__insert--combo">
                    </select>
                    <div>
                        <input type="button" class="products__insert--combo" value="Tạo">
                    </div>
                </div>
                <div class="products__insert--content">
                    <input type="text" id="products__insert--name" placeholder=" ">
                    <label class="label--input" for="products__insert--name">Tên sản phẩm</label>
                </div>
                <div class="products__insert--content">
                    <input type="value" id="products__insert--description" placeholder=" ">
                    <label class="label--input" for="products__insert--description">Mô tả</label>
                </div>
                <div class="products__insert--content">
                    <input type="value" id="products__insert--fromPrice" placeholder=" ">
                    <label class="label--input" for="products__insert--fromPrice">Giá</label>
                </div>
                <div class="products__insert--content">
                    <input type="value" id="products__insert--effect" placeholder=" ">
                    <label class="label--input" for="products__insert--effect">Công dụng</label>
                </div>
                <div class="products__insert--content">
                    <input type="value" id="products__insert--usage" placeholder=" ">
                    <label class="label--input" for="products__insert--usage">Cách sử dụng</label>
                </div>
                <div class="products__insert--content">
                    <input type="value" id="products__insert--introduce" placeholder=" ">
                    <label class="label--input" for="products__insert--introduce">Giới thiệu</label>
                </div>
            </div>
            <p class='infor-error'> </p>
            <div class="products__insert--action">
                <input type="submit" class="products__insert--action-content" value="Thêm sản phẩm">
            </div>
        </form>
    </div>

    <div class="products__infor">
        <div class="customer__title">
            <h1>Danh sách sản phẩm</h1>
            <div class="customer__search">
                <input type="text" placeholder="Tìm kiếm sản phẩm..." class="customer__search--content products__search--content">
                <i class="fa-solid fa-magnifying-glass customer__search--action products__search--action"></i>
            </div>
            <div class="products__btn--insert">
                <button class="btn-insert product__inserts" value="Thêm sản phẩm"><i class="fa-solid fa-circle-up"></i>Thêm sản phẩm</button>
            </div>
        </div>
        <div class="Products-table">
            <table class="table">
                <thead>
                    <tr class="table-dark">
                        <th>ID</th>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Loại</th>
                        <th>Thương hiệu</th>
                        <th>Kích thước</th>
                        <th>Số lượng</th>
                        <th>Màu sắc</th>
                        <th>Ngày sản xuất</th>
                        <th>Giá</th>
                        <th>Công dụng</th>
                        <th>Cách sử dụng</th>
                        <th>Giới thiệu</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody class="products-table__contain">
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
</div>
<script src="../Public/js/admin/products.js"></script>
