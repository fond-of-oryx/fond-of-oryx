<?php

namespace FondOfOryx\Zed\ApiAuth\Business\Model;

use Codeception\Test\Unit;

class BasicTokenTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ApiAuth\Business\Model\BasicToken
     */
    protected $basicToken;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->basicToken = new BasicToken('VDNTVDp0MyR0');
    }

    /**
     * @return void
     */
    public function testGetAndSetRawToken(): void
    {
        $rawToken = 'dGVzdDp0MyR0';

        $this->basicToken->setRawToken($rawToken);

        $this->assertEquals($rawToken, $this->basicToken->getRawToken());
    }

    /**
     * @return void
     */
    public function testCheck(): void
    {
        $this->assertTrue($this->basicToken->check('VDNTVDp0MyR0'));
    }

    /**
     * @return void
     */
    public function testCheckWithWrongRawToken(): void
    {
        $this->assertFalse($this->basicToken->check('dGVzdDp0MyR0'));
    }
}
