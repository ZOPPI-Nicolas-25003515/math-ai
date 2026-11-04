<?php
namespace App\Controller;
use App\Core\{View,Request,Response};
final class SitemapController
{
    private View $view;
    public function __construct(View $view) {
        $this->view = $view;
    }
    public function sitemapForm(): Response
    {
        return $this->view->render('Sitemap');
    }
}
