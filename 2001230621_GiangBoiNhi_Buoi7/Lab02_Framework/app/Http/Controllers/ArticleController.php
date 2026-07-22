<?php

namespace App\Http\Controllers; // Khai báo namespace cho Controller thuộc thư mục App\Http\Controllers

use Illuminate\Http\Request; // Nạp class Request để nhận dữ liệu gửi lên từ các HTTP Request (Form, Query,...)

class ArticleController extends Controller
{
    /**
     * Hàm helper riêng (private) khởi tạo và lấy danh sách bài viết từ Session
     */
    private function getArticles()
    {
        // Kiểm tra xem trong Session đã có chứa khóa 'articles' hay chưa
        if (!session()->has('articles')) {
            // Mảng dữ liệu mẫu ban đầu nếu Session chưa tồn tại dữ liệu
            $initialArticles = [
                ['id' => 1, 'title' => 'Giới thiệu Laravel 12', 'body' => 'Nội dung bài viết A cơ bản'],
                ['id' => 2, 'title' => 'Blade Components', 'body' => 'Nội dung bài viết B nâng cao'],
            ];
            // Lưu mảng dữ liệu mẫu vào Session với khóa 'articles'
            session(['articles' => $initialArticles]);
        }
        
        // Trả về dữ liệu bài viết hiện đang lưu trong Session
        return session('articles');
    }

    /**
     * 1. Action hiển thị danh sách bài viết (index)
     */
    public function index()
    {
        // Gọi hàm helper để lấy danh sách bài viết hiện tại
        $articles = $this->getArticles();
        
        // Trả về view 'articles.index' và truyền biến $articles sang view bằng hàm compact
        return view('articles.index', compact('articles'));
    }

    /**
     * 2. Action hiển thị Form tạo mới bài viết (create)
     */
    public function create()
    {
        // Trả về giao diện tạo mới bài viết 'articles.create'
        return view('articles.create');
    }

    /**
     * 3. Action xử lý LƯU bài viết MỚI vào Session (store)
     */
    public function store(Request $request)
    {
        // Thực hiện validate dữ liệu đầu vào gửi lên từ Form
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'], // Trường title: Bắt buộc, dạng chuỗi, tối đa 255 ký tự
            'body'  => ['required', 'string', 'min:10'],  // Trường body: Bắt buộc, dạng chuỗi, tối thiểu 10 ký tự
        ]);

        // Lấy danh sách bài viết hiện có trong Session
        $articles = $this->getArticles();
        
        // Tính toán ID mới tự động: Lấy ID lớn nhất trong danh sách cộng thêm 1 (nếu mảng rỗng thì ID = 1)
        $newId = count($articles) > 0 ? max(array_column($articles, 'id')) + 1 : 1;

        // Tạo mảng bài viết mới với dữ liệu được người dùng nhập từ Form
        $newArticle = [
            'id'    => $newId,                        // Gán ID mới vừa tính toán
            'title' => $request->input('title'),      // Lấy giá trị tiêu đề từ input 'title'
            'body'  => $request->input('body'),       // Lấy giá trị nội dung từ input 'body'
        ];
        
        // Thêm bài viết mới vào cuối mảng danh sách
        $articles[] = $newArticle;

        // Lưu cập nhật lại mảng danh sách bài viết mới vào Session
        session(['articles' => $articles]);

        // Chuyển hướng người dùng về trang danh sách kèm theo thông báo flash message thành công
        return redirect()->route('articles.index')
            ->with('success', "Đã thêm mới bài viết #{$newId} và lưu lại thành công!");
    }

    /**
     * 4. Action hiển thị chi tiết một bài viết (show)
     */
    public function show(string $id)
    {
        // Lấy toàn bộ danh sách bài viết từ Session
        $articles = $this->getArticles();
        
        // Sử dụng Laravel Collection để tìm bài viết đầu tiên có ID trùng với $id truyền vào
        $article = collect($articles)->firstWhere('id', (int)$id);

        // Kiểm tra nếu không tìm thấy bài viết tương ứng
        if (!$article) {
            // Điều hướng về trang danh sách kèm thông báo lỗi
            return redirect()->route('articles.index')->with('error', 'Bài viết không tồn tại!');
        }

        // Trả về chuỗi thông báo chi tiết bài viết (dùng cho demo)
        return "Chi tiết bài viết #{$article['id']}: " . $article['title'];
    }

    /**
     * 5. Action hiển thị Form SỬA bài viết (edit)
     */
    public function edit(string $id)
    {
        // Lấy danh sách bài viết
        $articles = $this->getArticles();
        
        // Tìm bài viết theo ID bằng Collection helper
        $article = collect($articles)->firstWhere('id', (int)$id);

        // Nếu bài viết không tồn tại trong Session
        if (!$article) {
            // Điều hướng về trang danh sách kèm thông báo lỗi
            return redirect()->route('articles.index')->with('error', 'Không tìm thấy bài viết để sửa!');
        }

        // Trả về view 'articles.edit' kèm dữ liệu bài viết tìm được
        return view('articles.edit', compact('article'));
    }

    /**
     * 6. Action xử lý CẬP NHẬT bài viết trong Session (update)
     */
    public function update(Request $request, string $id)
    {
        // Validate dữ liệu chỉnh sửa gửi lên từ Form
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'], // Tiêu đề bắt buộc nhập, max 255 ký tự
            'body'  => ['required', 'string', 'min:10'],  // Nội dung bắt buộc nhập, min 10 ký tự
        ]);

        // Lấy danh sách bài viết hiện tại
        $articles = $this->getArticles();

        // Sử dụng vòng lặp duyệt theo tham chiếu (&) để tìm và cập nhật trực tiếp dữ liệu bài viết
        foreach ($articles as &$a) {
            // Kiểm tra nếu ID bài viết trong mảng trùng khớp với ID truyền vào
            if ($a['id'] == $id) {
                $a['title'] = $request->input('title'); // Cập nhật tiêu đề mới
                $a['body']  = $request->input('body');  // Cập nhật nội dung mới
                break; // Dừng vòng lặp ngay khi đã tìm thấy và cập nhật xong
            }
        }

        // Lưu mảng dữ liệu đã cập nhật trở lại Session
        session(['articles' => $articles]);

        // Điều hướng về trang danh sách bài viết kèm flash message thành công
        return redirect()->route('articles.index')
            ->with('success', "Đã cập nhật bài viết #{$id} thành công!");
    }

    /**
     * 7. Action xử lý XOÁ bài viết khỏi Session (destroy)
     */
    public function destroy(string $id)
    {
        // Lấy danh sách bài viết từ Session
        $articles = $this->getArticles();

        // Lọc bỏ bài viết có ID trùng với ID cần xoá bằng hàm array_filter
        $articles = array_filter($articles, function ($a) use ($id) {
            return $a['id'] != $id; // Giữ lại những bài viết có ID khác với $id cần xoá
        });

        // Đánh lại chỉ số (index) liên tục cho mảng và lưu lại vào Session
        session(['articles' => array_values($articles)]);

        // Điều hướng về trang danh sách bài viết kèm thông báo xoá thành công
        return redirect()->route('articles.index')
            ->with('success', "Đã xoá bài viết #{$id} thành công!");
    }

    /**
     * 8. Action XUẤT TOÀN BỘ DANH SÁCH BÀI VIẾT RA FILE .CSV (Xuất cho Excel)
     */
    public function exportCsv()
    {
        // Lấy toàn bộ danh sách bài viết hiện tại từ Session
        $articles = $this->getArticles();
        
        // Đặt tên file tự động theo ngày giờ hiện tại
        $fileName = 'danh-sach-bai-viet-' . date('Y-m-d_H-i') . '.csv';

        // Cấu hình các HTTP Headers bắt buộc cho việc Response Download file CSV
        $headers = [
            "Content-type"        => "text/csv; charset=UTF-8",             // Định dạng loại file là CSV UTF-8
            "Content-Disposition" => "attachment; filename=$fileName",       // Bắt trình duyệt phải tải file về với tên đặt trước
            "Pragma"              => "no-cache",                            // Không cho phép lưu cache file
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0", // Cấu hình cache control
            "Expires"             => "0"                                     // Thời gian hết hạn file
        ];

        // Khai báo hàm callback xử lý ghi dữ liệu trực tiếp vào luồng xuất (stream output)
        $callback = function () use ($articles) {
            // Mở luồng ghi đầu ra chuẩn php://output
            $file = fopen('php://output', 'w');
            
            // Chèn mã BOM (Byte Order Mark) UTF-8 để Microsoft Excel hiển thị tiếng Việt không bị lỗi font
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Ghi dòng tiêu đề cột vào file CSV bằng hàm fputcsv
            fputcsv($file, ['ID', 'Tiêu đề', 'Nội dung']);

            // Lặp từng bài viết trong mảng và ghi dữ liệu tương ứng theo từng dòng vào file CSV
            foreach ($articles as $a) {
                fputcsv($file, [$a['id'], $a['title'], $a['body']]);
            }

            // Đóng luồng file sau khi đã ghi xong dữ liệu
            fclose($file);
        };

        // Trả về StreamedResponse cho người dùng với dữ liệu stream, mã HTTP 200 và mảng Headers đã khai báo
        return response()->stream($callback, 200, $headers);
    }
}