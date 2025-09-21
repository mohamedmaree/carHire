<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\blog\Store;
use App\Http\Requests\Admin\blog\Update;
use App\Models\Blog;
use App\Traits\Report;

class BlogController extends Controller
{
    public function __construct()
    {
        $name = 'blog';
        $this->middleware('permission:read-all-' . $name)->only(['index']);
        $this->middleware('permission:read-' . $name)->only(['show']);
        $this->middleware('permission:create-' . $name)->only(['create', 'store']);
        $this->middleware('permission:update-' . $name)->only(['edit', 'update']);
        $this->middleware('permission:delete-' . $name)->only(['destroy']);
    }

    public function index()
    {
        if (request()->ajax()) {
            $blogs = Blog::search(request()->searchArray)->paginate(30);
            $html = view('admin.blog.table', compact('blogs'))->render();
            return response()->json(['html' => $html]);
        }

        $blogs = Blog::search(request()->searchArray)->paginate(30);
        return view('admin.blog.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Store $request)
    {
        Blog::create($request->validated());
        Report::addToLog('إضافة مدونة جديدة');
        return response()->json(['url' => route('admin.blogs.index')]);
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blog.edit', compact('blog'));
    }

    public function update(Update $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->update($request->validated());
        Report::addToLog('تعديل مدونة');
        return response()->json(['url' => route('admin.blogs.index')]);
    }

    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blog.show', compact('blog'));
    }

    public function destroy($id)
    {
        Blog::findOrFail($id)->delete();
        Report::addToLog('حذف مدونة');
        return response()->json(['icon' => 'success', 'title' => __('admin.deleted_successfully')]);
    }

    public function destroyAll(Request $request)
    {
        $request->validate([
            'ids'   => 'required|array|min:1',
            'ids.*' => 'required|exists:blogs,id',
        ]);
        Blog::whereIn('id', $request->ids)->delete();
        Report::addToLog('حذف مجموعة مدونات');
        return response()->json(['icon' => 'success', 'title' => __('admin.deleted_successfully')]);
    }
}
