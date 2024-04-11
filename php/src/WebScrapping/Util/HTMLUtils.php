<?php

namespace Chuva\Php\WebScrapping\Util;

/**
 * Class HTMLUtils provides utility functions for HTML parsing.
 */
class HTMLUtils {

    /**
     * Finds elements by attribute and value.
     *
     * @param string $attribute The attribute to search for.
     * @param string $value The value of the attribute.
     * @param array $tagList The list of HTML tags to search in.
     * @return array The elements found.
     */
    public static function findElementsByAttributeAndValue($attribute, $value, $tagList) {
        $elementsFound = [];

        foreach ($tagList as $tag) {
            $tagAttributeValue = $tag->getAttribute($attribute);

            if ($attribute === 'class') {
                $arrayClass = explode(' ', $tagAttributeValue);
                if (in_array($value, $arrayClass)) {
                    $elementsFound[] = $tag;
                }
            } elseif ($tagAttributeValue === $value) {
                $elementsFound[] = $tag;
            }
        }

        return $elementsFound;
    }

    /**
     * Finds an element by attribute and value.
     *
     * @param string $attribute The attribute to search for.
     * @param string $value The value of the attribute.
     * @param array $tagList The list of HTML tags to search in.
     * @return mixed|null The element found, or null if not found.
     */
    public static function findElementByAttributeAndValue($attribute, $value, $tagList) {
        foreach ($tagList as $tag) {
            $tagAttributeValue = $tag->getAttribute($attribute);

            if ($attribute === 'class') {
                $arrayClass = explode(' ', $tagAttributeValue);
                if (in_array($value, $arrayClass)) {
                    return $tag;
                }
            } elseif ($tagAttributeValue === $value) {
                return $tag;
            }
        }

        return null;
    }

    /**
     * Finds an element by class.
     *
     * @param \DOMDocument $dom The DOM document to search in.
     * @param string $className The class name to search for.
     * @return \DOMNodeList The elements found.
     */
    public static function findElementByClass($dom, $className) {
        $xPath = new \DOMXpath($dom);
        $elementsFound = $xPath->query("//*[@class='$className']");
        return $elementsFound;
    }
}
