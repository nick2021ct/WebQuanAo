<div class="col-md-3">
    <div class="bg-dark text-light p-3" style="height: 100%;">
        <h4 class="text-center mb-4"><i class="bi bi-person-circle me-2"></i>Menu</h4>
        <ul class="list-unstyled">
            <li class="mb-3">
                <a href="{{ route('information') }}" class="d-block py-2 px-3 text-light rounded">
                    <i class="bi bi-person me-2"></i>Thông Tin Cá Nhân
                </a>
            </li>
            <li class="mb-3">
                <a href="{{ route('address') }}" class="d-block py-2 px-3 text-light rounded">
                    <i class="bi bi-geo-alt me-2"></i>Địa Chỉ
                </a>
            </li>
            <li class="mb-3">
                <a href="{{ route('listOrder') }}" class="d-block py-2 px-3 text-light rounded">
                    <i class="bi bi-bag me-2"></i>Đơn Hàng
                </a>
            </li>
            <li class="mb-3">
                <a href="{{ route('password') }}" class="d-block py-2 px-3 text-light rounded">
                    <i class="bi bi-key me-2"></i>Đổi Mật Khẩu
                </a>
            </li>
        </ul>
    </div>
</div>