<?php
namespace App\Repositories;

use App\Models\Blogs;
use Illuminate\Support\Facades\DB;

class BlogsRepository
{
    public function getAll($params)
    {
        $query = Blogs::with('blogType');
        if (isset($params['filterBlogType'])) {
            $query->where('blog_type_id', $params['filterBlogType']);
        }
        if (isset($params['filterKeyword'])) {
            $query->where('title', 'LIKE', '%' . $params['filterKeyword'] . '%');
        }
        $query->orderBy('id', 'desc')->get();
        return $query;
    }
}
