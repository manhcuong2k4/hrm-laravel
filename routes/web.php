<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;
use League\Glide\ServerFactory;
use League\Glide\Responses\LaravelResponseFactory;

// Import Controllers mới (Laravel 10 style)
use App\Http\Controllers\NewsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- GLIDE IMAGE SERVER ---
Route::get('glide/{path}', function($path){
    $server = ServerFactory::create([
        'source' => app('filesystem')->disk('public')->getDriver(),
        'cache' => storage_path('glide'),
        'response' => new LaravelResponseFactory(app('request'))
    ]);
    $response = $server->getImageResponse($path, request()->all());
    $response->send();
})->where('path', '.+');

// --- AUTHENTICATION ---
Route::get('login', [
    'uses' => 'LoginController@getLogin',
    'as'   => 'login'
]);
Route::post('login', [
    'uses' => 'LoginController@postLogin',
    'as'   => 'login.post'
]);
Route::get('logout', 'LoginController@getLogout')->name('logout.get');

Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// --- PUBLIC ROUTES (Không cần đăng nhập) ---
Route::get('/', function () {
    return view('trangchu.index'); // Trả về file resources/views/trangchu/index.blade.php
})->name('home');

// Tin tức hiển thị công khai
Route::get('/tin-tuc', [NewsController::class, 'publicIndex'])->name('news.public');
Route::get('/tin-tuc/{id}-{slug}', [NewsController::class, 'show'])->name('news.show');


/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES (Cần đăng nhập & Active)
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'only_active_user']], function () {

    // 1. DASHBOARD (Quyền: read-dashboard)
    Route::get('dashboard', [
        'middleware' => ['permission:read-dashboard'],
        'uses' => 'DashboardController@getDashboard',
        'as'   => 'dashboard'
    ]);

    // 2. USER MANAGEMENT (Quyền: users)
    Route::prefix('users')->group(function () {
        Route::get('/', ['middleware' => ['permission:read-users'], 'uses'=>'UserController@index','as'=>'user.index']);
        
        Route::get('/add', ['middleware' => ['permission:create-users'], 'uses'=>'UserController@create','as'=>'user.add.get']);
        Route::post('/add', ['middleware' => ['permission:create-users'], 'uses'=>'UserController@store','as'=>'user.add.post']);
        
        Route::get('/edit/{id}', ['middleware' => ['permission:update-users'], 'uses' =>'UserController@edit','as'=>'user.edit.get']);
        Route::post('/edit', ['middleware' => ['permission:update-users'], 'uses'=>'UserController@update','as'=>'user.edit.post']);
        
        Route::get('/delete/{id}', ['middleware' => ['permission:delete-users'], 'uses'=>'UserController@destroy','as'=>'user.delete.get']);
    });

    // 3. STAFF MANAGEMENT (Quyền: nhan-su)
    Route::prefix('staffs')->group(function () {
        Route::get('/', ['middleware' => ['permission:read-nhan-su'], 'uses'=>'NhanSuController@index','as'=>'nhan_su.index']);
        Route::get('/read/{id}', ['middleware' => ['permission:read-nhan-su'], 'uses'=>'NhanSuController@read','as'=>'nhan_su.read.get']);
        
        Route::get('/add', ['middleware' => ['permission:create-nhan-su'], 'uses'=>'NhanSuController@create','as'=>'nhan_su.add.get']);
        Route::post('/add', ['middleware' => ['permission:create-nhan-su'], 'uses'=>'NhanSuController@store','as'=>'nhan_su.add.post']);
        
        Route::get('/edit/{id}', ['middleware' => ['permission:update-nhan-su'], 'uses' =>'NhanSuController@edit','as'=>'nhan_su.edit.get']);
        Route::post('/edit/{id}', ['middleware' => ['permission:update-nhan-su'], 'uses'=>'NhanSuController@update','as'=>'nhan_su.edit.post']);
        
        Route::get('/delete/{id}', ['middleware' => ['permission:delete-nhan-su'], 'uses'=>'NhanSuController@destroy','as'=>'nhan_su.delete.get']);
        
        // Import/Export Excel (Gán tạm quyền create-nhan-su)
        Route::get('/export-excel', ['middleware' => ['permission:create-nhan-su'], 'uses'=>'NhanSuController@exportExcel','as'=>'nhan_su.export-excel.get']);
        Route::get('/import-excel', ['middleware' => ['permission:create-nhan-su'], 'uses'=>'NhanSuController@importExcel','as'=>'nhan_su.import-excel.get']);
        Route::post('/import-excel', ['middleware' => ['permission:create-nhan-su'], 'uses'=>'NhanSuController@postImportExcel','as'=>'nhan_su.import-excel.post']);
    });

    // 4. COMPANY SETTINGS (Quyền: update-company)
    Route::prefix('company')->group(function () {
        Route::get('/init', ['middleware' => ['permission:update-company'], 'uses'=>'CompanyController@init','as'=>'company.init']);
        Route::get('/', ['middleware' => ['permission:update-company'], 'uses'=>'CompanyController@index','as'=>'company.index']);
        Route::post('/update', ['middleware' => ['permission:update-company'], 'uses'=>'CompanyController@update','as'=>'company.update']);
    });

    // 5. AJAX OPERATIONS (Hợp đồng & Quyết định)
    Route::prefix('ajax')->group(function () {
        Route::post('/dsBoPhanTheoPhongBan', ['uses'=>'NhanSuController@dsBoPhanTheoPhongBan','as'=>'dsBoPhanTheoPhongBan']);
        
        // Hợp Đồng (Quyền: hop-dong)
        Route::post('/postThemHopDong', ['middleware' => ['permission:create-hop-dong'], 'uses'=>'HopDongController@postThemHopDong','as'=>'postThemHopDong']);
        Route::post('/postTimHopDongTheoId', ['uses'=>'HopDongController@postTimHopDongTheoId','as'=>'postTimHopDongTheoId']);
        Route::post('/postSuaHopDong', ['middleware' => ['permission:update-hop-dong'], 'uses'=>'HopDongController@postSuaHopDong','as'=>'postSuaHopDong']);
        Route::post('/postXoaHopDong', ['middleware' => ['permission:delete-hop-dong'], 'uses'=>'HopDongController@postXoaHopDong','as'=>'postXoaHopDong']);

        // Quyết Định (Quyền: quyet-dinh)
        Route::post('/postThemQuyetDinh', ['middleware' => ['permission:create-quyet-dinh'], 'uses'=>'QuyetDinhController@postThemQuyetDinh','as'=>'postThemQuyetDinh']);
        Route::post('/postTimQuyetDinhTheoId', ['uses'=>'QuyetDinhController@postTimQuyetDinhTheoId','as'=>'postTimQuyetDinhTheoId']);
        Route::post('/postSuaQuyetDinh', ['middleware' => ['permission:update-quyet-dinh'], 'uses'=>'QuyetDinhController@postSuaQuyetDinh','as'=>'postSuaQuyetDinh']);
        Route::post('/postXoaQuyetDinh', ['middleware' => ['permission:delete-quyet-dinh'], 'uses'=>'QuyetDinhController@postXoaQuyetDinh','as'=>'postXoaQuyetDinh']);
    });

    // 6. FILE MANAGER (Quyền: update-file-manager)
    Route::prefix('file-manager')->group(function () {
        Route::get('/', ['middleware' => ['permission:update-file-manager'], 'uses'=>'FileManagerController@index','as'=>'file-manager.index']);
    });

    // 7. ACL / ROLES (Quyền: acl)
    Route::prefix('roles')->group(function () {
        Route::get('/', ['middleware' => ['permission:read-acl'], 'uses'=>'RoleController@index','as'=>'role.index']);
        Route::get('/create', ['middleware' => ['permission:create-acl'], 'uses'=>'RoleController@create','as'=>'role.create']);
        Route::post('/store', ['middleware' => ['permission:create-acl'], 'uses'=>'RoleController@store','as'=>'role.store']);
        
        Route::get('/show/{id}', ['middleware' => ['permission:update-acl'], 'uses'=>'RoleController@show','as'=>'role.show']);
        Route::get('/edit/{id}', ['middleware' => ['permission:update-acl'], 'uses'=>'RoleController@edit','as'=>'role.edit']);
        Route::post('/edit/{id}', ['middleware' => ['permission:delete-acl'], 'uses'=>'RoleController@update','as'=>'role.update']);
    });

    // 8. ADMIN NEWS (Tin Tức - Quản trị)
    // Đã map đúng với database: read-news, create-news, delete-news, approve-news
    Route::group(['prefix' => 'admin/news', 'as' => 'news.'], function () {
        
        // Xem danh sách (read-news)
        Route::get('/', [NewsController::class, 'index'])
            ->name('index')
            ->middleware('permission:read-news');

        // Thêm mới (create-news)
        Route::get('/create', [NewsController::class, 'create'])
            ->name('create')
            ->middleware('permission:create-news');

        Route::post('/store', [NewsController::class, 'store'])
            ->name('store')
            ->middleware('permission:create-news');

        // Phê duyệt (approve-news)
        Route::get('/approve/{id}', [NewsController::class, 'approve'])
            ->name('approve')
            ->middleware('permission:approve-news');

        Route::get('/reject/{id}', [NewsController::class, 'reject'])
            ->name('reject')
            ->middleware('permission:approve-news');

        // Xóa (delete-news)
        Route::get('/delete/{id}', [NewsController::class, 'destroy'])
            ->name('destroy')
            ->middleware('permission:delete-news');
    });

});