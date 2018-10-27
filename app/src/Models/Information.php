<?php
namespace App\Models;

use \Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $table = 'information';

    /**
     *
     * @param int $id
     * @return array $data
     */
    public static function getInformation($category)
    {
        $informationDetails = Information::raw('information_title, information_desc')
                    ->where('category', '=', $category)
                    ->get();

        $data = [];

        foreach ($informationDetails as $information) {
            $data['information_title'] = $information->information_title;
            $data['information_desc'] = $information->information_desc;
        }

        return $data;
    }

    public static function getAllInformation($category)
    {
        $informationDetails = Information::raw('id, information_title, information_desc')
                    ->where('category', '=', $category)
                    ->get();

        $data = [];

        foreach ($informationDetails as $information) {
            $data[$information->information_title] = $information->information_desc;
        }

        return $data;
    }
}
