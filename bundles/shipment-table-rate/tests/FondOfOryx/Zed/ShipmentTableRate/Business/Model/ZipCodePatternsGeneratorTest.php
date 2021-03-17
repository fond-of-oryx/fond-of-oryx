<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Business\Model;

use Codeception\Test\Unit;

class ZipCodePatternsGeneratorTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ShipmentTableRate\Business\Model\ZipCodePatternsGeneratorInterface
     */
    protected $zipCodePatternsGenerator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->zipCodePatternsGenerator = new ZipCodePatternsGenerator();
    }

    /**
     * @return void
     */
    public function testGenerateFromZipCode(): void
    {
        $zipCode = '50827';
        $expectedZipCodePatterns = [
            '50827',
            '5082*',
            '508*',
            '50*',
            '5*',
            '*',
        ];

        $zipCodePatterns = $this->zipCodePatternsGenerator->generateFromZipCode($zipCode);

        $this->assertEquals($expectedZipCodePatterns, $zipCodePatterns);
    }
}
