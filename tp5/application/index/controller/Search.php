<?php
/**
 * Created by PhpStorm.
 * User: duoduogao
 * Date: 2017/12/12
 * Time: 下午3:18
 */

namespace app\index\controller;

use app\index\model\Note;
use app\index\model\Tags;
use think\controller;

class Search extends controller
{
    public function getSearchResult($keyWords)
    {
        $noteList = Note::all();
        $tagList = Tags::all();

        $resultList = array();


        foreach ($noteList as $n) {
            if (!in_array($n->id, $resultList) && strpos($n->title, $keyWords)>0) {
                array_push($resultList,$n);
            }
        }

        return json_encode($resultList);
//        foreach ($tagList as $tag) {
//            if (in_array($tag->noteId, $resultList) && strpos($tag->tagContent, $keyWords)) {
//                $resultList . array_push($n);
//            }
//        }
//
//        if ($resultList==null) {
//            return "none";
//        } else {
//            return json_encode($resultList);
//        }

    }
}
