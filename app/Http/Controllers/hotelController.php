<?php
/**
 * Created by PhpStorm.
 * User: allenlyu
 * Date: 4/10/16
 * Time: 6:24 PM
 */
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class hotelController extends Controller
{
    public function getPoi()
    {
        $poiid = Input::get('poi');
        $poi = DB::select('SELECT * FROM pink.poi where poiid='.$poiid);
        $data = DB::select('SELECT * FROM pink.hotel where poiid='.$poiid);
//        var_dump($mdd);exit();
        view()->share("hotels",$data);
        view()->share("poi",$poi[0]);
        return view('hotel');
    }

    public function getDetail()
    {
        $id = Input::get('id');
        $data = DB::select('SELECT * FROM pink.hotel where hid='.$id);
        view()->share('hotels',$data);
//        var_dump($data);exit();
        return view('detail');
    }




    public function getCart()
    {
//        $hid = Input::get('id');
        $data = array(
            'hid'=>Input::get('id'),
            'starttime'=>Input::get('start'),
            'endtime'=>Input::get('end'),
            'uid'=>$_SESSION['user']['uid']
        );

        return DB::table('cart')->insertGetId($data);
    }
}