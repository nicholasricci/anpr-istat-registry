<?php

namespace Nicholasricci\AnprIstatRegistry;

use Nicholasricci\AnprIstatRegistry\ANPR\ConvertCsvToJson;

class AnprComuniLoader extends AbstractLoader
{
    public function __construct()
    {
        parent::__construct(
            'https://www.anagrafenazionale.interno.it/wp-content/uploads/ANPR_archivio_comuni.csv',
            ConvertCsvToJson::class
        );
    }
}