<?php

namespace FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Expander\RestProductListUpdateRequestExpanderInterface;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;

class CompanyTypeProductListsRestApiFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\CompanyTypeProductListsRestApiBusinessFactory&\PHPUnit\Framework\MockObject\MockObject|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer&\PHPUnit\Framework\MockObject\MockObject|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restProductListUpdateRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\Expander\RestProductListUpdateRequestExpanderInterface&\PHPUnit\Framework\MockObject\MockObject|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restProductListUpdateRequestExpanderMock;

    /**
     * @var \FondOfOryx\Zed\CompanyTypeProductListsRestApi\Business\CompanyTypeProductListsRestApiFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(CompanyTypeProductListsRestApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListUpdateRequestTransferMock = $this->getMockBuilder(RestProductListUpdateRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListUpdateRequestExpanderMock = $this->getMockBuilder(RestProductListUpdateRequestExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CompanyTypeProductListsRestApiFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testExpandRestProductListUpdateRequest(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createRestProductListUpdateRequestExpander')
            ->willReturn($this->restProductListUpdateRequestExpanderMock);

        $this->restProductListUpdateRequestExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->restProductListUpdateRequestTransferMock)
            ->willReturn($this->restProductListUpdateRequestTransferMock);

        static::assertEquals(
            $this->restProductListUpdateRequestTransferMock,
            $this->facade->expandRestProductListUpdateRequest($this->restProductListUpdateRequestTransferMock),
        );
    }
}
