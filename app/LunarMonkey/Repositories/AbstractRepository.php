<?php namespace LunarMonkey\Repositories;


use StdClass;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Str;
use LunarMonkey\Validation\Validable;

abstract class AbstractRepository {

    /**
     * @var Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * @var Illuminate\Support\MessageBag
     */
    protected $errors;

    /**
     * @var array
     */
    protected $attributes;

    /**
     * Purgeable elements
     *
     * @var array
     */
    protected static $purgeable = array();

    /**
     * Construct
     *
     * @param Illuminate\Support\MessageBag $errors
     */
    public function __construct(MessageBag $errors)
    {
        $this->errors = $errors;
    }

    /**
     * Make a instance of the entity to query on
     *
     * @param  array  $with
     */
    public function make(array $with = array())
    {
        return $this->model->with($with);
    }

    /**
     * Register Validators
     *
     * @param  string $name
     * @param  Validable $validator
     */
    public function registerValidator($name, $validator)
    {
        $this->validators[$name] = $validator;
    }

    /**
     * Check to see if the input data is valid
     *
     * @param  string  $name
     * @param  array   $data
     * @return boolean
     */
    public function checkValidationRules($name, array $data)
    {
        if($this->validators[$name]->with($data)->passes())
        {
            return true;
        }

        $this->errors = $this->validators[$name]->errors();
        return false;
    }

    /**
     * Retrieve all entities
     *
     * @param  array  $with
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function all(array $with = array())
    {
        $entity = $this->make($with);

        return $entity->get();
    }

    /**
     * Find a single entity
     *
     * @param  int $id
     * @param  array  $with
     * @return Illuminate\Database\Eloquent\Model
     */
    public function find($id, array $with = array())
    {
        $entity = $this->make($with);

        return $entity->find($id);
    }

    /**
     * Get results by page
     *
     * @param  integer $page
     * @param  integer $limit
     * @param  array   $with
     * @return StdClass Object with $items and $totalItems for pagination
     */
    public function getByPage($page = 1, $limit = 10, array $with = array())
    {
        $result             = new StdClass;
        $result->page       = $page;
        $result->limit      = $limit;
        $result->totalItems = 0;
        $result->items      = array();

        $query = $this->make($with);

        $users = $query->skip($limit * ($page - 1))
                        ->take($limit)
                        ->get();

        $result->totalItems = $this->model->count();
        $result->items      = $users->all();

        return $result;
    }

    /**
     * Search for many results by key and value
     *
     * @param  string $key
     * @param  mixed $value
     * @param  array  $with
     * @return Illuminate\Database\Query\Builders
     */
    public function getManyBy($key, $value, array $with = array())
    {
        return $this->make($with)->where($key, '=', $value)->get();
    }

    /**
     * Search a single result by key and value
     *
     * @param  string $key
     * @param  mixed $value
     * @param  array  $with
     * @return Illuminate\Database\Query\Builders
     */
    public function getFirstBy($key, $value, array $with = array())
    {
        return $this->make($with)->where($key, '=', $value)->first();
    }

    /**
     * Return the errors
     *
     * @return Illuminate\Support\MeesageBag
     */
    public function errors()
    {
        return $this->errors;
    }

    /**
     * Purge Unneeded elemntes
     *
     * @return void
     */
    protected function purgeUnneeded()
    {
        $clean = array();
        foreach ($this->attributes as $key => $value)
        {
            if (! Str::endsWith($key, '_confirmation') && ! Str::startsWith($key, '_') && ! in_array($key, static::$purgeable) && trim($value) != '')
                $clean[$key] = $value;
        }
        $this->attributes = $clean;
    }

    /**
     * Autohash password
     *
     * @return void
     */
    protected function autoHash()
    {
        if (isset($this->attributes['password']))
        {
            if ($this->attributes['password'] != $this->model->getOriginal('password'))
                $this->attributes['password'] = Hash::make($this->attributes['password']);
        }
    }
}