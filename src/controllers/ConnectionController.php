<?php

/* To have a strict use of variable types */
declare(strict_types=1);

namespace App\controllers;

use App\model\UserModel;
use App\entity\User;
use App\services\ConnectionHandler;
use App\services\EmailFormatHandler;

class ConnectionController 
{
    public function accountConnection(array $formInput) : void
    {
        $userMailFormat = new User();
        $userMailFormat->setMail($formInput['mail']);
        $emailFormatCheck = new EmailFormatHandler();
        $emailFormatCheck->emailFormatCheck($userMailFormat);

        $userModel = new UserModel();
        $userExtract = $userModel->getUserInformations($formInput);

        $connectionCheck = new ConnectionHandler();
        $connectionCheck->connectionCheck($userExtract);
    }

    public function passwordLandingPage() : void 
    {
        require('templates/lostPassword.php');
    }

    public function lostPassword(array $formInput) : void 
    {
        $userMailFormat = new User();
        $userMailFormat->setMail($formInput['email']);
        $emailFormatCheck = new EmailFormatHandler();
        $emailFormatCheck->emailFormatCheck($userMailFormat);

        $userModel = new UserModel();
        $userCheck = $userModel->getUserByMailCheck($formInput['email']);
        $passwordChangeCheck = new ConnectionHandler();
        $passwordChangeCheck -> passwordChangeCheck($userCheck, $userModel);
    }

    public function passwordModifyCheck(array $mailInfo) : void 
    {
        $accountKey = $mailInfo['token'];
        $userModel = new UserModel();
        $user = $userModel->accountCheck($accountKey);
        $passwordLinkCheck = new ConnectionHandler();
        $passwordLinkCheck -> passwordLinkCheck($user);
    }

    public function passwordModify(array $userInfo) : void 
    {
        $userMailFormat = new User();
        $userMailFormat->setMail($userInfo['email']);
        $emailFormatCheck = new EmailFormatHandler();
        $emailFormatCheck->emailFormatCheck($userMailFormat);

        $userModel = new UserModel();
        $userSecurity = $userModel->userPasswordChangeSecurity($userInfo);
        $accountPasswordSecurityCheck = new ConnectionHandler();
        $accountPasswordSecurityCheck->accountPasswordSecurityCheck($userSecurity, $userInfo);
    }
}
