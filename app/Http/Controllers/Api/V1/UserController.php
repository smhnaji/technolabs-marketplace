<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->responseSuccess(User::paginate(3), 'Users retrieved successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $user = User::create($request->validated());

        return $this->responseSuccess($user, 'User created successfully', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return $this->responseSuccess(auth()->user(), 'Data retrieved successfully.');
    }

    /**
     * User update function
     *
     * @param UserUpdateRequest $request
     * @return string
     */
    public function update(UserUpdateRequest $request)
    {
        $user = auth()->user();
        $user->update($request->validated());

        if (count($request->validated())) {
            return $this->responseSuccess($user, 'User updated sucessfully.');
        } else {
            return $this->responseFailure([], 'User update failed.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
