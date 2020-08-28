<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategories;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Http\Requests\BlogCategoryEditRequest;
use App\Repositories\BlogCategoryRepository;
use Illuminate\Support\Str;

class CategoryController extends BaseController
{
    protected $blogCategoryRepository;

    public function __construct(){
        parent::__construct();
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$paginate=BlogCategories::paginate(5);
        $paginate=$this->blogCategoryRepository->getAllWithPaginate(5);

        return view('blog.admin.categories.index',compact('paginate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $item=new BlogCategories();
       $categoryList=$this->blogCategoryRepository->getComboBox();
       return view('blog.admin.categories.edit',compact('item','categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCategoryEditRequest $request)
    {
       $data=$request->input();
       if(empty($data['slug'])){
        $data['slug']=Str::slug($data['title']);
       }
       //create object but not save in DB
    //    $item=new BlogCategories($data);
    //    $item->save();
    //create object and save in DB
    $item=(new BlogCategories())->create($data);
    if($item){
        return redirect()
            ->route('blog.admin.categories.edit', $item->id)
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


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, BlogCategoryRepository $categoryList)
    {
        //without repository
        //$item=BlogCategories::findOrFail($id);
        //$categoryList=BlogCategories::all();
       
        //with repository
        $item=$categoryList->getEdit($id);
        if(empty($item)){
            abort(404);
        }
        $categoryList=$categoryList->getComboBox();


        return view('blog.admin.categories.edit',compact('item','categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {
        //все rules вынесены в request
        // $rules=[
        //     'title'          => 'required|min:5|max:200',
        //     'slug'           => 'max:208',
        //     'description'    => 'string|min:3|max:500',
        //     'parent_id'      => 'required|integer|exists:blog_categories,id'
        // ];

        //$validatedData=$this->validate($request,$rules);
        // $validatedData=$request->validate($rules);


        $item=BlogCategories::find($id);
       
        if(empty($item)){
            return back()->withErrors(['msg'=>"Запись id[{$id}] не найдена"])->withInput();
        }

        $data=$request->all();
        if(empty($data['slug'])){
            $data['slug']=Str::slug($data['title']);
           }
        //$result=$item->fill($data)->save();
        $result=$item->update($data);
        if($result){
            return redirect()
            ->route('blog.admin.categories.edit', $item->id)
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

}