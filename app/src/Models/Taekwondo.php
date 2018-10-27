<?php
namespace App\Models;

use \Illuminate\Database\Eloquent\Model;

class Taekwondo extends Model
{
    protected $table = 'taekwondo_belts';

    /**
     *
     * @param int $id
     * @return array $data
     */
    public static function getData()
    {
        $taekwondoDetails = Taekwondo::all();

        $data = [];

        foreach ($taekwondoDetails as $key => $details) {
            $data[$details->belt]['image'] = '<img src="' . $details->actual_image . '" />"';
            $data[$details->belt]['information'] = $details->information;
        }

        return $data;
    }
}
