<?php

namespace App\Core;

final class View
{
    public string $directory;


    public array $share;
    public function __construct(string $directory, array $share) {
        $this->directory = $directory;
        $this->share = $share;
    }
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

    public function render(string $view,array $data = [], int $status = 200):Response
    {
        $data += $this->share;
        $content = $this->catch($view . '.php', $data);
        $html = $this->catch('Layout.php', $data + ['content' => $content]);

        return new Response($status, $html);
    }

    private function catch(string $file, array $data): string {
        extract($data, EXTR_SKIP);
        self::openBuffer();
        require $this->directory . '/' . $file;

        return self::getBufferContent();
    }
}
