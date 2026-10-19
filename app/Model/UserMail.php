<?php
namespace App\Model;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

final class UserMail {
    public function __construct(private string $email) {}

    /**
     * @param array<string, mixed> $content
     */
    public function sendMail(array $content): bool|string
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = $_ENV['SMTP_HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['SMTP_USER'];
            $mail->Password = $_ENV['SMTP_PASS'];
            $mail->SMTPSecure = 'tls';
            $mail->Port = (int) $_ENV['SMTP_PORT'];
            $mail->CharSet = 'UTF-8';

            $mail->setFrom($_ENV['SMTP_FROM'], 'MathAI');
            $mail->addAddress($this->email);

            $mail->Subject = $content['subject'] ?? 'Message';
            $mail->isHTML(true);
            $mail->Body = $content['message'] ?? '';
            $mail->AltBody = strip_tags($content['message'] ?? '');

            return $mail->send();
        } catch (Exception $e) {
            return "Erreur lors de l'envoi de l'e-mail : {$mail->ErrorInfo}";
        }
    }

    /**
     * @return array<string, mixed>
     */
    public function createResetPasswordMessage(string $email, string $resetLink): array
    {
        $subject = 'Réinitialisation de votre mot de passe';
        $message = "Bonjour,<br><br>";
        $message .= "Pour réinitialiser votre mot de passe, cliquez sur ce lien :<br><br>";
        $message .= '<a href="' . $resetLink . '">Réinitialiser mon mot de passe</a><br><br>';
        $message .= "Ce lien expirera dans 15 minutes.\n";

        return [
            'subject' => $subject,
            'message' => $message,
            'to' => $email,
        ];
    }
}
