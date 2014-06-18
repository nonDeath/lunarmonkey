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
        if($this->checkValidationRules('create', $data))
        {
            $password = $data['password'];

            $data = $this->autoHash($data);
            $data = $this->purgeUnneeded($data);

            return $this->model->create($data);

            if($data["send_pass"])
            {
                // Send welcome email and password
            }
            if(! $data["activated"])
            {
                // ... send Activation Code Email
                // example: Register
            }
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
        $b = true;
        if(isset($data['password']) && !empty($data['password']))
        {
            $b = $this->checkValidationRules('update_password', $data);
            $data['password'] = Hash::make($data['password']);
        }

        if($this->checkValidationRules('update', $data) && $b)
        {
            $user = $this->find($data['id']);
            $user->username = $data['username'];
            $user->email = $data['email'];

            if(isset($data['password']) && !empty($data['password']))
            {
                $user->password = $data['password'];
            }
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