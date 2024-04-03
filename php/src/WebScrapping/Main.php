<?php

namespace Chuva\Php\WebScrapping;

use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Writer\Common\Entity\Row;
use Box\Spout\Writer\Common\Entity\Cell;
use DOMDocument;
use Chuva\Php\WebScrapping\Scrapper;
use Chuva\Php\WebScrapping\Entity\Paper;

class Main
{


  public static function run(): void
  {
    libxml_use_internal_errors(true);
    $dom = new \DOMDocument('1.0', 'utf-8');
    $dom->loadHTMLFile(__DIR__ . '/../../assets/origin.html');

    libxml_use_internal_errors(false);
    $data = (new Scrapper())->scrap($dom);

    $writer = WriterEntityFactory::createXLSXWriter();

    $filePath = './Planilha/papers.xlsx';

    $writer->openToFile($filePath);

    $headerRow = WriterEntityFactory::createRowFromArray(['ID', 'Title', 'Type', 'Authors']);
    $writer->addRow($headerRow);

    foreach ($data as $paper) {
      // Criar uma nova linha para o paper
      $paperRow = WriterEntityFactory::createRowFromArray([
        $paper->getId(),
        $paper->getTitle(),
        $paper->getType(),
        implode(", ", array_map(function ($author) {
          return $author->getName() . " (" . $author->getInstitution() . ")";
        }, $paper->getAuthors()))
      ]);

      // Adicionar a linha à planilha
      $writer->addRow($paperRow);
    }
    $writer->close();


    exit;




  }

}
