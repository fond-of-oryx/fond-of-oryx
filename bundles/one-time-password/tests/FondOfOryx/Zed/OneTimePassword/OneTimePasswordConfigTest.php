<?php

namespace FondOfOryx\Zed\OneTimePassword;

use Codeception\Test\Unit;

class OneTimePasswordConfigTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\OneTimePassword\OneTimePasswordConfig
     */
    protected $oneTimePasswordConfig;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->oneTimePasswordConfig = new OneTimePasswordConfig();
    }

    /**
     * @return void
     */
    public function testGetAutoLoginPath(): void
    {
        $this->assertIsString(
            $this->oneTimePasswordConfig->getLoginLinkPath(),
        );
    }

    /**
     * @return void
     */
    public function testGetAutoLoginParameterName(): void
    {
        $this->assertIsString(
            $this->oneTimePasswordConfig->getLoginLinkParameterName(),
        );
    }

    /**
     * @return void
     */
    public function testAutoLoginOrderReferenceName(): void
    {
        $this->assertIsString(
            $this->oneTimePasswordConfig->getLoginLinkOrderReferenceName(),
        );
    }

    /**
     * @return void
     */
    public function testGetPasswordGeneratorUppercase(): void
    {
        $this->assertIsBool(
            $this->oneTimePasswordConfig->getPasswordGeneratorUppercase(),
        );
    }

    /**
     * @return void
     */
    public function testGetPasswordGeneratorLowercase(): void
    {
        $this->assertIsBool(
            $this->oneTimePasswordConfig->getPasswordGeneratorLowercase(),
        );
    }

    /**
     * @return void
     */
    public function testGetPasswordGeneratorNumbers(): void
    {
        $this->assertIsBool(
            $this->oneTimePasswordConfig->getPasswordGeneratorNumbers(),
        );
    }

    /**
     * @return void
     */
    public function testGetPasswordGeneratorSymbols(): void
    {
        $this->assertIsBool(
            $this->oneTimePasswordConfig->getPasswordGeneratorSymbols(),
        );
    }

    /**
     * @return void
     */
    public function testGetPasswordGeneratorSegmentLength(): void
    {
        $this->assertIsInt(
            $this->oneTimePasswordConfig->getPasswordGeneratorSegmentLength(),
        );
    }

    /**
     * @return void
     */
    public function testGetPasswordGeneratorSegmentCount(): void
    {
        $this->assertIsInt(
            $this->oneTimePasswordConfig->getPasswordGeneratorSegmentCount(),
        );
    }

    /**
     * @return void
     */
    public function testGetPasswordGeneratorSegmentSeparator(): void
    {
        $this->assertIsString(
            $this->oneTimePasswordConfig->getPasswordGeneratorSegmentSeparator(),
        );
    }
}
