<?php
namespace App\Models;

use \Illuminate\Database\Eloquent\Model;

class Association extends Model
{
    protected $table = 'associations';

    /**
     *
     * @param int $id
     * @return array $data
     */
    public static function getAssociations()
    {
        $associations = Association::all();

        $data = [];

        foreach ($associations as $key => $association) {
            $data[$association->name]['details'] = 'Tel: ' . $association->telephone . '<br />Email: <a href="malto:' . $association->email . '">' . $association->email . '</a>';
        }

        return $data;
    }
}
