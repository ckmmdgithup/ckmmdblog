
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
    <div id="tete"></div>
    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 分类管理 <span class="c-gray en">&gt;</span> 所有分类<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>

    <div class="page-container">
        <div class="text-c">
            <input type="text" name="" id="category_search" placeholder="分类名称、id" style="width:250px" class="input-text">
            <button href="javascript:;" onclick="system_category_search()" name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
        </div>
        <div class="cl pd-5 bg-1 bk-gray mt-20">
		<span class="l">
		<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
		<a class="btn btn-primary radius" onclick="system_category_add('添加分类','{{url('admin/category/create')}}')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加分类</a>
		</span>
        </div>
        <div class="mt-20">

            <table class="table table-border table-bordered table-hover table-bg table-sort">
                <thead>
                <tr class="text-c">
                    <th width="25"><input type="checkbox" name="" value=""></th>
                    <th width="40">ID</th>
                    <th width="80">排序</th>

                    <th width="300">分类名称</th>
                    <th width="160">生成时间</th>
                    <th width="160">最后更新时间</th>
                    <th width="80">状态</th>
                    <th width="100">操作</th>
                </tr>
                </thead>
                <tbody id="tbo">
                @foreach($categorys as $category)
                <tr class="text-c">
                    <td><input type="checkbox" name="" value=""></td>
                    <td>{{$category->id}}</td>
                    <td style="font-size: 0px">{{$category->order}}<input type="text" value="{{$category->order}}" style="position: absolute;width: 40px"></td>

                    <td class="{{$category->path}}" style="text-align: left">@php
                            $arr = explode(',',$category->path);
                            $num =count($arr)-2;

                        @endphp
                        {{str_repeat('|--',$num)}}{{$category->name}}
                    </td>

                    <td>{{$category->created_at}}</td>
                    <td>{{$category->updated_at}}</td>
                    <td class="status">
                        @if($category->status==1)
                            <span class="label label-success radius">正常</span>
                        @elseif($category->status==0 || $category->status==-1)
                            <span class="label label-danger radius">禁用</span>
                        @endif
                    </td>
                    <td class="f-14">
                        @if($category->status==1)
                        <a title="禁用" href="javascript:;" onclick="system_category_status(this,'{{'/admin/category/status'}}','{{$category->id}}','{{$category->path}}',-1,'禁用')" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>
                        @elseif($category->status==0)
                        <a title="启用" href="javascript:;" onclick="system_category_status(this,'{{'/admin/category/status'}}','{{$category->id}}','{{$category->path}}',1,'启用')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e1;</i></a>
                        @endif
                        <a title="编辑" href="javascript:;" onclick="system_category_edit(this,'编辑分类','{{$category->id}}','700','480')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
                        <a title="删除" href="javascript:;" onclick="system_category_status(this,'{{'/admin/category/status'}}','{{$category->id}}','{{$category->path}}',2,'删除')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
                    </td>
                </tr>
                @endforeach

                </tbody>

            </table>
        </div>
    </div>

@endsection

{{--//本页脚本--}}
@section('script')

    <script type="text/javascript" src="{{asset('/admin/lib/My97DatePicker/4.8/WdatePicker.js')}}"></script>
    <script type="text/javascript" src="{{asset('/admin/lib/datatables/1.10.0/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/admin/lib/laypage/1.2/laypage.js')}}"></script>
    <script type="text/javascript">
        $('.table-sort').dataTable({
            "aaSorting": [[ 7, "asc" ]],//默认第几个排序
            "bStateSave": false,//状态保存
            "aoColumnDefs": [
                //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
                {"orderable":false,"aTargets":[0,3]}// 制定列不参与排序
            ]
        });
        /*系统-栏目-添加*/
        function system_category_add(title,url,w,h){
            layer.open({
                type: 2,
                area: ['450px', '450px'],
                fix: false, //不固定
                maxmin: true,
                shade:0.4,
                title: title,
                content: url,
                end:function () {
                    window.location.reload();
                }
            });
        }
        /*系统-栏目-编辑*/
        function system_category_edit(obj,title,id,w,h){
            layer.open({
                type: 2,
                area: ['450px', '450px'],
                fix: false, //不固定
                maxmin: true,
                shade:0.4,
                title: title,
                data:id,
                content: '/admin/category/'+id+'/edit',
                end:function () {
                    $.get('/admin/category/edit_end/'+id,function (result) {
                            $(obj).parents('tr').html(result);
                    });
                }
            });
        }
        /*系统-栏目-删除-状态修改*/
        function system_category_status(obj,url,id,path,status,title){
            layer.confirm('确认'+title+'？',function(index){
                $.ajax({
                    type: 'post',
                    url: url,
                    data:{
                        '_token':'{{csrf_token()}}',
                        'id':id,
                        'path':path,
                        'status':status
                    },
                    success: function(result){
                            $('#tbo').html(result);
                            layer.msg(title+'成功!',{icon:1,time:2000});
                        },
                    error:function(result) {
                        if (result['status']==false) {
                            console.log(data.msg);
                            layer.msg(title+'失败!',{icon:0,time:1000});
                        }
                    },
                });
            });
        }
        function system_category_search() {
            var data = $('#category_search').val();
            $.post(
                'category/search',
                {
                    '_token':'{{csrf_token()}}',
                    'data':data
                },
                function (result) {
                    $('#tbo').html(result);
                }
            )
        }
    </script>

@endsection