<?php
namespace View;
abstract class Component
{
    abstract public function render(): string;

    public function __toString(): string
    {
        return $this->render();
    }

    protected function e(string $text): string
    {
        return htmlspecialchars($text, ENT_QUOTES);
    }

    protected function renderAll(array $childs): string
    {
        $html = '';
        foreach ($childs as $child) {
            $html .= $child instanceof Component ? $child->render() : $this->e($child);
        }

        return $html;
    }
}