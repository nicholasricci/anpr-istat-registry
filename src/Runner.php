<?php

namespace Nicholasricci\AnprIstatRegistry;

class Runner
{
    public function executeAll(): void
    {
        $this->executeAnprComuniLoader();
    }

    protected function executeAnprComuniLoader(): void
    {
        $anprComuniLoader = new AnprComuniLoader();
        $json = $anprComuniLoader->getData();
        $file = fopen(__DIR__ . '/../dist/comuni.json', 'w');
        fwrite($file, $json);
        fclose($file);
    }
}