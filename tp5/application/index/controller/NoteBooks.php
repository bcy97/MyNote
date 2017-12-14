<?php
/**
 * Created by PhpStorm.
 * User: duoduogao
 * Date: 2017/12/12
 * Time: 下午5:31
 */

namespace app\index\controller;

use app\index\model\Note;
use app\index\model\Notes;
use app\index\model\Notebook;
use think\controller;

class NoteBooks extends controller
{
    public function addNoteBook($username, $notebookName)
    {
        $list = Notebook::get(["username" => $username, "notebookName" => $notebookName]);

        if ($list != null) {
            return "added";
        } else {
            $notebook = new Notebook(["username" => $username, "notebookName" => $notebookName]);
            $notebook->save();
            return "success";
        }
    }

    public function deleteNoteBook($username, $notebookName)
    {
        $list = Notebook::get(["username" => $username, "notebookName" => $notebookName]);

        if ($list == null) {
            return "notAdded";
        } else {
            Notebook::destroy(["username" => $username, "notebookName" => $notebookName]);
            Notes::destroy(["notebookName"=>$list->id]);
            return "success";
        }
    }

    public function getNoteBooks($username)
    {
        $list = Notebook::all(["username" => $username]);

        if ($list == null) {
            return "none";
        } else {
            return json_encode($list);
        }
    }

    public function addNoteToNoteBook($notebookId, $noteId)
    {
        $list = Notes::get(["notebookId" => $notebookId, "noteId" => $noteId]);

        if ($list != null) {
            return "added";
        } else {
            $notebook = new Notes(["notebookId" => $notebookId, "noteId" => $noteId]);
            $notebook->save();
            return "success";
        }
    }

    public function getNoteFromBook($notebookId)
    {

        $noteIdList = Notes::all(["notebookId" => $notebookId]);

        $resultList = array();

        if ($noteIdList == null) {
            return "none";
        } else {
            foreach ($noteIdList as $id) {

                array_push($resultList, Note::get(["id" => $id->noteId]));
            }
            return json_encode($resultList);
        }
    }

}