<?php
namespace App\Core;

/*
 * Reçoit le corps du HTML de la vue et le header, affiche cette vue et renvoie vers la page du header
 */

final class Response {
private int $status;
private string $body;
private array $header = [];

public function __construct(int $status, string $body,array $header = []) {
    $this->status = $status;
    $this->body = $body;
    $this->header = $header;
}

public static function redirect(string $path): Response {
    return new Response(302,'',['Location' => $path]);
}

public function send(): void
{
    http_response_code($this->status);
    foreach ($this->header as $name => $value) {
        header("$name: $value");
    }
    echo $this->body;
}
}
