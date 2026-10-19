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

    /**
     * @param array<string, mixed> $A_array
     */
    public static function show(string $S_location,array $A_array = []):void
    {
        $data = [];
        $S_file = __DIR__ . '/../app/View/' . $S_location . '.php';
        $data += ['LoginUser' => $_SESSION['user'] ?? null];
        $A_view = $A_array;
        extract($A_view, EXTR_SKIP);
        require $S_file;
    }
}
?>
