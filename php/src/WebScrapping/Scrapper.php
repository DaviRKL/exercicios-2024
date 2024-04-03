<?php

namespace Chuva\Php\WebScrapping;

use Chuva\Php\WebScrapping\Entity\Paper;
use Chuva\Php\WebScrapping\Entity\Person;

/**
 * Does the scrapping of a webpage.
 */
class Scrapper {

  /**
   * Loads paper information from the HTML and returns the array with the data.
   */
  public function scrap(\DOMDocument $dom , string $className, string $elementTag, string $titleTag, string $typeTag, string $authorContainerTag, string $authorNameTag, string $authorInstitutionTag): array {
    $papers = [];

    $xpath = new \DOMXPath($dom);
    $elements = $xpath->query("//{$elementTag}[contains(@class, '{$className}')]");

    foreach($elements as $element) {
      $title = $xpath->query(".//{$titleTag}", $element)->item(0)->textContent;
      $type = $xpath->query(".//{$typeTag}", $element)->item(0)->textContent;

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
