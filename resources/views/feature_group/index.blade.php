@extends('layouts.master')

@section('title', 'Phân quyền nhóm chức năng')

@section('style')
    <link href="{{ asset('assets/global/plugins/icheck/skins/all.css') }}" rel="stylesheet" type="text/css" />
    <style>
        /* CSS chỉnh cho giống ảnh */
        .group-list-container {
            border-right: 1px solid #e7ecf1;
            padding-right: 0;
            min-height: 500px;
        }

        .group-item {
            padding: 12px 15px;
            border-bottom: 1px solid #f4f4f4;
            display: block;
            color: #555;
            text-decoration: none !important;
            position: relative;
        }

        .group-item:hover {
            background-color: #f9f9f9;
            color: #333;
        }

        /* Nhóm đang được chọn */
        .group-item.active {
            background-color: #fff;
            color: #333;
            font-weight: 600;
        }

        /* Dấu tích giả lập giống ảnh bên trái */
        .group-item .icon-state {
            margin-right: 8px;
            color: #3598dc;
            /* Màu xanh */
        }

        .group-item.active::after {
            /* Mũi tên chỉ sang phải */
            content: "";
            position: absolute;
            right: 0;
            top: 50%;
            margin-top: -8px;
            border-top: 8px solid transparent;
            border-bottom: 8px solid transparent;
            border-right: 8px solid #3598dc;
        }

        /* Phần tiêu đề đỏ bên phải */
        .module-title {
            color: #e7505a;
            font-weight: bold;
            font-size: 14px;
            margin-top: 15px;
            margin-bottom: 10px;
            border-bottom: 1px dashed #ddd;
            padding-bottom: 5px;
        }

        .module-icon {
            margin-right: 5px;
        }

        .permission-item {
            margin-bottom: 5px;
            font-size: 13px;
        }
    </style>
@endsection

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li><a href="{{ route('dashboard') }}">Bảng Điều Khiển</a> <i class="fa fa-circle"></i></li>
                    <li><span>Phân quyền nhóm chức năng</span></li>
                </ul>
            </div>

            <h1 class="page-title"> Phân quyền nhóm chức năng </h1>

            @if (session('success'))
                <div class="alert alert-success">
                    <button class="close" data-close="alert"></button> {{ session('success') }}
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-body" style="padding: 0;">
                            <div class="row">

                                <div class="col-md-4 group-list-container">
                                    <div style="padding: 15px; background: #f9f9f9; border-bottom: 1px solid #eee;">
                                        <span class="caption-subject font-blue-sharp bold uppercase">Danh sách nhóm chức
                                            năng</span>
                                    </div>

                                    <div class="mt-element-list">
                                        <div class="mt-list-container list-simple">
                                            @foreach ($groups as $group)
                                                <a href="{{ route('feature-group.index', ['group_id' => $group->id]) }}"
                                                    class="group-item {{ isset($selectedGroup) && $selectedGroup->id == $group->id ? 'active' : '' }}">

                                                    {{-- Icon người giống ảnh --}}
                                                    <i class="fa fa-user icon-state"></i>

                                                    {{-- Checkbox giả để trang trí giống ảnh --}}
                                                    <i class="fa fa-square-o" style="color:#aaa; margin-right:5px;"></i>

                                                    {{ $group->name }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>

                                    {{-- Nút Cập nhật/Bỏ quả bên trái (giống ảnh) --}}
                                    <div
                                        style="padding: 15px; text-align: center; border-top: 1px solid #eee; margin-top: 20px;">
                                        <button type="submit" form="permission-form" class="btn btn-primary">Cập
                                            nhật</button>
                                        <button type="button" class="btn btn-default">Bỏ quả</button>
                                    </div>
                                </div>

                                <div class="col-md-8" style="padding: 15px 25px;">
                                    <div
                                        style="margin-bottom: 20px; border-bottom: 1px solid #36c6d3; padding-bottom: 10px;">
                                        <span class="caption-subject font-grey-gallery bold uppercase">Danh sách chức
                                            năng</span>
                                        @if ($selectedGroup)
                                            <span class="pull-right text-muted">Đang chọn:
                                                <b>{{ $selectedGroup->name }}</b></span>
                                        @endif
                                    </div>

                                    @if (isset($selectedGroup))
                                        <form id="permission-form"
                                            action="{{ route('feature-group.update', $selectedGroup->id) }}" method="POST">
                                            @csrf

                                            {{-- Đã bỏ class scroller và style height: 600px --}}
                                            <div>

                                                @foreach ($allPermissions as $moduleName => $perms)
                                                    <div>
                                                        {{-- Tiêu đề đỏ --}}
                                                        <div class="module-title">
                                                            <i class="fa fa-cog module-icon"></i>
                                                            {{ $moduleName ?: 'Chức năng khác' }}
                                                        </div>

                                                        <div style="padding-left: 20px;">
                                                            @foreach ($perms as $p)
                                                                <div class="permission-item">
                                                                    <label>
                                                                        <input type="checkbox" name="permissions[]"
                                                                            value="{{ $p->id }}" class="icheck"
                                                                            {{ in_array($p->id, $currentPermissions) ? 'checked' : '' }}>
                                                                        {{ $p->display_name }}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </form>
                                    @else
                                        <div class="alert alert-warning">Chưa có nhóm chức năng nào.</div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/global/plugins/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('.icheck').iCheck({
                checkboxClass: 'icheckbox_square-blue', // Style checkbox vuông xanh
                radioClass: 'iradio_square-blue',
                increaseArea: '20%'
            });
        });
    </script>
@endsection
