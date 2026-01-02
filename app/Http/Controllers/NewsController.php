<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
// SỬA DÒNG NÀY: Dùng đường dẫn đầy đủ của Facade Auth
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    // 1. Danh sách bài viết
    public function index()
    {
        $news = News::with('author')->orderBy('status', 'asc')->orderBy('created_at', 'desc')->paginate(10);
        return view('news.index', compact('news'));
    }

    // 2. Form thêm mới
    public function create()
    {
        return view('news.create');
    }

    // 3. Lưu bài viết
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'thumbnail' => 'nullable|mimes:jpeg,png,jpg,gif,webp,jfif|max:10240'
        ], [
            'thumbnail.mimes' => 'Chỉ chấp nhận ảnh đuôi: jpeg, png, jpg, gif, webp, jfif.',
            'thumbnail.max' => 'Dung lượng ảnh không được quá 10MB.',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title) . '-' . time();

        // SỬA: Đã import ở trên nên bỏ dấu \ ở trước
        $data['author_id'] = Auth::id();
        $data['status'] = 0;

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/news'), $filename);
            $data['thumbnail'] = 'uploads/news/' . $filename;
        }

        News::create($data);

        return redirect()->route('news.index')->with('success', 'Bài viết đã được gửi và đang chờ phê duyệt.');
    }

    // 4. PHÊ DUYỆT
    public function approve($id)
    {

        $news = News::findOrFail($id);
        $news->status = 1;
        $news->published_at = now();
        $news->save();

        return redirect()->back()->with('success', 'Đã phê duyệt bài viết!');
    }

    // 5. TỪ CHỐI
    public function reject($id)
    {

        $news = News::findOrFail($id);
        $news->status = 2;
        $news->save();

        return redirect()->back()->with('warning', 'Đã từ chối bài viết.');
    }

    // 6. Trang chủ tin tức (Public)
    public function publicIndex(Request $request)
    {
        $query = News::where('status', 1)->orderBy('created_at', 'desc');

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', '%' . $keyword . '%')
                    ->orWhere('summary', 'like', '%' . $keyword . '%')
                    ->orWhere('content', 'like', '%' . $keyword . '%');
            });
        }

        $news = $query->paginate(9);
        return view('news.public_index', compact('news'));
    }

    // 7. Xem chi tiết
    public function show($id, $slug = null)
    {
        $post = News::where('id', $id)->where('status', 1)->firstOrFail();

        $relatedPosts = News::where('status', 1)
            ->where('id', '!=', $id)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        return view('news.show', compact('post', 'relatedPosts'));
    }

    // 8. XÓA BÀI VIẾT
    public function destroy($id)
    {


        $news = News::findOrFail($id);

        if ($news->thumbnail && file_exists(public_path($news->thumbnail))) {
            unlink(public_path($news->thumbnail));
        }

        $news->delete();

        return redirect()->back()->with('success', 'Đã xóa bài viết thành công!');
    }

    // 9. FORM SỬA BÀI VIẾT
    public function edit($id)
    {
        // Tìm bài viết, nếu không thấy báo lỗi 404
        $news = News::findOrFail($id);
        
        // Trả về view edit và truyền biến $news sang
        return view('news.edit', compact('news'));
    }

    // 10. CẬP NHẬT BÀI VIẾT
    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        // Validate dữ liệu
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            // Ảnh không bắt buộc (nullable) khi sửa
            'thumbnail' => 'nullable|mimes:jpeg,png,jpg,gif,webp,jfif|max:10240' 
        ], [
            'title.required' => 'Vui lòng nhập tiêu đề',
            'content.required' => 'Vui lòng nhập nội dung',
            'thumbnail.mimes' => 'Chỉ chấp nhận ảnh đuôi: jpeg, png, jpg, gif, webp, jfif.',
            'thumbnail.max' => 'Dung lượng ảnh không được quá 10MB.',
        ]);

        $data = $request->all();
        
        // Cập nhật slug theo tiêu đề mới
        $data['slug'] = Str::slug($request->title) . '-' . time();

        // Nếu sửa bài thì reset trạng thái về "Chờ duyệt" (Tuỳ logic công ty bạn)
        // Nếu muốn giữ nguyên trạng thái cũ thì xóa dòng dưới đi
        $data['status'] = 0; 

        // Xử lý ảnh đại diện
        if ($request->hasFile('thumbnail')) {
            // 1. Xóa ảnh cũ nếu có
            if ($news->thumbnail && file_exists(public_path($news->thumbnail))) {
                unlink(public_path($news->thumbnail));
            }

            // 2. Upload ảnh mới
            $file = $request->file('thumbnail');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/news'), $filename);
            $data['thumbnail'] = 'uploads/news/' . $filename;
        } else {
            // Nếu không chọn ảnh mới thì giữ nguyên ảnh cũ
            $data['thumbnail'] = $news->thumbnail;
        }

        $news->update($data);

        return redirect()->route('news.index')->with('success', 'Cập nhật bài viết thành công!');
    }
}
