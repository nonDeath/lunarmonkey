<?php namespace LunarMonkey\Repositories\User;

use LunarMonkey\Repositories\Repository;

abstract class AbstractUserDecorator {

    /**
     * @var UserRepository
     */
    protected $user;

    /**
     * Construct
     *
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * All
     *
     * @param  array  $with
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function all(array $with = array())
    {
        return $this->user->all($with);
    }

    /**
     * Find
     *
     * @param  int $id
     * @param  array  $with
     * @return Illuminate\Database\Eloquent\Model
     */
    public function find($id, array $with = array())
    {
        return $this->user->find($id, $with);
    }

    /**
     * Create
     *
     * @param  array  $data
     * @return boolean
     */
    public function create(array $data)
    {
        return $this->user->create($data);
    }

    /**
     * Update
     *
     * @param  array  $data
     * @return boolean
     */
    public function update(array $data)
    {
        return $this->user->update($data);
    }

    /**
     * Delete
     *
     * @param  int $id
     * @return boolean
     */
    public function delete($id)
    {
        return $this->user->delete($id);
    }

    /**
     * Search for many results by Key and Value
     *
     * @param  string $key
     * @param  mixed $value
     * @param  array  $with
     * @return Illuminate\Database\Query\Builders
     */
    public function getBy($key, $value, array $with = array())
    {
        return $this->user->getBy($key, $value, $with);
    }

    /**
     * Errors from validation
     *
     * @return Illuminate\Support\MeesageBag
     */
    public function errors()
    {
        return $this->user->errors;
    }
}