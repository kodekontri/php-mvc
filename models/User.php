<?php 

namespace app\models;

use app\core\Model;

class User extends Model
{
    /**
     * @var string
     */
    public string $username;
    /**
     * @var string
     */
    public string $email;
    /**
     * @var string
     */
    public string $password;
}
