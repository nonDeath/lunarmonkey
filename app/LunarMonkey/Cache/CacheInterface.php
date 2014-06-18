<?php namespace LunarMonkey\Cache;

interface CacheInterface {

    /**
     * Get
     *
     * @param  string $key
     * @return mixed
     */
    public function get($key);

    /**
     * Put
     *
     * @param  string $key
     * @param  mixed $value
     * @param  integer $minutes
     * @return mixed
     */
    public function put($key, $value, $minutes = null);

    /**
     * Has
     *
     * @param  string  $key
     * @return boolean
     */
    public function has($key);
}