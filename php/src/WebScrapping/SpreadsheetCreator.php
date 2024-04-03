<?php
namespace Chuva\Php\WebScrapping;

use Box\Spout\Writer\Common\Creator\WriterEntityFactory;

class SpreadsheetCreator
{
    public static function createSpreadsheet(array $data, string $filePath): void
    {
        $writer = WriterEntityFactory::createXLSXWriter();

        $writer->openToFile($filePath);

        $headerRow = WriterEntityFactory::createRowFromArray(['ID', 'Title', 'Type', 'Authors']);
        $writer->addRow($headerRow);

        foreach ($data as $paper) {
            $paperRow = WriterEntityFactory::createRowFromArray([
                $paper->getId(),
                $paper->getTitle(),
                $paper->getType(),
                implode(", ", array_map(function ($author) {
                    return $author->getName() . " (" . $author->getInstitution() . ")";
                }, $paper->getAuthors()))
            ]);
            $writer->addRow($paperRow);
        }
        $writer->close();
    }
}