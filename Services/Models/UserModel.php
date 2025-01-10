<?php

require_once(__DIR__ . '/../Utils/Database.php');

class UserModel
{
    public static function GetUser(string $identifier): array
    {
        $DB = Database::getConnection();

        $task = 'SELECT ID, username, email, password FROM users WHERE username = ? OR email = ?';

        $query = $DB->prepare($task);
        $query->bind_param('ss', $identifier, $identifier);
        $query->execute();

        $ID = null;
        $username = null;
        $email = null;
        $password = null;

        $query->bind_result($ID, $username, $email, $password);
        $query->fetch();
        $query->close();

        return [
            'ID' => $ID,
            'username' => $username,
            'email' => $email,
            'password' => $password
        ];
    }

    public static function CheckUser(string $username, string $email): bool
    {
        $DB = Database::getConnection();

        $task = 'SELECT ID password FROM users WHERE username = ? OR email = ?';
        $query = $DB->prepare($task);
        $query->bind_param('ss', $username, $email);
        $query->execute();
        $query->store_result();
        $rows = $query->num_rows;
        $query->close();

        return $rows == 0;
    }

    public static function CreateUser(array $data): bool
    {
        $DB = Database::getConnection();

        $task = "INSERT INTO users (first_name, last_name, username, email, password) VALUES (?, ?, ?, ?, ?)";
        $query = $DB->prepare($task);

        $password = password_hash($data['password'], PASSWORD_BCRYPT);
        $query->bind_param(
            'sssss',
            $data['first_name'],
            $data['last_name'],
            $data['username'],
            $data['email'],
            $password
        );

        if ($query->execute()) return true;
        else return false;
    }
}
