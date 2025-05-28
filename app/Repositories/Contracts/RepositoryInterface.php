<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    /**
     * Retrieve all records.
     *
     * @param array $data
     * @return mixed
     */

    public function all(array $data = []);

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
     * @param array $data
     * @param int|string $id
     * @return mixed
     */
    public function update(array $data, $id);

    /**
     * @param int|string $id
     * @return mixed
     */
    public function delete($id);

}
