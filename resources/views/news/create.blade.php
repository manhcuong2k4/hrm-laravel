@extends('layouts.master')

@section('title', 'Soạn bài viết mới')

@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">Bảng Điều Khiển</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="{{ route('news.index') }}">Quản trị tin tức</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Soạn bài viết</span>
                </li>
            </ul>
        </div>
        <h1 class="page-title">
            <i class="fa fa-pencil-square-o"></i> Soạn bài viết mới
            <small>Nhập thông tin và gửi phê duyệt</small>
        </h1>
        @if($errors->any())
        <div class="alert alert-danger">
            <button class="close" data-close="alert"></button>
            @foreach($errors->all() as $error)
                <p> {{ $error }} </p>
            @endforeach
        </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-red-sunglo">
                            <i class="icon-note font-red-sunglo"></i>
                            <span class="caption-subject bold uppercase"> Thông tin bài viết</span>
                        </div>
                        <div class="actions">
                            <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                <i class="icon-cloud-upload"></i>
                            </a>
                            <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                <i class="icon-wrench"></i>
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label bold">Tiêu đề bài viết <span class="required" aria-required="true"> * </span></label>
                                    <input type="text" name="title" class="form-control" placeholder="Nhập tiêu đề tại đây..." required value="{{ old('title') }}">
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label">Ảnh đại diện</label>
                                    <input type="file" name="thumbnail" class="form-control">
                                </div>

                               

                                <div class="form-group">
                                    <label class="control-label bold">Nội dung chi tiết <span class="required" aria-required="true"> * </span></label>
                                    <textarea name="content" id="editor" class="form-control" rows="10" required>{{ old('content') }}</textarea> 
                                </div>
                            </div>
                            <div class="form-actions right">
                                <a href="{{ route('news.index') }}" class="btn default">
                                    <i class="fa fa-arrow-left"></i> Hủy bỏ
                                </a>
                                <button type="submit" class="btn green">
                                    <i class="fa fa-check"></i> Gửi phê duyệt
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
        </div>
    </div>
    </div>
@endsection

@section('script')
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

<script>
    // 2. Cấu hình tắt thông báo kiểm tra phiên bản
    CKEDITOR.replace( 'editor', {
        height: 400,
        versionCheck: false // Dòng này quan trọng: Tắt cái bảng đỏ thông báo lỗi version
    });
</script>
@endsection