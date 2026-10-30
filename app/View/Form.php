<?php
namespace App\View;

final class Form extends Component
{

    /** @param array<Input> $inputs */
    public function __construct(
        private readonly string $action,
        private readonly string $method = 'post',
        private readonly array $inputs = []
    ) {
    }

    public function render(): string
    {
        $action = $this->e($this->action);
        $method = $this->e($this->method);

        $renderInput = '';
        foreach ($this->inputs as $input) {
            $renderInput .= '<li>'.$input->render().'</li>';
        }
        return <<<HTML
            <span>
                <Form action="{$action}" method="{$method}">
                    <ul>{$renderInput}</ul>
            </span>

            HTML;
    }
}