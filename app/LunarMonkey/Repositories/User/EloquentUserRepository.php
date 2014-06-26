<?php namespace LunarMonkey\Repositories\User;

use User;
use Illuminate\Events\Dispatcher;
use LunarMonkey\Repositories\Crudable;
use Illuminate\Support\MessageBag;
use LunarMonkey\Repositories\Paginable;
use LunarMonkey\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;
use LunarMonkey\Repositories\AbstractRepository;
use LunarMonkey\Repositories\User\Validators\UserCreateValidator;

class EloquentUserRepository extends AbstractRepository implements Repository, Crudable, Paginable, UserRepository {

    /**
     * @var Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * The events dispatcher
     *
     * @var Illuminate\Events\Dispatcher
     */
    protected $events;

    /**
     * Construct
     *
     * @param Illuminate\Database\Eloquent\Model $user
     */
    public function __construct(User $model, Dispatcher $events)
    {
        parent::__construct(new MessageBag);

        $this->model = $model;

        $this->events = $events;
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

        $password  = $data['password'];
        //$send_pass = isset($data['send_pass'])?1:0;
        $send_pass = 1;
        $activate  = $data['activate'];
        unset($data);

        if($this->isValid('create', $this->attributes))
        {
            $this->purgeUnneeded();
            $this->autoHash();

            $user = $this->model->create($this->attributes);

            if($user)
            {
                if($send_pass)
                {
                    $this->events->fire('user.welcome', [$user]);
                }

                if(! $activate)
                {
                    $this->events->fire('user.activation', [$user]);
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
        unset($data);

        if($this->isValid('update', $this->attributes))
        {
            $this->purgeUnneeded();
            $this->autoHash();

            $user = $this->find($this->attributes['id']);

            if(trim($this->attributes['password']) == '')
                unset($this->attributes['password']);

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
