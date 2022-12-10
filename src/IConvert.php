<?php

namespace Nicholasricci\AnprIstatRegistry;

interface IConvert
{
    function convert(): void;
    function getData(): string;
}