<?php

namespace B2bcat\SiteMap\Storage;

abstract class Writer implements WriterInterface
{
    /**
     * @var array
     */
    private array $data;

    /**
     * @var string
     */
    private string $filePath;

    /**
     * @var string
     */
    protected string $fileOpenMode = 'w+';

    /**
     * @var mixed
     */
    protected mixed $filePointer;

    /**
     * @return array
     */
    public function getData (): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     * @return Writer
     */
    public function setData (array $data): WriterInterface
    {
        $this->data = $data;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getFilePointer (): mixed
    {
        return $this->filePointer;
    }


    /**
     * @param $fileHandler
     * @return $this
     */
    public function setFilePointer ($fileHandler): Writer
    {
        $this->filePointer = $fileHandler;
        return $this;
    }

    /**
     * @return string
     */
    public function getFileMode (): string
    {
        return $this->fileOpenMode;
    }

    /**
     * @param string $fileOpenMode
     */
    public function setFileOpenMode (string $fileOpenMode): void
    {
        $this->fileOpenMode = $fileOpenMode;
    }

    /**
     * @return string
     */
    public function getFilePath (): string
    {
        return $this->filePath;
    }

    /**
     * @param string $filePath
     * @return Writer
     */
    public function setFilePath (string $filePath): WriterInterface
    {
        $this->filePath = $filePath;
        return $this;
    }

    /**
     * @return string
     */
    protected function getParentDirPath (): string
    {
        return dirname($this->getFilePath());
    }


    /**
     * @return $this
     */
    protected function openFile (): Writer
    {
        $fp = fopen($this->getFilePath(), $this->getFileMode());
        $this->setFilePointer($fp);

        return $this;
    }

    /**
     * @return $this
     */
    protected function closeFile (): Writer
    {
        fclose($this->getFilePointer());

        return $this;
    }

    /**
     * @return mixed
     */
    abstract protected function getPreparedData(): mixed;

    /**
     * @return $this
     */
    protected function writeFile (): Writer
    {
        fwrite($this->getFilePointer(), $this->getPreparedData());

        return $this;
    }

    /**
     * @return $this
     */
    protected function createParentDirsIfNeeded (): Writer
    {
        if (!is_dir($this->getParentDirPath())) {
            mkdir($this->getParentDirPath(), recursive: true);
        }
        return  $this;
    }

    /**
     * @return void
     */
    public function write (): void
    {
        $this
            ->createParentDirsIfNeeded()
            ->openFile()
            ->writeFile()
            ->closeFile();

    }

}
