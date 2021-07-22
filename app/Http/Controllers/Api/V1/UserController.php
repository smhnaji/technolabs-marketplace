<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return $this->responseSuccess(Auth::user(), 'Data retrieved successfully.');
    }

    /**
     * User update function
     *
     * @param UserUpdateRequest $request
     * @return string
     */
    public function update(UserUpdateRequest $request)
    {
        $user = Auth::user();
        $user->update($request->validated());

        if (count($request->validated())) {
            return $this->responseSuccess([], 'User updated sucessfully.');
        } else {
            return $this->responseFailure([], 'User updated sucessfully.');
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
