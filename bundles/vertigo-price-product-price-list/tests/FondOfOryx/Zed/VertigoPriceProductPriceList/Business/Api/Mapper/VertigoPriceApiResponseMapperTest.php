<?php

namespace FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Api\Mapper;

use Codeception\Test\Unit;
use Psr\Http\Message\ResponseInterface;

class VertigoPriceApiResponseMapperTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Psr\Http\Message\ResponseInterface
     */
    protected $responseMock;

    /**
     * @var \FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Api\Mapper\VertigoPriceApiResponseMapper
     */
    protected $vertigoPriceApiResponseMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->responseMock = $this->getMockBuilder(ResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->vertigoPriceApiResponseMapper = new VertigoPriceApiResponseMapper();
    }

    /**
     * @return void
     */
    public function testFromResponse(): void
    {
        $statusCode = 202;

        $this->responseMock->expects(static::atLeastOnce())
            ->method('getStatusCode')
            ->willReturn($statusCode);

        $vertigoPriceApiResponseTransfer = $this->vertigoPriceApiResponseMapper->fromResponse($this->responseMock);

        static::assertEquals(
            $statusCode,
            $vertigoPriceApiResponseTransfer->getStatus(),
        );

        static::assertTrue($vertigoPriceApiResponseTransfer->getIsSuccessful());
    }
}
