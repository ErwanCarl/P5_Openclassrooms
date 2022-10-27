<?php

/* To have a strict use of variable types */
declare(strict_types=1);

namespace App\controllers;

use App\model\UserModel;
use App\entity\User;
use App\services\AccountValidationHandler;
use App\services\EmailFormatHandler;

class AccountSubmitController
{
    public function accountSubmit($formInput) : void 
    {
        $userModel = new UserModel();
        $user = new User($formInput);

        $emailFormatCheck = new EmailFormatHandler();
        $emailFormatCheck->emailFormatCheck($user);

        $accountKey = base_convert(hash('sha256', time() . mt_rand()), 16, 36);
        $user->setAccountKey($accountKey);
        $usert = $userModel->userPseudoCheck($user);

        $accountValidation = new AccountValidationHandler();
        $accountValidation->accountCreationHandler($userModel, $user);
    }

    public function inscriptionValidation(string $accountKey) : void 
    {
        $userModel = new UserModel();
        $validateAccount = $userModel->validateAccount($accountKey);

        $accountValidation = new AccountValidationHandler();
        $accountValidation->validationCheck($validateAccount);
    }
}
