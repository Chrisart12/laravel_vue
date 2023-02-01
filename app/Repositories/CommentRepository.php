<?php 

namespace App\Repositories;

use App\Comment;


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
    }



    /**
     * @param mixed $request
     * 
     * @return [type]
     */
    public function getById($id)
    {
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

        return $comment->setRelations([]);


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

        return $this->save($comment, $input);

    }

    /**
     * @param mixed $request
     * 
     * @return [type]
     */
    public function update($id, Array $input)
    {
        $comment = $this->getById($id);

        return $this->save($comment, $input);

    }
}


