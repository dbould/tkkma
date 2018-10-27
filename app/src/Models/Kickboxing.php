<?php
namespace App\Models;

use \Illuminate\Database\Eloquent\Model;

class Kickboxing extends Model
{
    protected $table = 'kickboxing_belts';

    /**
     *
     * @param int $id
     * @return array $data
     */
    public static function getData()
    {
        $kickboxingDetails = Kickboxing::all();

        $data = [];

        foreach ($kickboxingDetails as $key => $details) {
            $data[$details->belt]['image'] = '<img src="' . $details->actual_image . '" />"';
            $data[$details->belt]['information'] = $details->information;
        }

        return $data;
    }
}
