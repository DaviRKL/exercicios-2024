<?php

namespace Chuva\Php\WebScrapping\Util;

class HTMLUtils {
    
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

    public static function findElementByClass($dom, $className) {
        $xPath = new \DOMXpath($dom);
        $elementsFound = $xPath->query("//*[@class='$className']");
        return $elementsFound;
    }
}
