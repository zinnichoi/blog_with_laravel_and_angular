<?php
/**
 * Created by PhpStorm.
 * User: tit
 * Date: 28/03/19
 * Time: 11:20
 */

namespace App\Services;

interface BlogServiceInterface
{
    public function store($data): bool;

    public function all() ;

    public function find(int $id);

    public function update($data,int $id) : bool;

    public function delete(int $id) : bool ;
}