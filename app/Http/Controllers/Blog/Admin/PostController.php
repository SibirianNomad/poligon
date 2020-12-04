<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\BlogPostAfterCreateJob;
use App\Jobs\BlogPostAfterDeleteJob;
use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Repositories\BlogPostRepository;
use App\Repositories\BlogCategoryRepository;
use App\Http\Requests\BlogPostUpdateRequest;
use App\Http\Requests\BlogPostCreateRequest;

class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $blogPostRepository;

    private $blogCategoryRepository;

    public function __construct(){
        parent::__construct();
        $this->blogPostRepository = app(BlogPostRepository::class);
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }


    public function index()
    {
        $paginator=$this->blogPostRepository->getAllWithPaginate();
        return view('blog.admin.posts.index',compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item=new BlogPost();

        $categoryList=$this->blogCategoryRepository->getComboBox();

        return view('blog.admin.posts.edit',compact('item','categoryList'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogPostCreateRequest $request)
    {
        $data=$request->input();
        $item=(new BlogPost())->create($data);
        if($item){

            $job=new BlogPostAfterCreateJob($item);
            $this->dispatch($job);

            return redirect()
                ->route('blog.admin.posts.edit', $item->id)
                ->with(['success'=>'Успешно сохранено']);
        }else{
            return back()->withErrors(['msg'=>"Ошибка сохранения"])->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item=$this->blogPostRepository->getEdit($id);
        if(empty($item)){
            abort(404);
        }
        $categoryList=$this->blogCategoryRepository->getComboBox();
        return view('blog.admin.posts.edit',
            compact('item','categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogPostUpdateRequest $request, $id)
    {

        $item=$this->blogPostRepository->getEdit($id);
        if(empty($item)){
            return back()->withErrors(['msg'=>"Запись id[{$id}] не найдена"])->withInput();
        }

        $data=$request->all();


        $result=$item->update($data);
        if($result){
            return redirect()
                ->route('blog.admin.posts.edit', $item->id)
                ->with(['success'=>'Успешно сохранено']);
        }else{
            return back()->withErrors(['msg'=>"Ошибка сохранения"])->withInput();
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result=BlogPost::destroy($id);

        if($result){

            BlogPostAfterDeleteJob::dispatch($id)->delay(20);

            //Варианты запуска
//            BlogPostAfterDeleteJob::dispatchNow($id);
            //через helper
           // dispatch(new BlogPostAfterDeleteJob($id));
            // dispatch_now(new BlogPostAfterDeleteJob($id));


            return redirect()
                ->route('blog.admin.posts.index')
                ->with(['success'=>"Запись $id успешно удалена"]);
        }else{
            return back()->withErrors(['msg'=>"Ошибка сохранения"])->withInput();
        }
    }
}
