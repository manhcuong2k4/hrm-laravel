@extends('layouts.master')

@section('title', 'Lịch sử đăng nhập hệ thống')

@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-green-haze">
                    <i class="fa fa-clock-o font-green-haze"></i>
                    <span class="caption-subject bold uppercase"> Lịch sử Đăng nhập / Đăng xuất</span>
                </div>
            </div>
            <div class="portlet-body">
                
                {{-- --- KHỐI TÌM KIẾM NÂNG CAO --- --}}
                <div class="row" style="margin-bottom: 15px;">
                    <div class="col-md-12">
                        <form action="{{ route('login-history.index') }}" method="GET" class="form-inline">
                            
                            <div class="form-group" style="margin-right: 10px;">
                                <input type="text" name="keyword" class="form-control" 
                                       placeholder="Tên hoặc email..." 
                                       value="{{ request('keyword') }}">
                            </div>

                            <div class="form-group" style="margin-right: 5px;">
                                <label>Từ:</label>
                                <input type="date" name="date_from" class="form-control" 
                                       value="{{ request('date_from') }}">
                            </div>

                            <div class="form-group" style="margin-right: 10px;">
                                <label>Đến:</label>
                                <input type="date" name="date_to" class="form-control" 
                                       value="{{ request('date_to') }}">
                            </div>

                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-search"></i> Tìm kiếm
                            </button>
                            
                            @if(request('keyword') || request('date_from') || request('date_to'))
                                <a href="{{ route('login-history.index') }}" class="btn btn-default" title="Bỏ lọc">
                                    <i class="fa fa-refresh"></i> Làm mới
                                </a>
                            @endif

                        </form>
                    </div>
                </div>
                {{-- ------------------------------- --}}

                <div class="table-scrollable">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th> Thời gian </th>
                                <th> Tài khoản </th>
                                <th> Hành động </th>
                                <th> IP Address </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($histories->count() > 0)
                                @foreach($histories as $history)
                                <tr>
                                    <td> {{ $history->created_at->format('d/m/Y H:i:s') }} </td>
                                    <td> 
                                        @if($history->user)
                                            <span class="bold">{{ $history->user->name }}</span> <br>
                                            <small>{{ $history->user->email }}</small>
                                        @else
                                            <span class="text-muted">User đã xóa</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($history->action == 'login')
                                            <span class="label label-success"> Đăng nhập </span>
                                        @else
                                            <span class="label label-warning"> Đăng xuất </span>
                                        @endif
                                    </td>
                                    <td> {{ $history->ip_address }} </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center">Không tìm thấy dữ liệu phù hợp.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="text-right">
                    {{ $histories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection