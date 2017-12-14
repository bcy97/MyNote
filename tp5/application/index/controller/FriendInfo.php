<?php
/**
 * Created by PhpStorm.
 * User: duoduogao
 * Date: 2017/12/11
 * Time: 下午2:37
 */

namespace app\index\controller;

use app\index\model\Friend;
use app\index\model\Note;
use app\index\model\Collect;
use think\controller;

class FriendInfo extends controller
{
    public function addFriend($username, $friendName)
    {
        $list = Friend::get(["username" => $username, "friendName" => $friendName]);

        if ($list != null) {
            return "added";
        }

        $friend = new Friend(["username" => $username, "friendName" => $friendName]);

        $friend->save();

        return "success";
    }

    public function deleteFriend($username, $friendName)
    {


        $list = Friend::get(["username" => $username, "friendName" => $friendName]);

        if ($list == null) {
            return "notAdded";
        } else {

            Friend::destroy(["username" => $username, "friendName" => $friendName]);

            return "success";
        }

    }

    public function getAllFriends($username)
    {
        $list = Friend::all(["username" => $username]);

        return json_encode($list);
    }

    public function getFriendNotes($username, $friendName)
    {
        $list1 = Friend::get(["username" => $username, "friendName" => $friendName]);
        $list2 = Friend::get(["username" => $friendName, "friendName" => $username]);

        if ($list1 != null && $list2 != null) {

            $notes = Note::all(["username" => $friendName]);

            if ($notes == null) {
                return "none";
            } else {

                return json_encode($notes);
            }


        } else if ($list2 == null) {
            return "notAdded";
        }
    }

}