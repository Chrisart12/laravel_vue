<?php 

namespace App\Repositories;

use App\Comment;


interface CommentInterface
{
    public function getAll();
    public function getById($id);
    public function save(Comment $comment, Array $input);
    public function create(Array $input);
    public function update($id, Array $input);

}


