<?php
namespace App\View;

/*
 * Classe abstraite principale des composants, qui vont hériter de cette dernière et utiliser ses méthodes.
 */

abstract class Component
{
    abstract public function render(): string;

    public function __toString(): string
    {
        return $this->render();
    }

    /*
     * Affiche le texte envoyé en paramètre dans htmlspecialchars, pour empêcher l'écriture de code java script dans une zone de texte
     */
    protected function e(string $text): string
    {
        return htmlspecialchars($text, ENT_QUOTES);
    }

    /*
     * Affiche chaque variable du tableau et lorsqu'on trouve une instance de Component, on l'affiche avec render
     * render() : Affiche l'html de l'objet concerné
     */
    /**
    * @param array $childs
     */
    protected function renderAll(array $childs): string
    {
        $html = '';
        foreach ($childs as $child) {
            $html .= $child instanceof Component ? $child->render() : $this->e($child);
        }

        return $html;
    }
}