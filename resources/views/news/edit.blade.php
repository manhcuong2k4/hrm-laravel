@extends('layouts.master')

@section('title', 'Chỉnh sửa bài viết')

@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-settings font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Chỉnh sửa tin tức</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-body">
                        
                        {{-- Tiêu đề --}}
                        <div class="form-group">
                            <label>Tiêu đề bài viết</label>
                            <input type="text" name="title" class="form-control" placeholder="Nhập tiêu đề" 
                                   value="{{ old('title', $news->title) }}" required>
                        </div>

                        {{-- Ảnh đại diện --}}
                        <div class="form-group">
                            <label>Ảnh đại diện (Thumbnail)</label>
                            <input type="file" name="thumbnail" class="form-control">
                            
                            {{-- Hiển thị ảnh cũ để người dùng biết --}}
                            @if($news->thumbnail)
                                <div style="margin-top: 10px;">
                                    <label>Ảnh hiện tại:</label><br>
                                    <img src="{{ asset($news->thumbnail) }}" alt="Thumbnail cũ" width="150">
                                </div>
                            @endif
                        </div>

                        {{-- Tóm tắt (Nếu có cột summary) --}}
                        <div class="form-group">
                            <label>Tóm tắt</label>
                            <textarea name="summary" class="form-control" rows="3">{{ old('summary', $news->summary ?? '') }}</textarea>
                        </div>

                        {{-- Nội dung (Dùng CKEditor nếu có) --}}
                        <div class="form-group">
                            <label>Nội dung chi tiết</label>
                            <textarea name="content" id="editor" class="form-control" rows="10">{{ old('content', $news->content) }}</textarea>
                        </div>

                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn blue">Lưu thay đổi</button>
                        <a href="{{ route('news.index') }}" class="btn default">Hủy bỏ</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

