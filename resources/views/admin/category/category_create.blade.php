
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

    <div class="page-container">
        <form action="" method="post" class="form form-horizontal" id="form-category-add">
            <div id="tab-category" class="HuiTab">

                <div class="tabCon">
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-3">
                            <span class="c-red">*</span>
                            上级分类：</label>
                        <div class="formControls col-xs-8 col-sm-9">
						<span class="select-box">
						<select class="select" id="sel_Sub" name="pid">

							<option value="0">顶级分类</option>
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
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-3">
                            <span class="c-red">*</span>
                            分类名称：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input type="text" class="input-text" value="" placeholder="请输入分类名称" id="" name="name">
                        </div>
                        <div class="col-3">
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-3">
                            <span class="c-red">*</span>
                            别名：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input type="text" class="input-text" value="" placeholder="请输入分类别名" id="" name="uname">
                        </div>
                        <div class="col-3">
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-3">
                            <span class="c-red">*</span>
                            类型：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input type="text" class="input-text" value="" placeholder="请输入分类类型" id="" name="sort">
                        </div>
                        <div class="col-3">
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-3">
                            <span class="c-red">*</span>
                            title：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input type="text" class="input-text" value="" placeholder="请输入分类标题" id="" name="title">
                        </div>
                        <div class="col-3">
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-3">
                            <span class="c-red">*</span>
                            keywords：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input type="text" class="input-text" value="" placeholder="请输入keywords，用于SEO" id="" name="keywords">
                        </div>
                        <div class="col-3">
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-3">
                            <span class="c-red">*</span>
                            description：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <input type="text" class="input-text" value="" placeholder="请输入description，用于SEO" id="" name="description">
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
            var path = '0,';
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
            $("#form-category-add").validate({
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
                            type:'get',
                            url:'{{url('admin/category/create')}}',
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