<?php
namespace App\Tags;

final class Alert extends Component
{
    /** @param array<string> $alerts */
    public function __construct(
        private readonly array $alerts,
        private readonly string $optional = ''
    ) {
    }

    public function render(): string
    {
        $optional = $this->optional;
        $par = '';
        foreach ($this->alerts as $alert) {
            $par .= '<p '. $optional . '>' . $alert . '</p>';
        }

        return <<<HTML
                {$par}
            HTML;
    }
}