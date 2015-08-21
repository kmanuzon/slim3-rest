<?php
namespace App\Controller;

class Home extends Controller
{
    public function getAction()
    {
        $userModel = new \App\Model\User();
        $user = $userModel->getUsers(4);
        return json_encode($user);
    }
}
