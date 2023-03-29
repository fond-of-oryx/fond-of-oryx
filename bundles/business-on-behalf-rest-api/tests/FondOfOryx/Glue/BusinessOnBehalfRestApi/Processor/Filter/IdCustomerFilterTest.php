<?php

namespace FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\Filter;

use Codeception\Test\Unit;
use FondOfOryx\Glue\ProductListsRestApi\Processor\Filter\IdCustomerFilter;
use Generated\Shared\Transfer\RestUserTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class IdCustomerFilterTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected RestRequestInterface|MockObject $restRequestMock;

    /**
     * @var \Generated\Shared\Transfer\RestUserTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|RestUserTransfer $restUserTransferMock;

    /**
     * @var \FondOfOryx\Glue\ProductListsRestApi\Processor\Filter\IdCustomerFilter
     */
    protected IdCustomerFilter $idCustomerFilter;

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

        $this->idCustomerFilter = new IdCustomerFilter();
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
            $this->idCustomerFilter->filterFromRestRequest($this->restRequestMock),
        );
    }
}
