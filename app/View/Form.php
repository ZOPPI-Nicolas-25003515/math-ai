<?php
namespace App\View;
use App\View\Input;

final class Form extends Component
{

    /** @param array<> $content */
    public function __construct(
        private readonly string $action,
        private readonly string $method = 'post',
        private readonly array $content = [],
        private readonly string $optional = ''
    ) {
    }

    public function render(): string
    {
        $action = $this->e($this->action);
        $method = $this->e($this->method);
        $optional = $this->e($this->optional);

        $par = $this->renderAll($this->content);
        return
            <<<HTML
                <form action="{$action}" method="{$method}" {$optional}>
                    {$par}
                </form>
            HTML
            ;
    }
}