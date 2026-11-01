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
        private readonly string $class = ''
    ) {
    }

    public function render(): string
    {
        $action = $this->e($this->action);
        $method = $this->e($this->method);
        $class = $this->e($this->class);

        $par = $this->renderAll($this->content);
        return ($class == '') ?
            <<<HTML
                <form action="{$action}" method="{$method}">
                    {$par}
                </form>

            HTML
            :
            <<<HTML
                <form action="{$action}" method="{$method}" class = {$class}>
                    {$par}
                </form>
            HTML
            ;
    }
}