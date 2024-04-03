<?php

namespace Chuva\Php\WebScrapping;

use Chuva\Php\WebScrapping\Entity\Paper;
use Chuva\Php\WebScrapping\Entity\Person;
use Chuva\Php\WebScrapping\Util\HTMLUtils;
/**
 * Does the scrapping of a webpage.
 */
class Scrapper {

  /**
   * Loads paper information from the HTML and returns the array with the data.
   */
  public function scrap(\DOMDocument $dom): array {
    $papers = [];
    $aList = $dom->getElementsByTagName("a");
    $cardList = HTMLUtils::findElementsByAttributeAndValue('class', 'paper-card', $aList);

    foreach($cardList as $card) {
      $id = HTMLUtils::findElementsByAttributeAndValue('class', 'volume-info', $card->getElementsByTagName('div'))[0]->textContent;

        // Obter o título
        $title = HTMLUtils::findElementsByAttributeAndValue('class', 'paper-title', $card->childNodes)[0]->textContent;

        // Obter o tipo
        $divElements = $card->getElementsByTagName('div');

        foreach ($divElements as $divElement) {
            if ($divElement->hasAttribute('class') && $divElement->getAttribute('class') == 'tags mr-sm') {
                $type = $divElement->textContent;
                break; // Sai do loop assim que encontrar o elemento desejado
            }
        }
      
      $authors = [];
      $authorSpans = HTMLUtils::findElementsByAttributeAndValue('class', 'authors', $card->childNodes)[0]->getElementsByTagName('span');
      foreach ($authorSpans as $span) {
        $authorName = $span->textContent;
        $authorInstitution = $span->getAttribute('title');
        $authors[] = new Person($authorName, $authorInstitution);
    }
    $papers[] = new Paper($id, $title, $type, $authors);
    }
    return $papers; 
    // return [
    //   new Paper(
    //     123,
    //     'The Nobel Prize in Physiology or Medicine 2023',
    //     'Nobel Prize',
    //     [
    //       new Person('Katalin Karikó', 'Szeged University'),
    //       new Person('Drew Weissman', 'University of Pennsylvania'),
    //     ]
    //   ),
    // ];
  }

}
