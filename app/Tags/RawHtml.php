<?php
namespace App\Tags;

final class RawHtml extends Component
{
    public function __construct(private readonly string $html)
    {
    }

    public function render(): string
    {
        return $this->html;
    }
}