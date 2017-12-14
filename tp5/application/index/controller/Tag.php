<?php
/**
 * Created by PhpStorm.
 * User: duoduogao
 * Date: 2017/12/12
 * Time: 下午4:37
 */

namespace app\index\controller;

use app\index\model\Note;
use app\index\model\Tags;
use think\controller;

class Tag extends controller
{
    public function getTags($noteId)
    {
        $list = Tags::all(["noteId" => $noteId]);

        if ($list == null) {
            return "none";
        } else {
            return json_encode($list);
        }
    }

    public function addTag($noteId, $tagContent)
    {

        $list = Tags::get(["noteId" => $noteId, "tagContent" => $tagContent]);

        if ($list == null) {
            $tag = new Tags(["noteId" => $noteId, "tagContent" => $tagContent]);
            $tag->save();

            return "success";
        } else {
            return "added";
        }

    }

    public function deleteTag($noteId, $tagContent)
    {
        $list = Tags::get(["noteId" => $noteId, "tagContent" => $tagContent]);

        if ($list == null) {

            return "notAdded";
        } else {
            Tags::destroy(["noteId" => $noteId, "tagContent" => $tagContent]);
            return "success";
        }
    }
}