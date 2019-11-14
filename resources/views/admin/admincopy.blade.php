
{{--//继承模版--}}

@extends('admin.layouts.adminpublic')

{{--//本页面样式--}}
@section('style')

@endsection

{{--//本页title--}}
@section('title','分类列表')

{{--//本页keywords--}}
@section('keywords','ckmmdkeywords')

{{--//本页description--}}
@section('description','ckmmddescription')

{{--//内容main_title--}}
@section('main_title','分类添加')

{{--//内容main_content--}}
@section('main_content','分类添加')



{{--//本页内容--}}
@section('main')
    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 分类管理 <span class="c-gray en">&gt;</span> 所有分类<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>

    <div class="pd-20">
        这是一个空白页
    </div>

@endsection

{{--//本页脚本--}}
@section('script')

@endsection