<?php
/**
 * classes for traning 
 * connection with PDO to db
 */

namespace DB\UserADD;


use Exception;
use \PDO;
use \PDOException;

class User
{
    private const HOST = 'localhost';

    private const DB = 'testing';

    private const USER = 'root';

    private const PASS = 'root';

    private const PORT = '8888';

    private $pdo;
    private $err;

    public $user_name;
    public $user_pass;
    /**
     * Summary of __construct
     * Init connection to db with PDO
     * @return connection;
     */
    public function __construct()
    {
        $dns = "mysql:host=" . self::HOST . ";dbname=" . self::DB . ";port=" . self::PORT;
        try {
            $this->pdo = new PDO($dns, self::USER, self::PASS);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $err) {
            echo '<p class="error__massage">error DB connection</p></br>';
            echo $err->getMessage();
        }

    }
    /**
     * Summary of setUser
     * @param string $user_name
     * @param string $user_pass
     * @return void
     */


    public function setUser(string $user_name, string $user_pass): void
    { {
            $this->user_name = $user_name;
            $this->user_pass = password_hash($user_pass, PASSWORD_BCRYPT);
        }

    }

    /**
     * Summary of addUser
     * Add user name and pass to db 
     * @return void
     */

    public function addUser(): void
    { {

            if (strlen($this->user_name) > 3 && !empty($this->user_name)) {
                try {
                    $query = "INSERT INTO `users` (`name`,`pass`) VALUES (:user_name,:user_pass)";
                    $stmt = $this->pdo->prepare($query);
                    $stmt->bindParam(':user_name', $this->user_name, PDO::PARAM_STR);
                    $stmt->bindParam(':user_pass', $this->user_pass);
                    $stmt->execute();
                    echo 'User asdded successfully<br>';
                } catch (PDOException $e) {
                    echo 'error to add user' . $e->getMessage() . '';
                }
            } else {
                echo 'user error';
            }
        }
    }


    //get all users 
    public function getAllUsers()
    {
        if (!isset($this->pdo)) {
            throw new Exception('PDO не инициализирован!');
        }

        try {
            $query = "SELECT * FROM `users`";
            $stmt = $this->pdo->query($query);
            $users = $stmt->fetchAll();
            if (!empty($users)) {
                foreach ($users as $id => $user) {
                    echo $user[1];
                }
            }
        } catch (PDOException $e) {
            echo 'Ошибка при получении пользователей: ' . $e->getMessage() . '<br>';
            return null;
        }
    }



    public function closeConnect(): void
    { {
            if (isset($this->pdo)) {
                $this->pdo = null;
                echo 'connection closed.';
            }
        }

    }


}
$new = new User();
var_dump($new->getAllUsers());
