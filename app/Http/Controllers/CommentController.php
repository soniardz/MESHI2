<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function save(Request $request){
        
        $validate = $this->validate($request,[ 
                'image_id' => 'integer|required',
                'content' => 'string|required'
                ]);
        
        //recoger datos
        $user = \Auth::user();
        $image_id = $request->input('image_id');
        $content = $request->input('content');
        
        //asigno los valores a mi nuevo objeto a guardar
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;
        
        //guardar
        $comment->save();
        
        //redireccion
        return redirect()->route('image.detail',['id' => $image_id])
                ->with([
                    'message' => 'Has publicado correctamente'
                ]);
    }
    
    public function delete($id){
        //conseguir datos del usuario logueado
        $user = \Auth::user();
        
        //Conseguir objeto del comentario
        $comment = Comment::find($id);
        
        //comprobar si soy el dueño del comentarioo de la publicacion
        if($user && ($comment->user_id == $user->id  || $comment->image->user_id == $user->id)){
            $comment->Delete();
            return redirect()->route('image.detail',['id' => $comment->image->id])
                ->with([
                    'message' => 'Se a borrado su comentario correctamente'
                ]);
        }else{
            return redirect()->route('image.detail',['id' => $comment->image->id])
                ->with([
                    'message' => 'No se elimino el comentario correctamente'
                ]);
        
        }
    }
}
