<?php namespace LunarMonkey\Repositories;

interface Crudable {
    /**
     * Find a single entity
     *
     * @param int $id
     * @param array $with
     * @return Illuminate\Database\Eloquent\Model
     */
    public function find($id, array $with = array());

    /**
     * Create a new entity
     *
     * @param array $input
     * @return Illuminate\Database\Eloquent\Model
     */
    public function create(array $input);

   /**
    * Update an existing entity
    *
    * @param array $input
    * @return Illuminate\Database\Eloquent\Model
    */
    public function update(array $input);

    /**
     * Delete an existing entity
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id);
}