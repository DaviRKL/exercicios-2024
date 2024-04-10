<?php

namespace Chuva\Php\WebScrapping;

use Box\Spout\Writer\Common\Creator\WriterEntityFactory;

class SpreadsheetCreator
{
    /**
     * Cria uma planilha utilizando os dados passados e salva ela em uma pasta especificada na classe Main.
     * 
     * @param array $data    Os dados a serem incluidos na planilha.
     * @param string $filePath A pasta onde a planilha será salva.
     * @return void
     */
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