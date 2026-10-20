<?php
namespace App\Controller;
use Core\{View,Request,Response};
final class SitemapController
{
    public function sitemapForm(): void
    {
        echo View::show('Sitemap');
    }
}
