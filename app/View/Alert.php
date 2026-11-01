<?php
namespace App\View;

final class Alert extends Component
{
    /** @param array<string> $alerts */
    public function __construct(
        private readonly array $alerts,
        private readonly string $class = ''
    ) {
    }

    public function render(): string
    {
        $class = $this->e($this->class);
        $par = '';
        foreach ($this->alerts as $alert) {
            $par .= ($class == '') ? '<p>' . $alert . '</p>' . PHP_EOL : '<p class=\"'. $class . '">' . $alert . '</p>';
        }

        return <<<HTML
                {$par}
            HTML;
    }
}