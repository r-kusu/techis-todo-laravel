<?php

namespace App\Policies;

use App\Models\User;
// まずuseでタスクモデルを使用できるようにし、destroyメソッドを追加します。
use App\Models\Task;
// タスクモデルは、タスクポリシーと紐づけることで有効にします。

use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * 指定されたユーザーのタスクのとき削除可能
     * 
     * @param User $user
     * @param Task $task
     * @return bool
     */
    public function destroy(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    }
}
