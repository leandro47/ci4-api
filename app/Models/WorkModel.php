<?php namespace App\Models;

use CodeIgniter\Model;

class WorkModel extends Model
{
    /**
     * table name
     */
    protected $table = "recent_works";

    /**
     * allowed Field
     */
    protected $allowedFields = [
        'client',
        'date_deploy',
        'description',
        'link',
        'image',
        'class',
        'tags'
    ];
}