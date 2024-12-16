<style>
    #row_compare .name-product {
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>

<div class="modal fade" id="compare" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="font-weight: 600;text-transform: uppercase">So sánh
                    sản phẩm(Chỉ cho phép sánh tối đa 4 sản phẩm)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="empty_compare_message" style="display: none; text-align: center; margin-top: 20px;">
                  Không có sản phẩm so sánh nào!
                </div>
                <table class="table table-condensed" id="row_compare">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">Tên sản phẩm</th>
                            <th scope="col" class="text-center">Giá</th>
                            <th scope="col" class="text-center">Hình ảnh</th>
                            <th scope="col" class="text-center">Hoạt động</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tiếp tục so sánh</button>

            </div>
        </div>
    </div>
</div>
