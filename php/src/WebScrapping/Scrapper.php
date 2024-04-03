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

    foreach($cardList as $key => $value) {
      $title = HTMLUtils::findElementsByClass('class', 'paper-title', $value->childNodes)->nodeValue;
      $type =  HTMLUtils::findElementsByClass($doc, 'tags mr-sm')->item($key)->textContent;

      $authors = [];
      $authorContainers = $xpath->query(".//{$authorContainerTag}", $element);

      foreach ($authorContainers as $authorContainer) {
        $authorName = $xpath->query(".//{$authorNameTag}", $authorContainer)->item(0)->textContent;
        $authorInstitution = $xpath->query(".//{$authorInstitutionTag}", $authorContainer)->item(0)->textContent;

        $authors[] = new Person($authorName, $authorInstitution);
    }
    $papers[] = new Paper($title, $type, $authors);
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
