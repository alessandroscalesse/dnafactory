<?php

// app/Console/Commands/ScrapeProducts.php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Spatie\Crawler\Crawler;
use Spatie\Crawler\CrawlProfiles\CrawlAllUrls;

class ScrapeProducts extends Command
{
    protected $signature = 'scrape:products';
    protected $description = 'Scrape products from ecommerce sites';

    public function handle()
    {
        $sites = [
            'efarma' => 'https://www.efarma.com/',
            'semprefarmacia' => 'https://www.semprefarmacia.it/',
            'anticafarmaciaorlandi' => 'https://www.anticafarmaciaorlandi.it/',
        ];

        foreach ($sites as $name => $url) {
            $this->info("Scraping products from {$name}");
            Crawler::create()
                ->setCrawlProfile(new CrawlAllUrls())
                ->setMaximumDepth(2)
                ->startCrawling($url);
        }
    }
}
