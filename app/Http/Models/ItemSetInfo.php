<?php

namespace App\Http\Models;
//By Sao Guang
use Illuminate\Database\Eloquent\Model;

class ItemSetInfo extends Model
{
    protected $table = 't_item_set_info';

    protected $primaryKey = 'item_id';


    /**
     * 获取当前届别设置项的数据库对象
     * @return mixed
     */
    static public function getCurrentSessionItemSetObj()
    {
        return ItemSetInfo::where('item_no', config('constants.ITEM_SESSION'))
            ->orderBy('item_content_id', 'desc')
            ->first();
    }
}