<?php

class Role extends \Eloquent {

    protected $table = "roles";

	protected $fillable = ["name", "description", "level"];

    public function users()
    {
        return $this->hasMany("User");
    }
}