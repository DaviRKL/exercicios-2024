<?php

namespace Chuva\Php\WebScrapping;

use Box\Spout\Writer\Common\Creator\WriterEntityFactory;

/**
 * Class SpreadsheetCreator.
 *
 * This class provides functionality to create a spreadsheet from given data.
 */
class SpreadsheetCreator {

  /**
   * Creates a spreadsheet from provided data and saves it in a file path.
   *
   * @param array $data
   *   The data to be included in the spreadsheet.
   * @param string $filePath
   *   The file path where the spreadsheet will be saved.
   *
   * @return void
   *   No return value is expected.
   */
  public static function createSpreadsheet(array $data, string $filePath): void {
    $writer = WriterEntityFactory::createXLSXWriter();
    $writer->openToFile($filePath);

    $headerRow = WriterEntityFactory::createRowFromArray(['ID', 'Title', 'Type', 'Author 1', 'Author 1 Institution', 'Author 2', 'Author 2 Institution', 'Author 3', 'Author 3 Institution', 'Author 4', 'Author 4 Institution', 'Author 5', 'Author 5 Institution', 'Author 6', 'Author 6 Institution', 'Author 7', 'Author 7 Institution', 'Author 8', 'Author 8 Institution', 'Author 9', 'Author 9 Institution', 'Author 10', 'Author 10 Institution', 'Author 11', 'Author 11 Institution', 'Author 12', 'Author 12 Institution', 'Author 13', 'Author 13 Institution', 'Author 14', 'Author 14 Institution', 'Author 15', 'Author 15 Institution', 'Author 16', 'Author 16 Institution',
    ]);

    $writer->addRow($headerRow);

    foreach ($data as $paper) {
      foreach ($paper->getAuthors() as $index => $author) {
        $authors["Author " . ($index + 1)] = $author->getName();
        $authors["Author " . ($index + 1) . "Institution"] = $author->getInstitution();
      }

      $paperRow = WriterEntityFactory::createRowFromArray([
        $paper->getId(),
        $paper->getTitle(),
        $paper->getType(),
        ...$authors,
      ]);
      $writer->addRow($paperRow);
    }

    $writer->close();
  }

}
