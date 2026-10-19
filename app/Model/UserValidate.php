<?php
namespace App\Model;
final class UserValidate {

    public function __construct(public readonly string $email, public readonly string $password, public readonly string $confirmation) {}

    public function checkEmailValidity(): string{

        $errors = '';
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors = 'L\'adresse email est invalide.';
        }

        return $errors;
    }
    public function checkPasswordLength(): string {
        $errors = '';

        if (strlen($this->password) < 12) {

            $errors = 'Le mot de passe doit contenir au moins 12 caractères.';

        }
        return $errors;
    }

    public function passwordConfirmation(): string{
        $errors = '';
        if ($this->password !== $this->confirmation) {

            $errors = 'Les deux mots de passe ne correspondent pas.';

        }
        return $errors;
    }





}