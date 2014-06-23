<?php namespace LunarMonkey\Repositories\User;

use Hash;
use LunarMonkey\Repositories\Crudable;
use Illuminate\Support\MessageBag;
use LunarMonkey\Repositories\Paginable;
use LunarMonkey\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;
use LunarMonkey\Repositories\AbstractRepository;

class EloquentUserRepository extends AbstractRepository implements Repository, Crudable, Paginable, UserRepository {

    /**
     * @var Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Construct
     *
     * @param Illuminate\Database\Eloquent\Model $user
     */
    public function __construct(Model $model)
    {
        parent::__construct(new MessageBag);

        $this->model = $model;
    }

    /**
     * Create
     *
     * @param  array  $data
     * @return Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        $this->attributes = $data;

        $password  = $data["password"];
        $send_pass = isset($data["send_pass"])?1:0;
        $activate  = $data["activate"];
        unset($data);

        if($this->checkValidationRules('create', $this->attributes))
        {
            $this->purgeUnneeded();
            $this->autoHash();

            $user = $this->model->create($this->attributes);

            if($user)
            {
                if($send_pass)
                {
                    // Send Welcome and Password email
                }

                if(! $activate)
                {
                    // Send Activation email
                }
            }

            return $user;
        }
    }

    /**
     * Update
     *
     * @param  array  $data
     * @return Illuminate\Database\Eloquent\Model
     */
    public function update(array $data)
    {
        $this->attributes = $data;

        if($this->checkValidationRules('update', $this->attributes))
        {
            $this->purgeUnneeded();
            $this->autoHash();

            $user = $this->find($this->attributes['id']);

            $user->fill($this->attributes);
            $user->save();

            return $user;
        }
    }

    /**
     * Delete
     *
     * @param  int $id
     * @return boolean
     */
    public function delete($id)
    {
        $user = $this->find($id);

        if($user)
        {
            return $user->delete();
        }
    }
}