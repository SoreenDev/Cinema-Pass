<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = QueryBuilder::for(User::class)
            ->get();

        return $this->successResponseWithAdditional(
            UserResource::collection($users),
            'All users'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return $this->successResponse(
            UserResource::make($user),
            'Successful find user'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, User $user)
    {
        $user->update($request->validated());

        if ( $request->profile ) {
            $user->clearMediaCollection('profile');
            $user->addMediaFromRequest('profile')
                ->setFileName($user->user_name)
                ->toMediaCollection('profile');
        }
        return $this->successResponse(
            UserResource::make($user),
            'Successful update user'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return $this->successResponse(message: 'Successful delete user');
    }
}
