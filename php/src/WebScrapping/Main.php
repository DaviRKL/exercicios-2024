<?php

namespace Chuva\Php\WebScrapping;

use Chuva\Php\WebScrapping\Scrapper;
use Chuva\Php\WebScrapping\SpreadsheetCreator;
use DOMDocument;

/**
 * Main class for running the web scraping process.
 */
class Main
{
    /**
     * Run the web scraping process.
     */
    public static function run(): void
    {
        libxml_use_internal_errors(true);

        $dom = new \DOMDocument('1.0', 'utf-8');
        $dom->loadHTMLFile(__DIR__ . '/../../assets/origin.html');

        libxml_use_internal_errors(false);

        $data = (new Scrapper())->scrap($dom);
        $filePath = './Planilha/papers.xlsx';
        SpreadsheetCreator::createSpreadsheet($data, $filePath);
        print("A Planilha foi criada com sucesso em " . $filePath);
        exit;
    }
}
