<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Repositories\CommentInterface;

class CommentController extends Controller
{
    protected $commentInterface;

    public function __Construct(CommentInterface $commentInterface)
    {
        $this->commentInterface = $commentInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($url)
    {

        $comments = $this->commentInterface->getAll();
       
        
        return response()->json([
                'comments' => $comments,
        ]);
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function page($url)
    {
        
        $comments = $this->commentInterface->getByPageUrl(base64_decode($url));
        
        return response()->json([
                'comments' => $comments,
        ]);
    }

    //  /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function page2($url)
    // {
    //     $comments = $this->commentInterface->getAll();
        

    //     return response()->json([
    //             'comments' => $comments,
    //     ]);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {

        try {
            // $comment = $this->commentInterface->create(array_merge($request->all(), ['url' => base64_decode($url)]));
            $comment = $this->commentInterface->create(array_merge($request->all()));

            return response()->json([
                'comment' => $comment,
                'message' => 'Bien enregisté'
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'err' => $th,
            ]);
        }
        
        // if ($comment) {
        //     # code...
        // }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            // $comment = $this->commentInterface->create(array_merge($request->all(), ['url' => base64_decode($url)]));
            $comment = $this->commentInterface->update( $id, $request->all());

            return response()->json([
                'comment' => $comment,
                'message' => 'Bien enregisté'
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'err' => $th,
            ]);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
