<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class BlogController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getBlogs(Request $request): JsonResponse
    {

        if ($request->has('mostViewed')) {
            $blogsSorted = Blog::query()->orderBy('views', 'DESC')->with('comments')->get();

            $paginateBlog = $this->paginate($blogsSorted, $request->query('perPage'), $request->query('page'));

            return response()->json([
                'data' => $paginateBlog,
            ]);
        }

        $blogs = Blog::all()->load(['comments', 'creator']);
        return response()->json([
            'data' => $this->paginate($blogs, $request->query('perPage'), $request->query('page')),
        ]);
    }

    /**
     * @param $items
     * @param $perPage
     * @param null $page
     * @return LengthAwarePaginator
     */
    public function paginate($items, $perPage, $page = null)
    {
        $perPage = $perPage ?? 15;
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
        ]);
    }

    public function addViews(int $id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json(['error' => 'Missing blog'], 404);
        }
        /** @var Blog $blog */
        $blog->addViews();

        return response()->json(['data' => $blog]);
    }
}
