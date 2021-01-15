<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Http\Requests\BlogRequest;

class BlogController extends Controller
{
    //ブログ一覧表示
    public function showList(){
        $blogs = Blog::all();
        
        return view('blog.list',['blogs' => $blogs]);
    }
    //ブログ詳細表示
    public function showDetail($id){
        $blog = Blog::find($id);
        
        if(is_null($blog)){
            \Session::flash('err_msg','データがありません');
            return redirect(route('blogs'));
        }
        return view('blog.detail',['blog' => $blog]);
    }
    //ブログ登録画面を表示
    public function showCreate(){
        return view('blog.form');
    }
    //ブログ登録
    public function exeStore(BlogRequest $request){

        //ブログのデータを受け取る
        $inputs = $request ->all();
        \DB::beginTransaction();
        try{
            //ブログを登録
            Blog::create($inputs);
            \DB::commit();
        }catch(\Throwable $e){
            \DB::rollback();
            abort(500);

        }
        
        

        \Session::flash('err_msg','ブログを登しました');
            return redirect(route('blogs'));
       
    }
    //ブログ編集画面表示
    public function showEdit($id){
        $blog = Blog::find($id);
        
        if(is_null($blog)){
            \Session::flash('err_msg','データがありません');
            return redirect(route('blogs'));
        }
        return view('blog.edit',['blog' => $blog]);
    }

    //ブログ更新
    public function exeUpdate(Request $request){

        //ブログのデータを受け取る
        $inputs = $request ->all();
        
        \DB::beginTransaction();

        try{
            //ブログを更新
            $blog = Blog::find($inputs['id']);
            $blog->fill([
                'title' => $inputs['title'],
                'content' => $inputs['content'],
            ]);
            $blog->save();
            \DB::commit();
        }catch(\Throwable $e){
            \DB::rollback();
            abort(500);

        }
        
        

        \Session::flash('err_msg','ブログを更新しました');
            return redirect(route('blogs'));
    
    }

}
