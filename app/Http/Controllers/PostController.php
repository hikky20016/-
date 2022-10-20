<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    //
    public function index(Post $post)//インポートしたPostをインスタンス化して$postとして使用。
{
    return view('posts/index')->with(['posts' => $post->getPaginateByLimit()]);

}

public function show(Post $post)
{
    return view('posts/show')->with(['post' => $post]);
 //'post'はbladeファイルで使う変数。中身は$postはid=1のPostインスタンス。
}

public function create()
{
    return view('posts/create');
}

 public function store(Post $post, PostRequest $request) // 引数をRequestからPostRequestにする
    {
        $input = $request['post'];
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }

public function edit(Post $post)
{
    return view('posts/edit')->with(['post' => $post]);
}

public function update(PostRequest $request, Post $post)
{
    $input_post = $request['post'];
    $post->fill($input_post)->save();

    return redirect('/posts/' . $post->id);
}

}

//use宣言は外部にあるクラスをPostController内にインポートできる。
//この場合、App\Models内のPostクラスをインポートしている。

/**
 * Post一覧を表示する
 * 
 * @param Post Postモデル
 * @return array Postモデルリスト
 */
