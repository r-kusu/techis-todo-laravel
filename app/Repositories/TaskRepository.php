<?php
// Repositoriesフォルダは、保守性を高める為に作成しております。
// タスク一覧を取得するコードを記述します。
namespace App\Repositories;

use App\Models\User;

// 以下データアクセスに関するコード
class TaskRepository
{
    /**
     * ユーザーのタスク一覧取得
     * 
     * @param User $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return $user->tasks()
            ->orderBy('created_at', 'asc')
            ->get();
    }
}