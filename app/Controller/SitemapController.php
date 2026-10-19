<?php
namespace App\Controller;
use Core\View;
final class SitemapController
{
    public function sitemapForm(): void
    {
        echo View::show('Sitemap');
    }
}
