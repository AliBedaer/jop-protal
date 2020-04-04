<?php 

namespace App\Services;



class PostService {

    public function handleTags($post,$request)
    {
        $post->tags()->sync($request->tags);
    }



    public function detachTags($post)
    {
        $post->tags()->detach($post->tags);
    }

}