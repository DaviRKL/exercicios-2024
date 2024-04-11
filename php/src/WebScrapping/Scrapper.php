<?php

namespace Chuva\Php\WebScrapping;

use Chuva\Php\WebScrapping\Entity\Paper;
use Chuva\Php\WebScrapping\Entity\Person;
use Chuva\Php\WebScrapping\Util\HTMLUtils;

/**
 * Class Scrapper
 *
 * This class provides functionality to scrape data from a DOMDocument.
 */
class Scrapper
{
    /**
     * Scrapes data from a DOMDocument and returns an array of Paper objects.
     *
     * @param \DOMDocument $dom The DOMDocument to be scraped.
     * @return array An array of Paper objects.
     */
    public function scrap(\DOMDocument $dom): array
    {
        $papers = [];
        $aList = $dom->getElementsByTagName("a");
        $cardList = HTMLUtils::findElementsByAttributeAndValue('class', 'paper-card', $aList);

        foreach ($cardList as $card) {
            $id = HTMLUtils::findElementsByAttributeAndValue('class', 'volume-info', $card->getElementsByTagName('div'))[0]->textContent;

            $title = HTMLUtils::findElementsByAttributeAndValue('class', 'paper-title', $card->childNodes)[0]->textContent;

            $divElements = $card->getElementsByTagName('div');

            foreach ($divElements as $divElement) {
                if ($divElement->hasAttribute('class') && $divElement->getAttribute('class') == 'tags mr-sm') {
                    $type = $divElement->textContent;
                    break;
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
    }
}
