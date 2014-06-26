<?php

class UserRepositoryTest extends TestCase {

  public function testEventsAreFired()
  {
    $repo = App::make('LunarMonkey\Repositories\User\UserRepository');

    $user = $repo->create([
      'username' => 'qwerty',
      'password' => 'password',
      'password_confirmation' => 'password',
      'email' => 'name@domain.com',
      'role_id' => 1,
      'activate' => null
    ]);
  }


}
