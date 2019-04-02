<?php
/**
 * Created by PhpStorm.
 * User: tit
 * Date: 28/03/19
 * Time: 11:22
 */

namespace App\Services\Implement;

use App\Repositories\BlogRepositoryInterface;
use App\Services\BlogServiceInterface;
use Illuminate\Support\Facades\Auth;


class BlogService implements BlogServiceInterface
{
    private $blogRepository;

    /**
     * BlogService constructor.
     * @param $blogRepository
     */
    public function __construct(BlogRepositoryInterface $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    /**
     * @param $data
     * @return bool
     */
    public function store($data): bool
    {
        $user = Auth::user();
        if (is_null($user)) {
            return false;
        }
        $data['user_id'] = $user->getAuthIdentifier();
        if ($this->blogRepository->create($data)) {
            return true;
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->blogRepository->all();
    }

    public function find(int $id)
    {
        return $this->blogRepository->find($id);
    }

    /**
     * @param $data
     * @param int $id
     * @return bool
     */
    public function update($data, int $id): bool
    {
        $user = Auth::user();
        if (is_null($user)) {
            return false;
        }
        $data['user_id'] = $user->getAuthIdentifier();
        if ($this->blogRepository->update($data, $id)) {
            return true;
        }
        return false;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->blogRepository->delete($id);
    }
}