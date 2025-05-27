<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
     /**
     * @return mixed
     */
    public function all();

    /**
     * @param int|string $id
     * @return mixed
     */
    public function find($id);

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param int|string $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data);

    /**
     * @param int|string $id
     * @return mixed
     */
    public function delete($id);

}
