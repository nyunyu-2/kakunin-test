<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    public function admin(Request $request)
    {
        $categories = Category::all();

        $query = Contact::with('category');

        // キーワード検索（名前またはメールアドレス）
        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($q) use ($keyword) {
                $q->where('first_name', 'like', "%{$keyword}%")
                    ->orWhere('last_name', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%");
            });
        }

        // 性別検索
        if ($request->filled('gender') && $request->input('gender') !== 'all') {
            $gender = (int) $request->input('gender');
            $query->where('gender', $gender);
        }

        // お問い合わせ種類
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        // 日付検索
        if ($request->filled('contact_date')) {
            $query->whereDate('created_at', $request->input('contact_date'));
        }

        // ページネーション（検索条件も引き継ぐ）
        $contacts = $query->paginate(7)->appends($request->query());

        $currentPage = $contacts->currentPage();
        $lastPage = $contacts->lastPage();

        // 最大5ページ分表示するための開始と終了ページ番号を計算
        $start = max(1, $currentPage - 2);
        $end = min($lastPage, $start + 4);

        // 終了ページが最後に近すぎて5つ出せないときの調整
        if ($end - $start < 4) {
            $start = max(1, $end - 4);
        }
        return view('admin', compact(
            'categories',
            'contacts',
            'currentPage',
            'lastPage',
            'start',
            'end'
        ));
    }
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin')->with('success', '削除しました');
    }

    public function export(Request $request)
    {
        $query = Contact::query();

        // 検索条件の絞り込みをindex()と同じロジックで実装
        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($q) use ($keyword) {
                $q->where('last_name', 'like', "%{$keyword}%")
                ->orWhere('first_name', 'like', "%{$keyword}%")
                ->orWhere('email', 'like', "%{$keyword}%");
            });
        }

        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('contact_date')) {
            $query->whereDate('created_at', $request->contact_date);
        }

        $contacts = $query->get();

        $csvData = [];
        $csvData[] = ['お名前', '性別', 'メールアドレス', '電話番号', '住所', '建物名', 'お問い合わせの種類', 'お問い合わせ内容'];

        foreach ($contacts as $contact) {
            $csvData[] = [
                $contact->last_name . ' ' . $contact->first_name,
                ['1' => '男性', '2' => '女性', '3' => 'その他'][$contact->gender] ?? '不明',
                $contact->email,
                $contact->tel,
                $contact->address,
                $contact->building,
                $contact->category->content ?? '不明',
                $contact->detail,
            ];
        }

        $filename = 'contacts_export_' . date('Ymd_His') . '.csv';

        $handle = fopen('php://memory', 'w');
        foreach ($csvData as $row) {
            fputcsv($handle, $row);
        }
        fseek($handle, 0);

        return response()->streamDownload(function () use ($handle) {
            fpassthru($handle);
        }, $filename, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ]);
    }
}
