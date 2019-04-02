<?php
/**
 * Created by PhpStorm.
 * User: tit
 * Date: 28/03/19
 * Time: 10:58
 */

namespace App\Repositories\Implement;

use App\Models\Blog;
use App\Repositories\BlogRepositoryInterface;

class BlogRepository extends Repository implements BlogRepositoryInterface
{

    public function model()
    {
        return Blog::class;
    }
}