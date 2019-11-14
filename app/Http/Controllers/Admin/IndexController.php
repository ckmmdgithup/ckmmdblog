<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/10/2
 * Time: 12:37
 */


namespace App\Http\Controllers\Admin;


use App\Http\Model\Admin\Root;
use App\Http\Requests\Password;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;


class IndexController extends CommonController
{


        public function index(){


            return view('admin.index.index');

        }

        public function changePassword(Request $request){
            $input = $request->input();
            if ($input){
                if ($input['new_password']!=$input['confim_password']){
                    return ['status'=>0,'msg'=>'两次密码输入不相同！','data'=>$input];
                }
                $admin =Root::first();
                if (Crypt::decrypt($admin->password)!= $input['old_password']){
                    return ['status'=>0,'msg'=>'修改失败，原密码错误！','data'=>$input];
                }
                $admin->password =Crypt::encrypt($input['new_password']);
                $res = $admin->update();
                if (!$res) {
                    return ['status' => 0, 'msg' => '修改失败未知原因！', 'data' => $res];
                }else{
                    session(['name'=>null]);
                    return ['status' => 1, 'msg' => '恭喜您修改成功，请重新登陆！', 'data' => $res];

                }

            }else {

                return view('admin.index.change_password');
            }
        }

        public function welcome(){
            return view('admin.index.welcome');
        }


}


