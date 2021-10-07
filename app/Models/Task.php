<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['name']; // 「['user_id', 'name']」の「user_id」は、14行目からの紐づけのコードを書いたため、不明になった

    /**
     * タスクを保持するユーザーの取得
     */
    public function user()
    {
        return $this->belongsTo(User::class); // これでタスクモデルからユーザーのデータを取得することができます。
    }

}
