<?php

/* To have a strict use of variable types */
declare(strict_types=1);

require_once('src/model/UserModel.php');
require_once('src/entity/User.php');

class ConnectionController 
{
    public function accountConnection(array $formInput) : void
    {
        $userModel = new UserModel();
        $userExtract = $userModel->getUserInformations($formInput);
      
        if ($userExtract != null) {
            if($userExtract->getValidateAccount() != 1) {
                $_SESSION['error'] = "Votre compte n'est pas validé, veuillez vérifier vos emails pour procéder à la validation.";
                header('Location: index.php?action=accountcreation');
            }else{
                $_SESSION['success'] = "Vous êtes connecté. Bienvenue !";
                $_SESSION['Connection'] = "Connected";
                $_SESSION['userInformations'] = [
                    'id'=>$userExtract->getId(),
                    'username'=>$userExtract->getUsername(),
                    'nickname'=>$userExtract->getNickname(),
                    'name'=>$userExtract->getName(),
                    'phonenumber'=>$userExtract->getPhonenumber(),
                    'mail'=>$userExtract->getMail(),
                    'validateAccount'=>$userExtract->getValidateAccount(),
                    'role'=>$userExtract->getRole()
                ];

                header('Location: index.php');
            }
        } else {
            $_SESSION['error'] = "Vos identifiants sont incorrects, veuillez réessayer.";
            header('Location: index.php?action=accountcreation');
        }
    }
}
