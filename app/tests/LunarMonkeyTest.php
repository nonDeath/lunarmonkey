<?php

use LunarMonkey\Presenters\Presenter;
use LunarMonkey\Presenters\UserPresenter;
use LunarMonkey\Repositories\User\UserRepository as User;

use \DateTime;

class LunarMonkeyTest extends TestCase {

	private $user;

	public function setUp()
	{
		parent::setUp();
		$this->prepareForTests();
	}

	public function createApplication()
	{
		$unitTesting = true;

		$testEnvironment = 'testing';

		return require __DIR__. '/../../bootstrap/start.php';
	}

	/**
	 * Testing for an empty user.
	 *
	 * @return void
	 */
	public function testUserIsNotInstatiated()
	{
		$this->assertTrue($this->user===null);
	}

	/**
	 * [testUserIsInstantiated description]
	 * Testing for a created user from repository service provider
	 * @return void
	 */
	public function testUserIsInstantiated()
	{
		$this->user = App::make('LunarMonkey\Repositories\User\UserRepository');

		$this->assertInstanceOf('LunarMonkey\Repositories\User\UserRepository', $this->user);
	}

	/**
     * @expectedException ErrorException
     */
	public function testCreateUserWithoutDataAndFail()
	{
		$this->user = App::make('LunarMonkey\Repositories\User\UserRepository');

		$result = $this->user->create([]);

		$this->assertNull($result);
	}

	public function testCreateUserWithCorrectData()
	{
		$this->user = App::make('LunarMonkey\Repositories\User\UserRepository');

		$result = $this->user->create([

			"username" => "userTest",
			"password" => "1234567",
			"password_confirmation" => "1234567",
			"email" => "test_user@test.com",
			"first_name" => "user",
			"last_name" => "test",
			"description" => "the data to be passed",
			"url" => "www.some-domain.com",
			"fb_profile" => "",
			"tw_profile" => "",
			"gp_profile" => "",
			"gravatar_email" => "test_user@test.com",
			"activate" => false,
			"activated_at" => DateTime::createFromFormat("Y-m-d H:i:s", '2009-02-15 10:35:54'),
			"activation_code" => "",
			"reset_password_code" => "",
			"role_id" => 1,
			"last_login" => null
		]);

		$this->assertEquals($result->username, "userTest");
	}

	private function prepareForTests()
	{
		Artisan::call('migrate');
	}
}
