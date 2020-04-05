<?php 

namespace App\Services;



class PostService {
    /**
     * Attach tags to post 
     * @param object \App\Models\Post $post
     * @param $request
     * @return void
    */
    
    public function handleTags($post,$request)
    {
        $post->tags()->sync($request->tags);
    }



    public function detachTags($post)
    {
        $post->tags()->detach($post->tags);
    }

}