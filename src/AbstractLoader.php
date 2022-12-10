<?php

namespace Nicholasricci\AnprIstatRegistry;

use Exception;

abstract class AbstractLoader implements ILoader
{
    protected string $data;

    /**
     * @throws Exception
     */
    public function __construct(
        private string $url,
        string $converterClass
    ) {
        $fileName = $this->downloadContent();
        /** @var IConvert $converter */
        $converter = new $converterClass($fileName);
        $converter->convert();
        $this->data = $converter->getData();
    }

    protected function downloadContent(): string
    {
        $tmpFileName = tempnam(sys_get_temp_dir(), 'source');
        $tmpFile = fopen($tmpFileName, 'w');
        fwrite($tmpFile, file_get_contents($this->url));
        fclose($tmpFile);

        return $tmpFileName;
    }

    public function getData(): string
    {
        return $this->data;
    }
}