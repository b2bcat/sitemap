<?php

namespace B2bcat\SiteMap\Storage;

use B2bcat\SiteMap\Writers\CsvWriter;
use B2bcat\SiteMap\Writers\JsonWriter;
use B2bcat\SiteMap\Writers\XmlWriter;

class WriterFactory
{
    /**
     * @var string
     */
    private string $fileType;

    /**
     * @var
     */
    private $writer;

    /**
     * @param string $fileType
     */
    public function __construct (string $fileType)
    {
        $this->setFileType($fileType);
    }

    /**
     * @return string
     */
    public function getFileType (): string
    {
        return $this->fileType;
    }

    /**
     * @param string $fileType
     */
    public function setFileType (string $fileType): void
    {
        $this->fileType = $fileType;
    }


    /**
     * @param $writer
     * @return void
     */
    public function setWriter ($writer): void
    {
        $this->writer = $writer;
    }


    /**
     * @return mixed
     */
    public function getWriter (): WriterInterface
    {
        if (!$this->writer) {
            switch ($this->getFileType()) {
                case File::TYPE_JSON:
                    $this->setWriter(new JsonWriter());
                    break;
                case File::TYPE_XML:
                    $this->setWriter(new XmlWriter());
                    break;
                case File::TYPE_CSV:
                    $this->setWriter(new CsvWriter());
                    break;
            }
        }
        return $this->writer;
    }
}
