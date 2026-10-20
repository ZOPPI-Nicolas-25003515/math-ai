<?php
namespace App\Controller;
use Core\{View,Request,Response};
final class SitemapController
{
    public function sitemapForm(): Response
    {
        return View::render('Sitemap');
    }
}
