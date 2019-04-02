<?php
/**
 * Created by PhpStorm.
 * User: tit
 * Date: 28/03/19
 * Time: 10:13
 */

namespace App\Repositories;

interface RepositoryInterface
{
    public function all(array $columns = []);

    public function paginate(int $perPage, array $columns = []);

    public function create($data);

    public function createBulk(array $data): bool;

    public function update($data, $id): bool;

    public function updateBulk(array $data): bool;

    public function delete(int $id): bool;

    public function find(int $id, array $columns = []);

    public function findIn(array $ids, array $columns = []);

    public function findBy(string $field, string $value, array $columns = []);
}