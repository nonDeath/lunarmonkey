<?php

use LunarMonkey\Presenters\Presenter;
use LunarMonkey\Presenters\UserPresenter;
use LunarMonkey\Repositories\User\UserRepository as User;

use DateTime;

class UsersController extends \BaseController {

	protected $user;

	protected $presenter;

	protected $datetime;

	public function __construct(User $user, Presenter $presenter)
	{
		$this->user      = $user;
		$this->presenter = $presenter;
		$this->datetime  = new DateTime;
	}

	/**
	 * Display a listing of the resource.
	 * GET /users
	 *
	 * @return Response
	 */
	public function index()
	{
		$page = Input::get('page', 1);

		$data = $this->user->getByPage($page, 15);

		$users = Paginator::make($data->items, $data->totalItems, 15);
		$users = $this->presenter->paginator($users, new UserPresenter);

		return View::make("users.index", compact("users"));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /users/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$roles = array();

		foreach (Role::all() as $role)
		{
			$roles[$role->id] = $role->description;
		}

		return View::make("users.create", compact("roles"));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /users
	 *
	 * @return Response
	 */
	public function store()
	{
		$activate_data = array(
			"activate" => 1,
			"activated_at" => $this->datetime->format("Y-m-d H:i:s")
		);

		$user = $this->user->create(array_merge(Input::all(), $activate_data));

		if($user)
		{
			return Redirect::route("users.index");
		}

		return Redirect::back()->withInput()->withErrors($this->user->errors());
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /users/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$roles = array();

		foreach (Role::all() as $role)
		{
			$roles[$role->id] = $role->description;
		}

		$user = $this->user->find($id);

		if($user)
		{
			return View::make("users.edit", compact("user", "roles"));
		}

		App::abort(404);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = $this->user->update(array_merge(['id' => $id], Input::all()));

		if($user)
		{
			return Redirect::route("users.index");
		}

		return Redirect::back()->withInput()->withErrors($this->user->errors());
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = $this->user->delete($id);

		if($user)
		{
			return Redirect::route("users.index");
		}

		App::abort(404);
	}

}