<?php

namespace App\Policies;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Contracts\Auth\Authenticatable;

class BlogPolicy
{
    use HandlesAuthorization;

    public function allowRestify(Authenticatable $user = null)
    {
        return true;
    }

    public function show(Authenticatable $user = null, Blog $model = null)
    {
        return true;
    }

    public function store(Authenticatable $user)
    {
        return true;
    }

    public function update(Authenticatable $user, Blog $model)
    {
        return $model->user_id === $user->id;
    }

    public function delete(Authenticatable $user, Blog $model)
    {
        return $model->user_id === $user->id;
    }
}
