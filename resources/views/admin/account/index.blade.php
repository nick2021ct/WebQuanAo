@extends('layouts.appAdmin')
@section('title')
    Danh sách tài khoản
@endsection
@section('content')
    <div class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4 mt-5">Tài khoản</h5>
                        @can('addAccount')
                            <a href="{{ route('account.create') }}"><button type="submit" class="btn btn-success m-1">Tạo tài
                                    khoản</button></a>
                        @endcan
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0 align-middle" id="example">
                                <thead class="text-dark fs-4">
                                    <tr>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0"></h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Username</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Tên đầy đủ</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Email</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Số điện thoại</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Nghiệp vụ</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Hoạt động</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $stt = 1;
                                    @endphp
                                    @foreach ($accounts as $account)
                                        <tr>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">{{ $stt }}</h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $account->username }}</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $account->fullname }}</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $account->email }}</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">{{ $account->phone }}</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                @if ($account->role == 0)
                                                    <p class="mb-0 fw-normal">Khách hàng</p>
                                                @elseif($account->role == 1)
                                                    <p class="mb-0 fw-normal">Quản trị</p>
                                                @elseif($account->role == 2)
                                                    <p class="mb-0 fw-normal">Nhân viên</p>
                                                @endif
                                            </td>   
                                            <td class="border-bottom-0" style="display: flex;">
                                                @if (is_null($account->deleted_at))
                                                    @can('updateAccount')
                                                        <a href="{{ route('account.edit', $account->id) }}"><button
                                                                type="submit" class="btn btn-info m-1">Chỉnh sửa</button></a>
                                                    @endcan
                                                    @can('deleteAccount')
                                                        <form action="{{ route('account.destroy', $account->id) }}"
                                                            method="post">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger m-1"
                                                                onclick="return deleteConfirmation()">Block</button>
                                                        </form>
                                                    @endcan
                                                @else
                                                    <a href="{{ route('admin.account.unblock', $account->id) }}"><button
                                                            type="submit" class="btn btn-primary m-1">Unblock</button></a>
                                                @endif
                                            </td>
                                        </tr>
                                        @php
                                            $stt++;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
