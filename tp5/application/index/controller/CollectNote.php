<?php
/**
 * Created by PhpStorm.
 * User: duoduogao
 * Date: 2017/12/11
 * Time: 上午9:32
 */

namespace app\index\controller;

use app\index\model\Note;
use app\index\model\Collect;
use think\controller;

class CollectNote extends controller
{

    public function addCollect($username, $noteId)
    {

        $list = Collect::get(["username" => $username, "noteId" => $noteId]);

        if ($list != null) {
            return "collected";
        }

        $collect = new Collect(["username" => $username, "noteId" => $noteId]);

        $collect->save();

        return "success";
    }

    public function deleteCollect($username, $noteId)
    {
        $list = Collect::get(["username" => $username, "noteId" => $noteId]);

        if ($list == null) {
            return "notCollected";
        }

        Collect::destroy(["username" => $username, "noteId" => $noteId]);

        return "success";
    }

    public function getCollectList($username)
    {
        $list = Collect::all(["username" => $username]);

        $noteList = array();

        foreach ($list as $n) {
            $noteId = $n->noteId;
            $note = Note::get(["id" => $noteId]);
            array_push($noteList, $note);
        }

        return json_encode($noteList);
    }

    public function hasCollect($username, $noteId)
    {

        $list = Collect::get(["username" => $username, "noteId" => $noteId]);

        if ($list == null) {
            return "false";
        } else {
            return "true";
        }
    }

}