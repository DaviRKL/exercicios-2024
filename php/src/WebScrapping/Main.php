<?php

namespace Chuva\Php\WebScrapping;

use DOMDocument;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;

/**
 * Runner for the Webscrapping exercice.
 */
class Main
{

  /**
   * Main runner, instantiates a Scrapper and runs.
   */
  public static function run(): void
  {
    libxml_use_internal_errors(true);
    $dom = new \DOMDocument('1.0', 'utf-8');
    $dom->loadHTMLFile(__DIR__ . '/../../assets/origin.html');

    libxml_use_internal_errors(false);
    $data = (new Scrapper())->scrap($dom);
    
    $xpath = new \DOMXPath($dom);

    $paperDiv = $xpath->query('//a[contains(@class, "paper-card p-lg bd-gradient-left")]');
    $papers = [];

    foreach ($paperDiv as $paper) {

      $titleNodeList = $xpath->query('.//h4[@class="my-xs paper-title"]', $paper);

// Verifica se o nó foi encontrado
if ($titleNodeList->length > 0) {
    // Acessa o primeiro nó encontrado e obtém o textContent
    $title = $titleNodeList->item(0)->textContent;
} else {
    // Caso o nó não seja encontrado, define um valor padrão para $title
    $title = "Title not found";
}


      $typeNode = $xpath->query('.//div[@class="tags mr-sm"]', $paper)->item(0);
      $type = $typeNode ? $typeNode->textContent : '';

      $authorNodes = $xpath->query('.//span[@class="authors"]//span', $paper);
      $authors = [];
      foreach ($authorNodes as $authorNode) {
        $authorName = $authorNode->textContent;
        $authorInstitution = $authorNode->getAttribute('title');
        $authors[] = new Entity\Person($authorName, $authorInstitution);
      }
      $papers[] = new Entity\Paper($title, $type, $authors);
    }
    $scrapper = new Scrapper();

    $data = $scrapper->scrap(
      $dom,
      'paper-card p-lg bd-gradient-left',
      'a',
      'h4.my-xs.paper-title',
      'span.authors span',
      'div.tags.mr-sm',
      'div.tags.flex-row.mr-sm > div.expand',
      'div.tags.flex-row.mr-sm > div.volume-info'
    );
 
    print_r($data);
  }

}
