<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\RestUserTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class RepresentationMapperTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected $restResourceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestUserTransfer
     */
    protected $restUserTransferMock;

    /**
     * @var \FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Mapper\RepresentationMapperInterface
     */
    protected $representationMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceMock = $this->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restUserTransferMock = $this->getMockBuilder(RestUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representationMapper = new RepresentationMapper();
    }

    /**
     * @return void
     */
    public function testCreateRequest(): void
    {
        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getAttributesDataFromRequest')
            ->willReturn([]);

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getRestUser')
            ->willReturn($this->restUserTransferMock);

        $this->restUserTransferMock->expects(static::atLeastOnce())
            ->method('getNaturalIdentifier')
            ->willReturn(null);

        $requestTransfer = $this->representationMapper->createRequest($this->restRequestMock);

        static::assertNotNull($requestTransfer->getAttributes());
    }

    /**
     * @return void
     */
    public function testCreateAttributesFromRequest(): void
    {
        $id = 'id';
        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getAttributesDataFromRequest')
            ->willReturn([]);

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getRestUser')
            ->willReturn($this->restUserTransferMock);

        $this->restUserTransferMock->expects(static::atLeastOnce())
            ->method('getNaturalIdentifier')
            ->willReturn($id);

        $requestTransfer = $this->representationMapper->createRequest($this->restRequestMock);

        static::assertNotNull($requestTransfer->getAttributes());
        static::assertSame($requestTransfer->getAttributes()->getReferenceOriginator(), $id);
    }
}
