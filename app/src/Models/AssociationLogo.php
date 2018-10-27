<?php
namespace App\Models;

use \Illuminate\Database\Eloquent\Model;

class AssociationLogo extends Model
{
    protected $table = 'association_logos';

    /**
     *
     * @param int $id
     * @return array $data
     */
    public static function getAssociations()
    {
        $associationLogos = AssociationLogo::all();

        $data = [];

        foreach ($associationLogos as $key => $association) {
            $data[$association->image] = '<img height="200" width="200" src="' . $association->image . '" />';
        }

        return $data;
    }
}
