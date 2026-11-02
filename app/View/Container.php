<?php
namespace App\View;

final class Container extends Component
{
    /**
     * @param string $type
     * @param array $content
     * @param string $optional
     */
    public function __construct(
        private readonly string $type,private readonly array $content,private readonly string $optional = '') {
    }

    public function render(): string
    {
        $type = $this->e($this->type);
        $optional = $this->e($this->optional);
        $par = $this->renderAll($this->content);

        return
            <<<HTML
            <{$type} {$optional}>
                {$par}
            </{$type}>
            HTML;
    }
}