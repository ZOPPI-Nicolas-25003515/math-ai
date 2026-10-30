<?php
namespace App\View;

final class Alert extends Component
{
    /** @param array<string> $alerts */
    public function __construct(
        private readonly array $alerts,
    ) {
    }

    public function render(): string
    {
        $par = '';
        foreach ($this->alerts as $alert) {
            $par .= '<p>' . $alert . '</p>' . PHP_EOL;
        }

        return <<<HTML
                {$par}
            HTML;
    }
}