<?php

namespace FondOfOryx\Zed\BusinessOnBehalfRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\BusinessOnBehalfRestApi\Business\BusinessOnBehalfRestApiBusinessFactory;
use FondOfOryx\Zed\BusinessOnBehalfRestApi\Business\Writer\CompanyUserWriterInterface;
use Generated\Shared\Transfer\RestBusinessOnBehalfRequestTransfer;
use Generated\Shared\Transfer\RestBusinessOnBehalfResponseTransfer;

class BusinessOnBehalfRestApiFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfRestApi\Business\BusinessOnBehalfRestApiBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfRestApi\Business\Writer\CompanyUserWriterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUserWritterMock;

    /**
     * @var \Generated\Shared\Transfer\RestBusinessOnBehalfRequestTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restBusinessOnBehalfRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestBusinessOnBehalfResponseTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restBusinessOnBehalfResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfRestApi\Business\BusinessOnBehalfRestApiFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(BusinessOnBehalfRestApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserWritterMock = $this->getMockBuilder(CompanyUserWriterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restBusinessOnBehalfRequestTransferMock = $this
            ->getMockBuilder(RestBusinessOnBehalfRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restBusinessOnBehalfRequestTransferMock = $this
            ->getMockBuilder(RestBusinessOnBehalfRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restBusinessOnBehalfResponseTransferMock = $this
            ->getMockBuilder(RestBusinessOnBehalfResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new BusinessOnBehalfRestApiFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testSetDefaultCompanyUserByRestBusinessOnBehalfRequest(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createCompanyUserWriter')
            ->willReturn($this->companyUserWritterMock);

        $this->companyUserWritterMock->expects(static::atLeastOnce())
            ->method('setDefaultByRestBusinessOnBehalfRequest')
            ->with($this->restBusinessOnBehalfRequestTransferMock)
            ->willReturn($this->restBusinessOnBehalfResponseTransferMock);

        static::assertEquals(
            $this->restBusinessOnBehalfResponseTransferMock,
            $this->facade->setDefaultCompanyUserByRestBusinessOnBehalfRequest($this->restBusinessOnBehalfRequestTransferMock),
        );
    }
}
