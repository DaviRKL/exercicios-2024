<?php

namespace Chuva\Php\WebScrapping;
use DOMDocument;
use Chuva\Php\WebScrapping\Scrapper;
use Chuva\Php\WebScrapping\SpreadsheetCreator;
class Main
{


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
