<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Business\Model;

class ZipCodePatternsGenerator implements ZipCodePatternsGeneratorInterface
{
    /**
     * @param string $zipCode
     *
     * @return string[]
     */
    public function generateFromZipCode(string $zipCode): array
    {
        $zipCodePatterns = [$zipCode];
        $zipCodePattern = $zipCode;

        while ($zipCodePattern !== '') {
            $zipCodePattern = substr($zipCodePattern, 0, -1);
            $zipCodePatterns[] = str_pad($zipCodePattern, strlen($zipCodePattern) + 1, '*', STR_PAD_RIGHT);
        }

        return $zipCodePatterns;
    }
}
