<?php namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model
{
    /**
     * table name
     */
    protected $table = "user";

    /**
     * allowed Field
     */
    protected $allowedFields = [
        'id',
        'nama',
        'posisi'
    ];
}