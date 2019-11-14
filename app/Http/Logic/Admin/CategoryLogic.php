<?php

namespace App\Http\Logic\Admin;

use App\Http\Validate\Admin\CategoryValidate as Validate;

use App\Http\Model\Admin\Category as Model;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoryLogic extends CommonLogic
{
    //

    protected $validate;

    protected $model;

    public function __construct()
    {
        $this->validate = new Validate();
        $this->model = new Model();

    }
    public function createCategory($category){

        try{
            $validator = Validator::make($category,$this->validate->rule,$this->validate->message);
            if ($validator->fails()){
                return ['status'=>false,'message'=>($validator->errors())->all(),'data'=>$category];
            }
        }catch (\Exception $exception){

            return ['status'=>false,'message'=>$exception->getMessage(),'data'=>$category];
        }
        try{
            $categoryName = $this->model->where('name','=',$category['name'])->get();
        }catch (\Exception $exception){
            DB::connection()->enableQueryLog();
            return ['status'=>false,'message'=>$exception->getMessage(),'date'=>DB::getQueryLog()];
        }
        if ($categoryName->toArray()!==[]){
            return ['status'=>false,'message'=>'该分类名已经存在，请重新输入','data'=>$category['name']];
        };
        try{
            $this->model->pid = $category['pid'];
            $this->model->name = $category['name'];
            $this->model->uname = $category['uname'];
            $this->model->status = 0;
            $this->model->path = $category['path'];
            $this->model->sort = $category['sort'];
            $this->model->title = $category['title'];
            $this->model->keywords = $category['keywords'];
            $this->model->description = $category['description'];
            $this->model->order = 0;
            return ['status'=>true,'message'=>'保存成功','data'=>$this->model->save()];
        }catch (\Exception $exception){
            DB::connection()->enableQueryLog();
            return ['status'=>false,'message'=>$exception->getMessage(),'data'=>DB::getQueryLog()];
        }


    }
    public function updateCategory($category){

        try{
            $validator = Validator::make($category,$this->validate->rule,$this->validate->message);
            if ($validator->fails()){
                return ['status'=>false,'message'=>($validator->errors())->all(),'data'=>$category];
            }
        }catch (\Exception $exception){

            return ['status'=>false,'message'=>$exception->getMessage(),'data'=>$category];
        }
        try{
            $categoryName = $this->model->where('name','=',$category['name'])->get();
        }catch (\Exception $exception){
            DB::connection()->enableQueryLog();
            return ['status'=>false,'message'=>$exception->getMessage(),'date'=>DB::getQueryLog()];
        }
        if ($categoryName->toArray()!==[] && $this->model->where('id',$category['id'])->first()->name!==$category['name']){
            return ['status'=>false,'message'=>'该分类名已经存在，请重新输入','data'=>$category['name']];
        };
        try{
            return ['status'=>true,
                    'message'=>'更新成功',
                    'data'=>$this->model
                    ->where('id',$category['id'])
                    ->update([
                        'name'=>$category['name'],
                        'pid'=>$category['pid'],
                        'uname'=>$category['uname'],
                        'path'=>$category['path'],
                        'sort'=>$category['sort'],
                        'title'=>$category['title'],
                        'keywords'=>$category['keywords'],
                        'description'=>$category['description'],
                        'status'=>1,
                        'order'=>0,
                    ])];
        }catch (\Exception $exception){
            DB::connection()->enableQueryLog();
            return ['status'=>false,'message'=>$exception->getMessage(),'data'=>DB::getQueryLog()];
        }


    }
    public function getCategoryById($id){
        try{
            return ['status'=>true,
                    'message'=>'数据库无异常',
                    'data'=>$this->model
                        ->where([
                            ['id','=',$id],
                            ['status','!=',2]
                        ])->first()];
        }catch (\Exception $exception){
            DB::connection()->enableQueryLog();
            return ['status'=>false,'message'=>$exception->getMessage(),'data'=>DB::getQueryLog()];
        }

    }
    public function getCategoryBySearch($search){
        try{
            return ['status'=>true,
                'message'=>'数据库无异常',
                'data'=>$this->model
                    ->where([
                        ['id','=',$search],
                        ['status','!=',2]])
                    ->orWhere([
                        ['name','=',$search],
                        ['status','!=',2]])
                    ->get()];
        }catch (\Exception $exception){
            DB::connection()->enableQueryLog();
            return ['status'=>false,'message'=>$exception->getMessage(),'data'=>DB::getQueryLog()];
        }

    }
    public function getCategoryParentById($id){
        try{
            return ['status'=>false,
                    'message'=>'数据库无异常',
                    'data'=>$this->model
                        ->where([
                            ['id','=',$id],
                            ['status','!=',2]
                        ])->first()];
        }catch (\Exception $exception){
            DB::connection()->enableQueryLog();
            return ['status'=>false,'message'=>$exception->getMessage(),'data'=>DB::getQueryLog()];
        }
    }
    public function getCategoryList(){

        try{
            return ['status'=>false,
                    'message'=>'数据库无异常',
                    'data'=>$this->model
                        ->where('status','!=',2)
                        ->orderByRaw('concat(path,id)','desc')
                        ->get()];
        }catch (\Exception $exception){
            DB::connection()->enableQueryLog();
            return ['status'=>false,'message'=>$exception->getMessage(),'data'=>DB::getQueryLog()];
        }
    }
    public function statusCategory($data){


        if (in_array($data->status,[-1,0,1,2]) == false){
            return ['status'=>false,'message'=>'非法的状态','data'=>$data->status];
        }
        $category = $this->getCategoryById($data->id);
        if ($category['status'] == false || $category['data'] == null){
            return ['status'=>false,'message'=>'非法的ID','data'=>$data->id];
        }
        try{
            if ($data->status == -1) {
                $parent_up = $this->model
                                ->Where('id',$data->id)
                                ->update(['status'=>0]);
            }else{
                $parent_up = $this->model
                                ->Where('id',$data->id)
                                ->update(['status'=>$data->status]);
            }
            $son_up = $this->model
                            ->where('path','like','%'.$data->path.$data->id.'%')
                            ->update(['status'=>$data->status]);
            $new_categorys = $this->model
                            ->where('status','!=',2)
                            ->orderByRaw('concat(path,id)','desc')
                            ->get();
            if ($parent_up && $new_categorys) {
                return ['status' => true,
                        'message' => '修改成功',
                        'data' => [$parent_up,$son_up,$new_categorys],
                        ];
            }else{
                return ['status' => false,
                        'message' => '未知错误',
                        'data' => [$parent_up,$son_up,$new_categorys],
                        ];
            }
        }catch (\Exception $exception){
            DB::connection()->enableQueryLog();
            return ['status'=>false,'message'=>$exception->getMessage(),'data'=>DB::getQueryLog()];
        }
    }


}
