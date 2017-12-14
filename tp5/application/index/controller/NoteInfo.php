<?php
/**
 * Created by PhpStorm.
 * User: duoduogao
 * Date: 2017/12/9
 * Time: 下午8:15
 */

namespace app\index\controller;

use app\index\model\Note;
use app\index\model\Notes;
use app\index\model\Tags;
use think\controller;

class NoteInfo extends controller
{

    public function addNote($username, $title, $content)
    {
        $list = Note::all(["username" => $username]);

        foreach ($list as $note) {
            if ($note->title == $title) {
                return "exist";
            }
        }

        $note = new Note([
            "username" => $username,
            "title" => $title,
            "abstract" => "",
            "content" => $content
        ]);
        $note->save();

        return "success";
    }

    public function deleteNote($id)
    {
        $note = Note::get(["id" => $id]);

        if ($note != null) {
            Note::destroy(["id" => $id]);
            Notes::destroy(["noteId"=>$id]);
            Tags::destroy(["noteId"=>$id]);
            return "success";
        } else {
            return "notExist";
        }
    }

    public function updateNote($id, $username, $title, $content)
    {


        $note = Note::get(["id" => $id]);


        if ($note != null) {

            $note->title = $title;
            $note->content = $content;

            $note->save();

            return "success";
        } else {
            return "notExist";
        }

    }

    public function getNote($noteID)
    {
        $note = Note::get(["id" => $noteID]);

        if ($note != null) {
            return json_encode($note);
        } else {
            return "notExist";
        }
    }

    public function getNoteList($username)
    {

        $list = Note::all(["username" => $username]);

        if ($list != null) {
            return json_encode($list);
        } else {
            return "none";
        }
    }

}

