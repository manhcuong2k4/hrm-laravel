@extends('layouts.master')

@section('title', 'Soạn bài viết mới')

@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        {{-- ... Giữ nguyên phần Breadcrumb ... --}}
        
        <h1 class="page-title">
            <i class="fa fa-pencil-square-o"></i> Thêm tin tức mới
        </h1>

        {{-- Bỏ khối alert chung ở trên đi để code gọn hơn, vì lỗi sẽ hiện dưới từng input --}}
        
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    {{-- ... Giữ nguyên phần portlet-title ... --}}
                    
                    <div class="portlet-body form">
                        <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="form-body">
                                
                                {{-- 1. INPUT TIÊU ĐỀ --}}
                                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                    <label class="control-label bold">Tiêu đề bài viết <span class="required" aria-required="true"> * </span></label>
                                    <input type="text" name="title" class="form-control" placeholder="Nhập tiêu đề tại đây..." value="{{ old('title') }}">
                                    
                                    {{-- Hiện lỗi ngay dưới --}}
                                    @if($errors->has('title'))
                                        <span class="help-block font-red">
                                            <i class="fa fa-times-circle"></i> {{ $errors->first('title') }}
                                        </span>
                                    @endif
                                </div>
                                
                                {{-- 2. INPUT ẢNH --}}
                                <div class="form-group {{ $errors->has('thumbnail') ? 'has-error' : '' }}">
                                    <label class="control-label">Ảnh đại diện</label>
                                    <input type="file" name="thumbnail" class="form-control">
                                    
                                    {{-- Hiện lỗi ngay dưới --}}
                                    @if($errors->has('thumbnail'))
                                        <span class="help-block font-red">
                                            <i class="fa fa-times-circle"></i> {{ $errors->first('thumbnail') }}
                                        </span>
                                    @endif
                                </div>

                                {{-- 3. INPUT NỘI DUNG --}}
                                <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
                                    <label class="control-label bold">Nội dung chi tiết <span class="required" aria-required="true"> * </span></label>
                                    <textarea name="content" id="editor" class="form-control" rows="10">{{ old('content') }}</textarea> 
                                    
                                    {{-- Hiện lỗi ngay dưới --}}
                                    @if($errors->has('content'))
                                        <span class="help-block font-red">
                                            <i class="fa fa-times-circle"></i> {{ $errors->first('content') }}
                                        </span>
                                    @endif
                                </div>

                            </div>
                            
                            {{-- ... Giữ nguyên phần nút bấm ... --}}
                            <div class="form-actions right">
                                <a href="{{ route('news.index') }}" class="btn default">
                                    <i class="fa fa-arrow-left"></i> Hủy bỏ
                                </a>
                                <button type="submit" class="btn green">
                                    <i class="fa fa-check"></i> Thêm mới tin tức
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
    CKEDITOR.replace( 'editor', {
        height: 400,
        versionCheck: false 
    });
</script>
@endsection