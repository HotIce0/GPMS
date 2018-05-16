<?php
//by xiaoming
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\ClassInfo;

class Test extends Controller
{
    public function test()//测试
    {
            $classInfos=ClassInfo::all();
        return view('admin.manageInfo.Test.test',[
            'classInfos' => $classInfos,
        ]);
    }
 //删除
    public function  del(){
        $id = Request::input('id');
        $str = explode(",",$id);
        //var_dump($str);die;
        foreach($str as $v){
            DB::table('goods')->where('id',"=","$v")->delete();
        }

        $arr['content']="删除Id为".$id."数据";
        $arr['date']=date("Y-m-d H:i:s");
        $arr['u_id'] = Session::get('user');
        DB::table('rizhi')->insert($arr);
        return  redirect("login_do");
    }
    //即点击该
    public function  update(){
        $pid = Request::input('pid');
        // echo $pid;die;
        $old =  DB::table('goods')->where('id',"=","$pid")->first();
        $old_name =  $old->goods_name;
        $goods_name = Request::input('goods_name');
        $res= DB::table('goods')
            ->where('id','=',$pid)
            ->update(array('goods_name' => $goods_name));
        $arr['content']="Id为".$pid."数据将商品名".$old_name."修改为".$goods_name;
        $arr['date']=date("Y-m-d H:i:s");
        $arr['u_id'] = Session::get('user');
        DB::table('rizhi')->insert($arr);
        echo   1;
        //return  redirect("login_do");
    }

    //即点击该  价格
    public function  price(){
        $pid = Request::input('pid');
        // echo $pid;die;
        $old =  DB::table('goods')->where('id',"=","$pid")->first();
        $old_name =  $old->goods_name;
        $goods_name = Request::input('goods_name');
        $res= DB::table('goods')
            ->where('id','=',$pid)
            ->update(array('goods_price' => $goods_name));
        $arr['content']="Id为".$pid."数据将价格".$old_name."修改为".$goods_name;
        $arr['date']=date("Y-m-d H:i:s");
        $arr['u_id'] = Session::get('user');
        DB::table('rizhi')->insert($arr);
        echo   1;
        //return  redirect("login_do");
    }

}