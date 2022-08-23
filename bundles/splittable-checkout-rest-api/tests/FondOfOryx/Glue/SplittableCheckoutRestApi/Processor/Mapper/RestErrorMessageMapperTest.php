<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use FondOfOryx\Glue\SplittableCheckoutRestApi\Dependency\Client\SplittableCheckoutRestApiToGlossaryStorageClientInterface;
use Generated\Shared\Transfer\RestSplittableCheckoutErrorTransfer;
use Symfony\Component\HttpFoundation\Response;

class RestErrorMessageMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Dependency\Client\SplittableCheckoutRestApiToGlossaryStorageClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $glossaryStorageClientMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableCheckoutErrorTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableCheckoutErrorTransferMock;

    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestErrorMessageMapper
     */
    protected $restErrorMessageMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->glossaryStorageClientMock = $this->getMockBuilder(SplittableCheckoutRestApiToGlossaryStorageClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableCheckoutErrorTransferMock = $this->getMockBuilder(RestSplittableCheckoutErrorTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restErrorMessageMapper = new RestErrorMessageMapper($this->glossaryStorageClientMock);
    }

    /**
     * @return void
     */
    public function testFromRestSplittableCheckoutErrorAndLocaleName(): void
    {
        $localeName = 'en_US';
        $untranslated = 'x.x.x';
        $parameters = [];
        $translated = 'x';
        $errorCode = 100;

        $this->restSplittableCheckoutErrorTransferMock->expects(static::atLeastOnce())
            ->method('getMessage')
            ->willReturn($untranslated);

        $this->restSplittableCheckoutErrorTransferMock->expects(static::atLeastOnce())
            ->method('getParameters')
            ->willReturn($parameters);

        $this->glossaryStorageClientMock->expects(static::atLeastOnce())
            ->method('translate')
            ->with($untranslated, $localeName, $parameters)
            ->willReturn($translated);

        $this->restSplittableCheckoutErrorTransferMock->expects(static::atLeastOnce())
            ->method('getErrorCode')
            ->willReturn($errorCode);

        $restErrorMessageTransfer = $this->restErrorMessageMapper->fromRestSplittableCheckoutErrorAndLocaleName(
            $this->restSplittableCheckoutErrorTransferMock,
            $localeName,
        );

        static::assertEquals($translated, $restErrorMessageTransfer->getDetail());
        static::assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $restErrorMessageTransfer->getStatus());
        static::assertEquals((string)$errorCode, $restErrorMessageTransfer->getCode());
    }
}
