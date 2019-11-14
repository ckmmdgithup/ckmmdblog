<?php

namespace App\Http\Controllers\Admin;


use App\Http\Logic\Admin\CategoryLogic as Logic;
use Illuminate\Http\Request;



class CategoryController extends CommonController
{
    //



    protected $logic;
    protected $categorys;
    public function __construct()
    {
        $this->logic = new Logic();
        $this->categorys = $this->logic->getCategoryList();

    }

    public function index(){

        return view('admin.category.category_list')->with('categorys',$this->categorys['data']);

    }

    public function create(Request $request){

        if ($request->input()){

            $input = $request->input();
            $result = $this->logic->createCategory($input);

            return $result;

        }else {

            return view('admin.category.category_create')->with('categorys',$this->categorys['data']);
        }
    }

    public function edit($id)
    {

        $category = $this->logic->getCategoryById($id);
        $categoryParent = $this->logic->getCategoryParentById($category['data']->pid);
        //dd($categoryParent['data']->name);
        if ($category){
        return view('admin.category.category_edit')
            ->with([
                'categorys'=>$this->categorys['data'],
                'category'=>$category['data'],
                'categoryParent'=>$categoryParent['data']
            ]);
        }else{
            return  view('404');
        }
    }
    public function update(Request $request){
        $input = $request->input();
        $result = $this->logic->updateCategory($input);
        return $result;
    }

    public function search(Request $request){

        $result =$this->logic->getCategoryBySearch($request->data);
        if ($result['status']==true){
            $view = view('admin.category.category_status')->with('categorys',$result['data']);
            return $view;
        }else{
            return  view('404');
        }
    }
    public function editEnd($id){
        $view = view('admin.category.category_edit_end')->with('category',$this->logic->getCategoryById($id)['data']);
        return $view;
    }
    public function status(Request $request)
    {
        $result =$this->logic->statusCategory($request);
        if ($result['status']==true){
            //return $result;
            $view = view('admin.category.category_status')->with('categorys',$result['data'][2]);
            return $view;
        }else
        {
            return  view('404');
        }
    }

}
