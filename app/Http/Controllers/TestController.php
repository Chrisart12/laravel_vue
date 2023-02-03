<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CommentInterface;

class TestController extends Controller
{
    protected $commentInterface;

    public function __construct(CommentInterface $commentInterface)
    {
        $this->commentInterface = $commentInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comment = $this->commentInterface->create([
            'url' => "https://laracasts.com/",
            'name' => "Issa",
            'body' => "Je suis ici lllll",
            'comment_id' => 10
        ]);

        
        dd("eeeee", $comment);
    
    }
}
