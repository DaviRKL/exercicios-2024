<?php

namespace Chuva\Php\WebScrapping;

use Box\Spout\Writer\Common\Creator\WriterEntityFactory;

/**
 * Class SpreadsheetCreator
 *
 * This class provides functionality to create a spreadsheet from given data.
 */
class SpreadsheetCreator
{
    /**
     * Creates a spreadsheet from provided data and saves it to the specified file path.
     *
     * @param  array  $data     The data to be included in the spreadsheet.
     * @param  string $filePath The file path where the spreadsheet will be saved.
     * @return void
     */
    public static function createSpreadsheet(array $data, string $filePath): void
    {
        $writer = WriterEntityFactory::createXLSXWriter();

        $writer->openToFile($filePath);

        $headerRow = WriterEntityFactory::createRowFromArray(['ID', 'Title', 'Type', 'Authors']);
        $writer->addRow($headerRow);

        foreach ($data as $paper) {
            $paperRow = WriterEntityFactory::createRowFromArray(
                [
                $paper->getId(),
                $paper->getTitle(),
                $paper->getType(),
                implode(
                    ", ", array_map(
                        function ($author) {
                            return $author->getName() . " (" . $author->getInstitution() . ")";
                        }, $paper->getAuthors()
                    )
                )
                ]
            );
            $writer->addRow($paperRow);
        }
        $writer->close();
    }
}
