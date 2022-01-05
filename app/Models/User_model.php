<?php

namespace App\Models;

use CodeIgniter\Model;

class User_model extends Model {
    protected $DBGroup = 'default';
    protected $table = "users";
    protected $primaryKey = "username";
    protected $useTimeStamps = false;
    protected $allowedFields = ["username","password","level_id"];
}

?>