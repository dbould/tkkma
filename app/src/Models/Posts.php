<?php
namespace App\Models;

use \Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $table = 'blog';

    /**
     *
     * @param int $id
     * @return array $data
     */
    public static function getPosts()
    {
        $posts = Posts::all();

        $data = [];

        foreach ($posts as $post) {
            $data[$post->id]['id'] = $post->id;
            $data[$post->id]['title'] = $post->title;
            $data[$post->id]['content'] = substr($post->content, 0, 200) . '...';
        }

        return $data;
    }
}
