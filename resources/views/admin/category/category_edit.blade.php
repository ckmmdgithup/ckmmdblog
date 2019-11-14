
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
@section('main_title','分类编辑')

{{--//内容main_content--}}
@section('main_content','分类编辑')



{{--//本页内容--}}
@section('main')

    <div class="page-container">
        <form action="" method="post" class="form form-horizontal" id="form-category-update">
            <div id="tab-category" class="HuiTab">

                <div class="tabCon">
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-3">
                            <span class="c-red">*</span>
                            上级分类：</label>
                        <div class="formControls col-xs-8 col-sm-9">
						<span class="select-box">
						<select class="select" id="sel_Sub" name="pid">
                            @if($categoryParent==null)
							    <option code-data="0," selected value="0">顶级分类</option>
                            @else
                                @php
                                    $arr = explode(',',$category->path);
                                    $num =count($arr)-3;
                                @endphp
                                <option code-data="0,"  selected value="0">顶级分类</option>
                                <option id='del' code-data="{{$category->path}}" selected value="{{$categoryParent->id}}">{{str_repeat('|--',$num)}}{{$categoryParent->name}}</option>

                            @endif
                            @foreach($categorys as $vo)
                                @php
                                    $arr = explode(',',$vo->path);
                                    $num =count($arr)-2;
                                @endphp
							<option code-data="{{$vo->path}}{{$vo->id}}," value="{{$vo->id}}">{{str_repeat('|--',$num)}}{{$vo->name}}</option>
							@endforeach
						</select>
						</span>
                        </div>
                        <div class="col-3">
                        </div>
                    </div>
                    <div style="display:none" class="row cl">
                        <label class="form-label col-xs-4 col-sm-3">
                            <span class="c-red">*</span>
                            ID：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input type="text" class="input-text" value="{{$category->id}}" placeholder="" id="" name="id">
                        </div>
                        <div class="col-3">
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-3">
                            <span class="c-red">*</span>
                            分类名称：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input type="text" class="input-text" value="{{$category->name}}" placeholder="" id="" name="name">
                        </div>
                        <div class="col-3">
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-3">
                            <span class="c-red">*</span>
                            别名：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input type="text" class="input-text" value="{{$category->uname}}" placeholder="" id="" name="uname">
                        </div>
                        <div class="col-3">
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-3">
                            <span class="c-red">*</span>
                            类型：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input type="text" class="input-text" value="{{$category->sort}}" placeholder="" id="" name="sort">
                        </div>
                        <div class="col-3">
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-3">
                            <span class="c-red">*</span>
                            title：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input type="text" class="input-text" value="{{$category->title}}" placeholder="" id="" name="title">
                        </div>
                        <div class="col-3">
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-3">
                            <span class="c-red">*</span>
                            keywords：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input type="text" class="input-text" value="{{$category->keywords}}" placeholder="" id="" name="keywords">
                        </div>
                        <div class="col-3">
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-3">
                            <span class="c-red">*</span>
                            description：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input type="text" class="input-text" value="{{$category->description}}" placeholder="" id="" name="description">
                        </div>
                        <div class="col-3">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row cl">
                <div class="col-8 col-offset-4">
                    <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
                </div>
            </div>
        </form>
    </div>

@endsection

{{--//本页脚本--}}
@section('script')
    <script type="text/javascript" src="{{asset('/admin/lib/My97DatePicker/4.8/WdatePicker.js')}}"></script>
    <script type="text/javascript" src="{{asset('/admin/lib/jquery.validation/1.14.0/jquery.validate.js')}}"></script>
    <script type="text/javascript" src="{{asset('/admin/lib/jquery.validation/1.14.0/validate-methods.js')}}"></script>
    <script type="text/javascript" src="{{asset('/admin/lib/jquery.validation/1.14.0/messages_zh.js')}}"></script>
    <script type="text/javascript">
        $(function(){
            var path = $('#sel_Sub').find('option:selected').attr('code-data');
            $('#sel_Sub').bind('click',function () {
                $('#del').remove()
            })
            $('#sel_Sub').bind('change',function () {
                path = $(this).find('option:selected').attr('code-data');
            })

            $('.skin-minimal input').iCheck({
                checkboxClass: 'icheckbox-blue',
                radioClass: 'iradio-blue',
                increaseArea: '20%'
            });

            $("#tab-category").Huitab({
                index:0
            });
            $("#form-category-update").validate({
                rules:{
                    pid:{
                        required:true,
                    },
                    name:{
                        required:true,
                        maxlength:18
                    },
                    uname:{
                        required:true,
                        maxlength:18
                    },
                    sort:{
                        required:true,
                        maxlength:18
                    },
                },
                onkeyup:false,
                focusCleanup:true,
                success:"valid",
                submitHandler:function(form){
                    $(form).ajaxSubmit(
                        {
                            type:'put',
                            url:'/admin/category/update',
                            data:{
                                '_token':'{{csrf_token()}}',
                                'path':path
                            },
                            success: function (result) {

                                    if (result['status'] == true){
                                        layer.open({
                                            type: 0,
                                            title:'成功',
                                            content:result['message'],
                                            icon:6,
                                            yes:function () {
                                               window.location.reload();

                                            }
                                        })
                                    }else {
                                        layer.open({
                                            type: 0,
                                            title:'失败',
                                            content:result['message'],
                                            icon:5,
                                        })
                                    }
                            }
                        }


                    );

                }
            });
        });
    </script>
@endsection