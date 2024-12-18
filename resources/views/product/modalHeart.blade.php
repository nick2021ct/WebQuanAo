<style>
    #row_heart .name-product {
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>

<div class="modal fade" id="heart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="font-weight: 600;text-transform: uppercase">Danh mục yêu thích của bạn</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="empty_heart_message" style="display: none; text-align: center; margin-top: 20px;">
                    Bạn đang không thích sản phẩm nào!
                  </div>

                <table class="table table-borderless" id="row_heart">
                    {{-- <thead>
                        <tr>
                            <th scope="col" class="text-center">Hình ảnh</th>
                            <th scope="col" class="text-center">Tên sản phẩm</th>
                            <th scope="col" class="text-center">Giá</th>
                            <th scope="col" class="text-center">Hoạt động</th>
                        </tr>
                    </thead> --}}
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Tiếp tục mua hàng</button>

            </div>
        </div>
    </div>
</div>
