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