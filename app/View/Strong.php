<?php
namespace App\View;

final class Strong extends Component
{
    public function __construct(
        private readonly string $text,
        private readonly string $class = ''
    ) {
    }

    public function render(): string
    {

        $text = $this->e($this->text);
        $class = $this->e($this->class);

        return ($class == '') ?
            <<<HTML
                <strong>{$text}</strong>
            HTML
            :
            <<<HTML
                <strong class ="{$class}">{$text}</strong>
            HTML
            ;
    }
}