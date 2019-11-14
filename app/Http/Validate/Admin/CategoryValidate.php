<?php

namespace App\Http\Validate\Admin;



class CategoryValidate extends CommonValidate
{


    public $rule = [
        'pid' => 'required',
        'name' => 'required|max:50',
        'uname' => 'required|max:50',
        'sort' => 'required|max:50',

    ];


    public $message = [
        'pid.required' => '上级分类不能为空，谢谢！',
        'name.required' => 'name不能为空，谢谢！',
        'name.max' => 'name过长，名称允许设置在6 —— 50个字符之间！',
        'uname.required' => 'uname不能为空，谢谢！',
        'uname.max' => 'uname过长，名称允许设置在6 —— 50个字符之间！',
        'sort.required' => 'sort不能为空，谢谢！',
        'sort.max' => 'sort过长，名称允许设置在6 —— 50个字符之间！',

    ];


}