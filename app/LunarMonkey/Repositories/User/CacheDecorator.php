<?php namespace LunarMonkey\Repositories\User;

use LunarMonkey\Cache\CacheInterface;

class CacheDecorator extends AbstractUserDecorator implements UserRepository {

    /**
     * @var CacheInterface
     */
    protected $cache;

    /**
     * Construct
     *
     * @param UserRepository $user
     * @param CacheInterface $cache
     */
    public function __construct(UserRepository $user, CacheInterface $cache)
    {
        parent::__construct($user);
        $this->cache = $cache;
    }

    /**
     * All
     *
     * @param  array  $with
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function all(array $with = array())
    {
        $key = md5('all');

        if($this->cache->has($key))
        {
            return $this->cache->get($key);
        }

        $users = $this->user->all($with);

        $this->cache->put($key, $users);

        return $users;
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
        $key = md5('id.'.$id);

        if($this->cache->has($key))
        {
            return $this->cache->get($key);
        }

        $user = $this->user->find($id, $with);

        $this->cache->put($key, $user);

        return $user;
    }

    public function errors()
    {
        $key = md5('errors');

        if($this->cache->has($key))
        {
            return $this->cache->get($key);
        }

        $errors = $this->user->errors();

        $this->cache->put($key, $errors);

        return $errors;
    }

    public function getByPage($page = 1, $limit = 10)
    {
        $key = md5('page'.$page.'.'.$limit);

        if($this->cache->has($key))
        {
           return $this->cache->get($key);
        }

        $pagination = $this->user->getByPage($page, $limit);

        $this->cache->put($key, $pagination);

        return $pagination;
    }
}