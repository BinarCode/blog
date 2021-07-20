<?php

namespace App\Policies;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can use restify feature for each CRUD operation.
     * So if this is not allowed, all operations will be disabled
     * @param User $user
     * @return mixed
     */
    public function allowRestify(User $user = null)
    {
        //
    }

    /**
     * Determine whether the user can get the model.
     *
     * @param User $user
     * @param Blog $model
     * @return mixed
     */
    public function show(User $user, Blog $model)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return mixed
     */
    public function store(User $user)
    {
        //
    }

    /**
     * Determine whether the user can create multiple models at once.
     *
     * @param User $user
     * @return mixed
     */
    public function storeBulk(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Blog $model
     * @return mixed
     */
    public function update(User $user, Blog $model)
    {
        //
    }

    /**
     * Determine whether the user can update bulk the model.
     *
     * @param User $user
     * @param Blog $model
     * @return mixed
     */
    public function updateBulk(User $user, Blog $model)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Blog $model
     * @return mixed
     */
    public function delete(User $user, Blog $model)
    {
        //
    }
}
