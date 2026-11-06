<?php
namespace App\Controller;

use App\Core\{View,Request,Response};
use App\Model\UserRepository;
final class Profileresetpassword {
    public function __construct(private readonly UserRepository $repository) {}
    public function profileresetpasswordAction(Request $request) : Response {
        if ($request->session('user')['email'] !== null) {
            $email = $request->session('user')['email'];
            $reset_token = bin2hex(random_bytes(32));
            $timezoneFrance = new \DateTimeZone('Europe/Paris');
            $expiry = (new \DateTimeImmutable('+15 minutes', $timezoneFrance))->format('Y-m-d H:i:s');
            $this->repository->setResetToken($email, $reset_token, $expiry);
            $resetLink = '/resetpassword?reset&token=' . urlencode($reset_token);
            return Response::redirect($resetLink);
        }
        return Response::redirect('/');
    }
}