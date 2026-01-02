@extends('layouts.master')

@section('title', 'Chỉnh sửa tin tức')

@section('style')
    {{-- Nếu bạn dùng CKEditor hoặc Summernote thì include CSS vào đây --}}
@endsection

@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li><a href="{{ route('dashboard') }}">Dashboard</a> <i class="fa fa-circle"></i></li>
                <li><a href="{{ route('news.index') }}">Tin tức</a> <i class="fa fa-circle"></i></li>
                <li><span>Chỉnh sửa</span></li>
            </ul>
        </div>

        <h1 class="page-title"> <i class="fa fa-pencil"></i> Chỉnh sửa bài viết </h1>

        @include('partials.flash-message')

        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-green-haze">
                            <i class="icon-note font-green-haze"></i>
                            <span class="caption-subject bold uppercase"> Nội dung bài viết</span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        {{-- Form bắt đầu --}}
                        <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{-- HTML Form không hỗ trợ PUT trực tiếp nên dùng POST --}}
                            
                            <div class="form-body">
                                {{-- Tiêu đề --}}
                                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                    <label>Tiêu đề bài viết <span class="required">*</span></label>
                                    <input type="text" name="title" class="form-control" 
                                           value="{{ old('title', $news->title) }}" placeholder="Nhập tiêu đề...">
                                    @if($errors->has('title'))
                                        <span class="help-block">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>

                                {{-- Ảnh đại diện --}}
                                <div class="form-group">
                                    <label>Ảnh đại diện</label> <br>
                                    @if($news->thumbnail)
                                        <img src="{{ asset($news->thumbnail) }}" alt="Old Image" style="width: 150px; margin-bottom: 10px; border: 1px solid #ddd; padding: 3px;">
                                        <br>
                                    @endif
                                    <input type="file" name="thumbnail" class="form-control">
                                    <span class="help-block"> Để trống nếu không muốn thay đổi ảnh. </span>
                                </div>

                                {{-- Nội dung --}}
                                <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
                                    <label>Nội dung chi tiết <span class="required">*</span></label>
                                    {{-- Nếu dùng CKEditor thì thêm ID hoặc Class tương ứng --}}
                                    <textarea name="content" class="form-control ckeditor" rows="10">{{ old('content', $news->content) }}</textarea>
                                    @if($errors->has('content'))
                                        <span class="help-block">{{ $errors->first('content') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-actions right">
                                <a href="{{ route('news.index') }}" class="btn default">Hủy</a>
                                <button type="submit" class="btn green">
                                    <i class="fa fa-save"></i> Cập nhật
                                </button>
                            </div>
                        </form>
                        {{-- Form kết thúc --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    {{-- Script CKEditor nếu dùng --}}
    <script src="{{ asset('assets/global/plugins/ckeditor/ckeditor.js') }}"></script>
@endsection