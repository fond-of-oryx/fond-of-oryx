<?php

namespace FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\RestUserTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CustomerIdFilterTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface|mixed
     */
    protected $restRequestMock;

    /**
     * @var \Generated\Shared\Transfer\RestUserTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restUserTransferMock;

    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\CustomerReferenceFilter
     */
    protected $CustomerIdFilter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restUserTransferMock = $this->getMockBuilder(RestUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->CustomerIdFilter = new CustomerIdFilter();
    }

    /**
     * @return void
     */
    public function testFilterFromRestRequest(): void
    {
        $idCustomer = 1;

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getRestUser')
            ->willReturn($this->restUserTransferMock);

        $this->restUserTransferMock->expects(static::atLeastOnce())
            ->method('getSurrogateIdentifier')
            ->willReturn($idCustomer);

        static::assertEquals(
            $idCustomer,
            $this->CustomerIdFilter->filterFromRestRequest($this->restRequestMock),
        );
    }
}
