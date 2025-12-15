<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;

class NewsController extends Controller
{
    //
    // Danh sách bài viết
    public function index()
    {
        // Lấy bài viết, ưu tiên bài chờ duyệt lên đầu
        $news = News::with('author')->orderBy('status', 'asc')->orderBy('created_at', 'desc')->paginate(10);
        return view('news.index', compact('news'));
    }

    // Form thêm mới
    public function create()
    {
        return view('news.create');
    }

    // Lưu bài viết
    public function store(Request $request)
{

    
    $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
        // THÊM 'jfif' VÀO DÒNG DƯỚI ĐÂY:
        // Bỏ chữ 'image', chỉ giữ lại 'mimes'
'thumbnail' => 'nullable|mimes:jpeg,png,jpg,gif,webp,jfif|max:10240'
    ], [
        'thumbnail.mimes' => 'Chỉ chấp nhận ảnh đuôi: jpeg, png, jpg, gif, webp, jfif.', 
        'thumbnail.max' => 'Dung lượng ảnh không được quá 10MB.',
    ]);

    $data = $request->all();
    
    // Cần import Str ở đầu file: use Illuminate\Support\Str;
    $data['slug'] = \Illuminate\Support\Str::slug($request->title) . '-' . time();
    $data['author_id'] = \Auth::id();
    $data['status'] = 0; 

    if ($request->hasFile('thumbnail')) {
        $file = $request->file('thumbnail');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/news'), $filename);
        $data['thumbnail'] = 'uploads/news/' . $filename;
    }

    // Nếu người dùng không up ảnh, dòng này đảm bảo không bị lỗi null
    // (Tùy chọn: Có thể set ảnh mặc định nếu muốn)
    
    \App\Models\News::create($data);

    return redirect()->route('news.index')->with('success', 'Bài viết đã được gửi và đang chờ phê duyệt.');
}

    public function approve($id)
{
    // Kiểm tra quyền chặt chẽ từ Server
    if (!Auth::user()->can('approve-news')) {
        abort(403, 'Bạn không có quyền thực hiện chức năng này.');
    }

    $news = News::findOrFail($id);
    $news->status = 1; 
    $news->published_at = now();
    $news->save();

    return redirect()->back()->with('success', 'Đã phê duyệt bài viết!');
}

public function reject($id)
{
    if (!Auth::user()->can('approve-news')) {
        abort(403, 'Bạn không có quyền thực hiện chức năng này.');
    }

    $news = News::findOrFail($id);
    $news->status = 2; 
    $news->save();

    return redirect()->back()->with('warning', 'Đã từ chối bài viết.');
}

// Nhớ import Request ở đầu file Controller
 

public function publicIndex(Request $request)
{
    // 1. Khởi tạo query cơ bản: Chỉ lấy bài đã duyệt & mới nhất
    $query = News::where('status', 1)->orderBy('created_at', 'desc');

    // 2. Kiểm tra xem có từ khóa tìm kiếm gửi lên không
    if ($request->filled('keyword')) {
        $keyword = $request->keyword;
        
        // Tìm trong Tiêu đề HOẶC Tóm tắt HOẶC Nội dung
        $query->where(function($q) use ($keyword) {
            $q->where('title', 'like', '%' . $keyword . '%')
              ->orWhere('summary', 'like', '%' . $keyword . '%')
              ->orWhere('content', 'like', '%' . $keyword . '%');
        });
    }

    // 3. Phân trang kết quả
    $news = $query->paginate(9);

    // 4. Trả về view (Lưu ý: kiểm tra đúng tên file view của bạn là 'news.public_index' hay 'trangchu.index')
    return view('news.public_index', compact('news'));
}
    // 2. Xem chi tiết một bài viết
    public function show($id, $slug = null) // Thêm $slug nếu route có defined
{
    // 1. Lấy bài viết hiện tại
    $post = News::where('id', $id)->where('status', 1)->firstOrFail();

    // 2. Lấy bài viết liên quan (Cùng status=1, KHÁC bài hiện tại, lấy 3 bài mới nhất)
    $relatedPosts = News::where('status', 1)
                        ->where('id', '!=', $id) // Loại trừ bài đang xem
                        ->orderBy('created_at', 'desc')
                        ->limit(3) // Chỉ lấy 3 bài
                        ->get();

    // 3. Truyền cả $post và $relatedPosts sang View
    return view('news.show', compact('post', 'relatedPosts'));
}
    public function destroy($id)
{
    // --- BẢO MẬT: Chặn nếu không có quyền xóa ---
    if (!\Auth::user()->can('delete-news')) {
        abort(403, 'Bạn không có quyền xóa bài viết này.');
    }
    // --------------------------------------------

    $news = News::findOrFail($id);

    if ($news->thumbnail && file_exists(public_path($news->thumbnail))) {
        unlink(public_path($news->thumbnail));
    }

    $news->delete();

    return redirect()->back()->with('success', 'Đã xóa bài viết thành công!');
}

}

