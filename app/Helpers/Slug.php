<?php

namespace App\Helpers ;

use Illuminate\Support\Facades\DB;

class slug {


    public static function uniqueSlug($slug , $table){
        $slug = self::createSlug($slug);
        $items = DB::table($table)->select('slug')->whereRaw("slug like '$slug%'")->get();
        $count = count($items);
        return $slug.'-'.$count;
    }


    public static function createSlug($str){
        $string = preg_replace("/[^a-z0-9_\s\-۰۱۲۳۴۵۶۷۸۹يءاأإآؤئبپتثجچحخدذرزژسشصضطظعغفقکكگگلمنوهی]/u", '', $str);

        $string = preg_replace("/[\s\-_]+/", ' ', $string);

        $string = preg_replace("/[\s_]/", '-', $string);

        return $string;
    
    }

}

