<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    use ResponseTrait;

    /**
     * Get all active blogs
     */
    public function index()
    {
        $blogs = Blog::active()->ordered()->paginate($this->paginateNum());

        return $this->successData(BlogResource::collection($blogs));
    }

    /**
     * Get blog details
     */
    public function show($id)
    {
        $blog = Blog::active()->findOrFail($id);

        return $this->successData(new BlogResource($blog));
    }

    /**
     * Get latest blogs
     */
    public function latest()
    {
        $blogs = Blog::active()->ordered()->limit($this->paginateNum())->get();

        return $this->successData(BlogResource::collection($blogs));
    }

    /**
     * Search blogs
     */
    public function search(Request $request)
    {
        $query = Blog::active();

        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('author', 'like', '%' . $request->search . '%');
            });
        }

        $blogs = $query->ordered()->paginate($this->paginateNum());

        return $this->successData(BlogResource::collection($blogs));
    }
}
