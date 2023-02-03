<?php 

namespace App\Repositories;

use App\Comment;
use DB;


class CommentRepository implements CommentInterface
{
    /**
     * @var [User]
     */
    protected $comment;
	
    /**
     * @param mixed $model
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
		
    }

    /**
     * Création du mot de passe par l'utilisateur
     * Envoi de SMS de vérification de mobile
     * 
     * @param mixed $array
     * 
     * @return [User]
     */
    public function getAll()
    {
        return $this->comment::orderBy('created_at', 'desc')
                            ->get();
    }

    public function getByPageUrl($url)
    {
        return $this->comment::where('url', $url) 
                            ->where("comment_id")
                        
                            ->orderBy('created_at', 'desc')
                            ->paginate(3);
                            // ->get();
    }



    /**
     * @param mixed $request
     * 
     * @return [type]
     */
    public function getById($id)
    {

        return response()->json([
            'comment' => $id,
            'message' => 'Bien enregisté'
        ]);
        $this->comment::findOrFaill($id);
    }

    /**
     * @param mixed $request
     * 
     * @return [type]
     */
    public function save(Comment $comment, Array $input)
    {
        $comment->url = $input['url'];
        $comment->name = $input['name'];
        $comment->body = $input['body'];
        // Si le commment_id existe
        if (isset($input['comment_id'])) {
            $comment->comment_id = $input['comment_id'];
        }
        

        $comment->save();
        
        // return  $comment->load('comments');
        return  $comment->setRelation('comments', collect());
        // return $comment->setRelations([]);


        // return $comment;

    }

    /**
     * @param mixed $request
     * 
     * @return [type]
     */
    public function create(Array $input)
    {
        $comment = new Comment();

        $response = $this->save($comment, $input);

        // $test = Comment::findOrFail($response->id);

        // return $response;
        return $response->toArray();

    }

    /**
     * @param mixed $request
     * 
     * @return [type]
     */
    public function saveBody(Comment $comment, Array $input)
    {


        DB::table('comments')
            ->where('id', 3)
            ->update(['title' => "Updated Title"]);
        $comment->body = $input['body'];
        
        $comment->save();
        
        return  $comment;
        return  $comment->setRelation('comments', collect());
        // return $comment->setRelations([]);


        // return $comment;

    }

    /**
     * @param mixed $request
     * 
     * @return [type]
     */
    public function update($id, Array $input)
    {

        // return response()->json([
        //     'comment' => $id,
        //     'message' => $input['body']
        // ]);

        // $comment = $this->getById($id);



        // return $this->save($comment, $input);

        return DB::table('comments')
                ->where('id', $id)
                ->update(['body' => $input['body']]);

    }
}


