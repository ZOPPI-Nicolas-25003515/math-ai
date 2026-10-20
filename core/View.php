<?php

namespace Core;

final class View
{
    public static function openBuffer(): void
    {
        ob_start();
    }

    public static function getBufferContent():string|false
    {
        return ob_get_clean();
        // ob_get_clean() equivalent a ob_get_contents() + ob_end_clean()
    }

    public static function closeBuffer(): bool {
        return ob_clean();
    }

    public static function render(string $view,array $data = [], int $status = 200):Response
    {
        $data += ['LoginUser' => $_SESSION['user'] ?? null];
        extract($data, EXTR_SKIP);
        self::openBuffer();
        require dirname(__DIR__) . '/views/' . $view . '.php';
        $body =self::getBufferContent();

        return new Response($status, $body);
    }
}
