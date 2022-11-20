<?php

namespace B2bcat\SiteMap\Writers;

use B2bcat\SiteMap\Storage\Writer;
use B2bcat\SiteMap\Storage\WriterInterface;

class CsvWriter extends Writer implements WriterInterface
{
    protected function writeFile (): Writer
    {
        $data = $this->getPreparedData();
        $file = $this->getFilePointer();

        foreach ($data as $row) {
            fputcsv($file, $row);
        }
        return $this;
    }


    protected function getPreparedData (): array
    {
        $data = $this->getData();
        return array_merge([array_keys($data[0])], $data);
    }
}
