<?php
/**
 * Created by PhpStorm.
 * User: Cals
 * Date: 2017/3/2
 * Time: 20:49
 */

namespace Cals\RSP\Repositories\Interfaces;

/**
 * Interface RepositoryInterface
 *
 * @package Cals\RSP\Repositories\Interfaces
 */
interface RepositoryInterface
{
    /**
     * Store one record into database.
     *
     * @param array $inputs
     * @return mixed
     */
    public function store(array $inputs);

    /**
     * Get all records from the database.
     *
     * @return mixed
     */
    public function all();

    /**
     * Paginate the records which satisfied credentials.
     *
     * @param array|null $credentials
     * @param int $page
     * @param int $perPage
     * @return mixed
     */
    public function paginate(array $credentials = null, $page, $perPage = 15);

    /**
     * Get some records with columns provided which satisfied credentials.
     *
     * @param array|null $credentials
     * @param array $columns
     * @return mixed
     */
    public function get(array $credentials = null, array $columns = ['*']);

    /**
     * Get some records with columns provided which satisfied credentials, and sort by the field.
     *
     * @param array|null $credentials
     * @param array $columns
     * @param $field
     * @param $asc
     * @return mixed
     */
    public function getRecordsSortBy(array $credentials = null, array $columns = ['*'], $field = 'id', $asc = true);

    /**
     * Find the record which satisfied credentials.
     *
     * @param array|null $credentials
     * @return mixed
     */
    public function find(array $credentials = null);

    /**
     * Update some records satisfied by credentials to new values provided.
     *
     * @param array $credentials
     * @param array $inputs
     * @return boolean
     */
    public function update(array $credentials, array $inputs);

    /**
     * Destroy some records satisfied by credentials.
     *
     * @param array $credentials
     * @return boolean
     */
    public function destroy(array $credentials);

    /**
     * Provide an Eloquent builder with sure credentials.
     *
     * @param array|null $credentials
     * @return mixed
     */
    public function builder(array $credentials = null);
}
