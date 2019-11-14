<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/10/2
 * Time: 12:37
 */


namespace App\Http\Controllers\Admin;



use App\Http\Model\Admin\Root;
use Illuminate\Http\Request;

use App\Lib\Code\Captcha;
use Illuminate\Support\Facades\Crypt;





class LoginController extends CommonController
{

        public function login(Request $request){

            $input = $request->input();
            if ($input) {

                $code =$request->session()->all();

                if (strtoupper($input['code'])!=strtoupper($code['code'])){

                    return back()->with('msgcode','验证码错误!');
                }


                $admin =Root::first();
                if ($admin->name != $input['name']){

                    return back()->with('msgname','用户不存在!');
                }
                if (Crypt::decrypt($admin->password)!=$input['password']){

                    return back()->with('msgpassword','密码错误!');
                }else{

                    session(['name'=>$input['name']]);

                    return redirect('admin/index');
                }
            }else {
                //dd(Crypt::encrypt('904133983'));
                return view('admin.login.login');
            }
        }
        public function loginOut(){
            session(['name'=>null]);
            return redirect('admin/login');
        }
        public function code(){

            $captcha = new Captcha(100,40,4);

            $captcha->showImage();
            $code=$captcha->getCheckCode();
            session(['code'=>$code]);
        }



}


