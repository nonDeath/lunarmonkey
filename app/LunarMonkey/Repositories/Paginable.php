<?php namespace LunarMonkey\Repositories;

interface Paginable {

    /**
     * Get results by page
     *
     * @param  integer $page
     * @param  integer $limit
     * @param  array   $with
     * @return StdClass Object with $items and $totalItems for pagination
     */
    public function getByPage($page = 1, $limit = 10, array $with = array());
}