<?php

require_once('Database.php');
require_once('Token.php');

class UserModel
{
    public static function AttemptLogin(string $identifier, string $password)
    {
        $DB = Database::getConnection();

        $task = "SELECT ID, password FROM users WHERE username = ? OR email = ?";

        $query = $DB->prepare($task);
        $query->bind_param('ss', $identifier, $identifier);
        $query->execute();

        $user_ID = "";
        $user_password = "";
        $query->bind_result($user_ID, $user_password);

        if (!($query->fetch())) {
            $query->close();
            http_response_code(404);
            echo json_encode([
                'status' => 'ERROR',
                'message' => 'User not found.'
            ]);
            return;
        }

        $query->close();
        if (password_verify($password, $user_password)) {
            http_response_code(200);
            echo json_encode([
                'status' => 'SUCCESS',
                'message' => 'Logged in.',
                'token' => Token::Generate($user_ID)
            ]);
        } else {
            http_response_code(401);
            echo json_encode([
                'status' => 'ERROR',
                'message' => 'Wrong password.'
            ]);
        }
    }

    public static function AttemptRegister(
        string $first_name,
        string $last_name,
        string $username,
        string $email,
        string $password
    ) {
        $DB = Database::getConnection();

        $task = "SELECT ID FROM users WHERE username = ? OR email = ?";
        $query = $DB->prepare($task);
        $query->bind_param('ss', $username, $email);
        $query->execute();
        $query_result = $query->get_result();
        $query->close();
        if ($query_result->num_rows > 0) {
            http_response_code(409);
            echo json_encode([
                'status' => 'ERROR',
                'message' => 'Email or username is taken.'
            ]);
            return;
        }

        $task = "INSERT INTO users (first_name, last_name, username, email, password) VALUES (?, ?, ?, ?, ?)";
        $query = $DB->prepare($task);
        $password = password_hash($password, PASSWORD_BCRYPT);
        $query->bind_param(
            'sssss',
            $first_name,
            $last_name,
            $username,
            $email,
            $password
        );

        if ($query->execute()) {
            http_response_code(200);
            echo json_encode([
                'status' => 'SUCCESS',
                'message' => 'User registered.'
            ]);
            return;
        } else {
            http_response_code(500);
            echo json_encode([
                'status' => 'ERROR',
                'message' => 'Failed to register user.'
            ]);
            return;
        }
    }
}
