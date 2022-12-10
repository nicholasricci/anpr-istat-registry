<?php
declare(strict_types=1);

namespace Nicholasricci\AnprIstatRegistry;

use Exception;
use Nicholasricci\AnprIstatRegistry\ANPR\ConvertCsvToJson;
use PHPUnit\Framework\TestCase;

class AnprComuniLoaderTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testAnprComuniConvertCsvToJson(): void
    {
        $converter = new ConvertCsvToJson(__DIR__ . '/../fixtures/ANPR/ANPR_archivio_comuni.csv');
        $converter->convert();
        $data = $converter->getData();
        $arrayData = json_decode($data, true);
        $this->assertGreaterThan(0, count($arrayData));
    }

    public function testAnprComuniGetData(): void
    {
        $anprComuniLoader = new AnprComuniLoader();
        $data = $anprComuniLoader->getData();
        $arrayData = json_decode($data, true);
        $this->assertGreaterThan(0, count($arrayData));
    }

    public function testRunner(): void
    {
        $comuniFileName = __DIR__ . '/../dist/comuni.json';
        unlink($comuniFileName);

        $runner = new Runner();
        $runner->executeAll();

        $this->assertFileExists(__DIR__ . '/../dist/comuni.json');
    }
}