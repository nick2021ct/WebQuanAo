<div style="width:600px; margin: 0 auto">
    <div style="text-align: center">
        <h2>Xin chào quý khách, {{ $data['name'] }}</h2>
        <p>Email này giúp bạn xác thực địa chỉ email của bạn</p>
        <p>Vui lòng nhấp vào liên kết bên dưới để tiếp tục:</p>
        <p><a href="{{ route('verifiEmail', ['email' => $data['email'], 'token' => $data['token']] ) }}">Xác thực Email</a></p>
    </div>
</div>