<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\User;
use App\Post;

class PostsController extends Controller
{
    public function index()
    {
        // Postテーブルからレコード情報を取得
        $list = Post::get();
        // bladeへ返す際にデータを送る
        return view('posts.index', ['list' => $list]);
    }

    // 投稿の登録処理
    public function postCreate(Request $request)
    {
        // バリデーションのルール
        $rules = [
            'newPost' => 'required|min:1|max:150',
        ];

        // バリデーションエラーメッセージ
        $messages = [
            'newPost.required' => '投稿内容は必須です。',
            'newPost.min' => '投稿内容は少なくとも1文字以上入力してください。',
            'newPost.max' => '投稿内容は150文字以内で入力してください。',
        ];

        // バリデーション実行
        $this->validate($request, $rules, $messages);

        // 投稿フォームに書かれた投稿を受け取る
        $post = $request->input('newPost');
        $user_id = Auth::user()->id;

        // 投稿の登録
        // postテーブルの'user_id','post'に変数を当てはめる
        Post::create([
            'user_id' => $user_id,
            'post' => $post
        ]);

        return redirect('/top');
    }

    // app/Http/Controllers/PostsController.php


    public function edit($id)
    {
        // 投稿の編集フォームを表示するためのデータを取得
        $post = Post::find($id);

        // 現在のユーザーがこの投稿の作成者であるか確認
        if (Auth::user()->id != $post->user_id) {
        return redirect('/top')->with('error', '他のユーザーの投稿は編集できません。');
        }

        return view('posts.edit', ['post' => $post]);
    }

    public function update(Request $request, $id)
    {
        // バリデーションのルール
        $rules = [
            'editedPost' => 'required|min:1|max:150',
        ];

        // バリデーションエラーメッセージ
        $messages = [
            'editedPost.required' => '投稿内容は必須です。',
            'editedPost.min' => '投稿内容は少なくとも1文字以上入力してください。',
            'editedPost.max' => '投稿内容は150文字以内で入力してください。',
        ];

        // バリデーション実行
        $this->validate($request, $rules, $messages);

        // 投稿の更新
        $post = Post::find($id);

        if (!$post) {
            return abort(404); // または適切なエラーページにリダイレクトなど
        }

        $post->post = $request->input('editedPost');
        $post->save();

        return redirect('/top')->with('success', '投稿が編集されました。');
    }

    public function destroy($id)
{
    // 投稿の削除処理
    $post = Post::find($id);

    if (!$post) {
        return redirect('/top')->with('error', '削除対象が見つかりません。');
    }

    // ログインユーザーが投稿の作成者であるか確認
    if (Auth::user()->id != $post->user_id) {
        return redirect('/top')->with('error', '他のユーザーの投稿は削除できません。');
    }

    // 投稿を削除
    $post->delete();

    return redirect('/top')->with('success', '投稿が削除されました。');
}


}
