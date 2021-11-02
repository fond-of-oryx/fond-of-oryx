<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Business\Model;

interface ZipCodePatternsGeneratorInterface
{
    /**
     * @param string $zipCode
     *
     * @return array<string>
     */
    public function generateFromZipCode(string $zipCode): array;
}
