<?php

namespace Nicholasricci\AnprIstatRegistry\ANPR;
use Nicholasricci\AnprIstatRegistry\IConvert;

class ConvertCsvToJson implements IConvert
{
    private string $json;

    private array $csvKeys = [
        "﻿\"ID\"",
        "DATAISTITUZIONE",
        "DATACESSAZIONE",
        "CODISTAT",
        "CODCATASTALE",
        "DENOMINAZIONE_IT",
        "DENOMTRASLITTERATA",
        "ALTRADENOMINAZIONE",
        "ALTRADENOMTRASLITTERATA",
        "ID_PROVINCIA",
        "IDPROVINCIAISTAT",
        "IDREGIONE",
        "IDPREFETTURA",
        "STATO",
        "SIGLAPROVINCIA",
        "FONTE",
        "DATAULTIMOAGG",
        "COD_DENOM"
    ];

    private array $jsonKeys = [
        "id",
        "institution_date",
        "end_date",
        "istat_id",
        "registry_code",
        "name_it",
        "name_transliterated",
        "alternative_name",
        "alternative_name_transliterated",
        "province_id",
        "istat_province_id",
        "istat_region_id",
        "istat_prefecture_id",
        "status",
        "istat_province_code",
        "source",
        "last_update",
        "istat_discontinued_code"
    ];

    public function __construct(
        private string $sourceFileName
    ) { }

    /**
     * @throws \Exception
     */
    function convert(): void
    {
        $data = [];
        if ($sourceFile = fopen($this->sourceFileName, 'r')) {
            $i = 0;
            while (($line = fgetcsv($sourceFile))) {
                $arrLine = [];
                if ($i === 0) {
                    if (count(array_diff($this->csvKeys, $line)) > 0) {
                        throw new \Exception('Header is not valid!');
                    }
                    $i++;
                    continue;
                }
                foreach ($line as $j => $field) {
                    if ($j === 13) {
                        $arrLine[$this->jsonKeys[$j]] = $field === 'C' ? 'discontinued' : 'active';
                    } else {
                        $arrLine[$this->jsonKeys[$j]] = $field;
                    }
                }
                $data[] = $arrLine;
            }
            fclose($sourceFile);
        }
        $this->json = json_encode($data);
    }

    function getData(): string
    {
        return $this->json;
    }
}