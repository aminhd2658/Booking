<?php

namespace App\Services;

use App\Interfaces\ModelInterface;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;

class CommentService implements ModelInterface
{


    public function create(array $data)
    {
        $stay = $data['stay'];
        $user = $data['user'];
        return $user->comments()->create([
            'stay_id' => $stay->id,
            'star' => $data['star'],
            'content' => $data['content'],
            'status' => Comment::PENDING,
        ]);

    }

    public function update(Model $model, array $data)
    {
        return $model->update($data);
    }


    public function delete(Model $model)
    {
        return $model->delete();
    }


}
