<?php

namespace FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\BusinessOnBehalf;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Client\BusinessOnBehalfRestApi\BusinessOnBehalfRestApiClientInterface;
use FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\Filter\IdCustomerFilterInterface;
use FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\Mapper\RestBusinessOnBehalfRequestMapperInterface;
use Generated\Shared\Transfer\RestBusinessOnBehalfErrorTransfer;
use Generated\Shared\Transfer\RestBusinessOnBehalfRequestAttributesTransfer;
use Generated\Shared\Transfer\RestBusinessOnBehalfRequestTransfer;
use Generated\Shared\Transfer\RestBusinessOnBehalfResponseTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class BusinessOnBehalfProcessorTest extends Unit
{
    /**
     * @var (\FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\Filter\IdCustomerFilterInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected IdCustomerFilterInterface|MockObject $idCustomerFilterMock;

    /**
     * @var (\FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\Mapper\RestBusinessOnBehalfRequestMapperInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|RestBusinessOnBehalfRequestMapperInterface $restBusinessOnBehalfRequestMapperMock;

    /**
     * @var (\FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\Builder\RestResponseBuilderInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|RestResponseBuilderInterface $restResponseBuilderMock;

    /**
     * @var (\FondOfOryx\Client\BusinessOnBehalfRestApi\BusinessOnBehalfRestApiClientInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected BusinessOnBehalfRestApiClientInterface|MockObject $clientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected RestRequestInterface|MockObject $restRequestMock;

    /**
     * @var (\Generated\Shared\Transfer\RestBusinessOnBehalfRequestAttributesTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|RestBusinessOnBehalfRequestAttributesTransfer $restBusinessOnBehalfRequestAttributesTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected RestResponseInterface|MockObject $restResponseMock;

    /**
     * @var (\Generated\Shared\Transfer\RestBusinessOnBehalfRequestTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|RestBusinessOnBehalfRequestTransfer $restBusinessOnBehalfRequestTransferMock;

    /**
     * @var (\Generated\Shared\Transfer\RestBusinessOnBehalfResponseTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|RestBusinessOnBehalfResponseTransfer $restBusinessOnBehalfResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestBusinessOnBehalfErrorTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestBusinessOnBehalfErrorTransfer|MockObject $restBusinessOnBehalfErrorTransferMock;

    /**
     * @var \FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\BusinessOnBehalf\BusinessOnBehalfProcessor
     */
    protected BusinessOnBehalfProcessor $processor;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->idCustomerFilterMock = $this->getMockBuilder(IdCustomerFilterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restBusinessOnBehalfRequestMapperMock = $this->getMockBuilder(RestBusinessOnBehalfRequestMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseBuilderMock = $this->getMockBuilder(RestResponseBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->clientMock = $this->getMockBuilder(BusinessOnBehalfRestApiClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restBusinessOnBehalfRequestAttributesTransferMock = $this->getMockBuilder(RestBusinessOnBehalfRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restBusinessOnBehalfRequestTransferMock = $this->getMockBuilder(RestBusinessOnBehalfRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restBusinessOnBehalfResponseTransferMock = $this->getMockBuilder(RestBusinessOnBehalfResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restBusinessOnBehalfErrorTransferMock = $this->getMockBuilder(RestBusinessOnBehalfErrorTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->processor = new BusinessOnBehalfProcessor(
            $this->idCustomerFilterMock,
            $this->restBusinessOnBehalfRequestMapperMock,
            $this->restResponseBuilderMock,
            $this->clientMock,
        );
    }

    /**
     * @return void
     */
    public function testSetDefaultCompanyUser(): void
    {
        $idCustomer = 1;

        $this->restBusinessOnBehalfRequestMapperMock->expects(static::atLeastOnce())
            ->method('fromRestBusinessOnBehalfRequestAttributes')
            ->with($this->restBusinessOnBehalfRequestAttributesTransferMock)
            ->willReturn($this->restBusinessOnBehalfRequestTransferMock);

        $this->idCustomerFilterMock->expects(static::atLeastOnce())
            ->method('filterFromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($idCustomer);

        $this->restBusinessOnBehalfRequestTransferMock->expects(static::atLeastOnce())
            ->method('setIdCustomer')
            ->with($idCustomer)
            ->willReturn($this->restBusinessOnBehalfRequestTransferMock);

        $this->clientMock->expects(static::atLeastOnce())
            ->method('setDefaultCompanyUserByRestBusinessOnBehalfRequest')
            ->with($this->restBusinessOnBehalfRequestTransferMock)
            ->willReturn($this->restBusinessOnBehalfResponseTransferMock);

        $this->restBusinessOnBehalfResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->restResponseBuilderMock->expects(static::atLeastOnce())
            ->method('buildEmptyRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restBusinessOnBehalfResponseTransferMock->expects(static::never())
            ->method('getErrors');

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildErrorRestResponse');

        static::assertEquals(
            $this->restResponseMock,
            $this->processor->setDefaultCompanyUser(
                $this->restRequestMock,
                $this->restBusinessOnBehalfRequestAttributesTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testSetDefaultCompanyUserWithErrors(): void
    {
        $idCustomer = 1;
        $errors = new ArrayObject([$this->restBusinessOnBehalfErrorTransferMock]);

        $this->restBusinessOnBehalfRequestMapperMock->expects(static::atLeastOnce())
            ->method('fromRestBusinessOnBehalfRequestAttributes')
            ->with($this->restBusinessOnBehalfRequestAttributesTransferMock)
            ->willReturn($this->restBusinessOnBehalfRequestTransferMock);

        $this->idCustomerFilterMock->expects(static::atLeastOnce())
            ->method('filterFromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($idCustomer);

        $this->restBusinessOnBehalfRequestTransferMock->expects(static::atLeastOnce())
            ->method('setIdCustomer')
            ->with($idCustomer)
            ->willReturn($this->restBusinessOnBehalfRequestTransferMock);

        $this->clientMock->expects(static::atLeastOnce())
            ->method('setDefaultCompanyUserByRestBusinessOnBehalfRequest')
            ->with($this->restBusinessOnBehalfRequestTransferMock)
            ->willReturn($this->restBusinessOnBehalfResponseTransferMock);

        $this->restBusinessOnBehalfResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(false);

        $this->restBusinessOnBehalfResponseTransferMock->expects(static::atLeastOnce())
            ->method('getErrors')
            ->willReturn($errors);

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildEmptyRestResponse');

        $this->restResponseBuilderMock->expects(static::atLeastOnce())
            ->method('buildErrorRestResponse')
            ->with($errors)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->processor->setDefaultCompanyUser(
                $this->restRequestMock,
                $this->restBusinessOnBehalfRequestAttributesTransferMock,
            ),
        );
    }
}
