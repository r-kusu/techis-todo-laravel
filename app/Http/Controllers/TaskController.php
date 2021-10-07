<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Task;

use App\Repositories\TaskRepository;

class TaskController extends Controller
{
    /**
     * タスクリポジトリ
     * 
     * @var TaskRepository
     */
    protected $tasks;

    /**
     * コンストラクタ
     * 
     * @return void
     */
    public function __construct(TaskRepository $tasks) // コンストラクタでタスクリポジトリを受け取れるよう、引数を設定します。
    {
        $this->middleware('auth');

        $this->tasks = $tasks;
    }
    // これは認証機能をタスクコントローラーで有効にするためのコードです。

    /**
     * タスク一覧
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        // $tasks = Task::orderBy('created_at', 'asc')->get();
        // $tasks = $request->user()->tasks()->get(); // $request、userメソッドにて認証済みのユーザーを取得しています。そのユーザーが保持するタスク一覧を取得、というコードです。
        return view('tasks.index', [
            // indexメソッドのタスク一覧取得処理をリポジトリで行うようにします。
            'tasks' => $this->tasks->forUser($request->user()),
        ]);
    }

    /**
     * タスク登録
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        // タスク作成
        // Task::create([
        //     'user_id' => 0,
        //     'name' => $request->name
        // ]);
        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);

        return redirect('/tasks');
    }

    /**
     * タスク削除
     *
     * @param Request $request
     * @param Task $task
     * @return Response
     */
    public function destroy(Request $request, Task $task)
    {
        $this->authorize('destroy', $task);
        // これでユーザー自身のタスクしかできないようになります。
        // ログインしたユーザーのみがこのアプリを使用できるようになりました。

        $task->delete();
        return redirect('/tasks');
    }
}
