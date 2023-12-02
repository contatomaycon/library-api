<?php

namespace App\Controllers;

use Firebase\JWT\JWT;
use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function login()
    {
        if (!$this->validateInput()) {
            return $this->response->setStatusCode(400)->setJSON([
                'message' => \Config\Services::validation()->getErrors()
            ]);
        }

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $user = $this->authenticateUser($username, $password);
        if (!$user) {
            return $this->response->setStatusCode(401)->setJSON([
                'message' => 'Invalid credentials'
            ]);
        }

        $jwt = $this->generateJWT($user['id']);

        $response = $this->createResponseData($user, $jwt);

        return $this->response->setJSON($response);
    }

    private function validateInput()
    {
        return $this->validate('login');
    }

    private function authenticateUser($username, $password)
    {
        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return false;
        }

        return $user;
    }

    private function generateJWT($userId)
    {
        $key = getenv('JWT_SECRET_KEY');
        $payload = [
            'iat' => time(),
            'exp' => time() + 3600,
            'uid' => $userId,
        ];

        return JWT::encode($payload, $key, 'HS256');
    }

    private function createResponseData($user, $jwt)
    {
        return [
            'name' => $user['name'],
            'token' => [
                'accessToken' => $jwt,
                'tokenType' => 'Bearer',
                'expiresIn' => time() + 3600
            ]
        ];
    }
}
