<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Contracts\Auth\Authenticatable;

class CommentPolicy
{
    use HandlesAuthorization;

    public function allowRestify(Authenticatable $user = null)
    {
        return true;
    }

    public function show(Authenticatable $user, Comment $model)
    {
        return true;
    }

    public function store(Authenticatable $user)
    {
        return true;
    }

    public function update(Authenticatable $user, Comment $model)
    {
        return false;
    }

    public function delete(Authenticatable $user, Comment $model)
    {
        return $model->user_id === $user->id;
    }
}
