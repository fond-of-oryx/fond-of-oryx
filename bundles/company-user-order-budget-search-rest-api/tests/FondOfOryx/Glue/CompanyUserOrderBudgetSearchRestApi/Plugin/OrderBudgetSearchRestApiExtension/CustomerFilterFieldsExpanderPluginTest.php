<?php

namespace FondOfOryx\Glue\CompanyUserOrderBudgetSearchRestApi\Plugin\OrderBudgetSearchRestApiExtension;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Shared\CompanyUserOrderBudgetSearchRestApi\CompanyUserOrderBudgetSearchRestApiConstants;
use Generated\Shared\Transfer\RestUserTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CustomerFilterFieldsExpanderPluginTest extends Unit
{
    /**
     * @var \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestRequestInterface|MockObject $restRequestMock;

    /**
     * @var \Generated\Shared\Transfer\RestUserTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestUserTransfer|MockObject $restUserTransferMock;

    /**
     * @var \ArrayObject<\Generated\Shared\Transfer\FilterFieldTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected ArrayObject $filterFieldTransfers;

    /**
     * @var \FondOfOryx\Glue\CompanyUserOrderBudgetSearchRestApi\Plugin\OrderBudgetSearchRestApiExtension\CustomerFilterFieldsExpanderPlugin
     */
    protected CustomerFilterFieldsExpanderPlugin $plugin;

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

        $this->filterFieldTransfers = new ArrayObject();

        $this->plugin = new CustomerFilterFieldsExpanderPlugin();
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $surrogateIdentifier = '1';

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getRestUser')
            ->willReturn($this->restUserTransferMock);

        $this->restUserTransferMock->expects(static::atLeastOnce())
            ->method('getSurrogateIdentifier')
            ->willReturn($surrogateIdentifier);

        $filterFieldTransfers = $this->plugin->expand($this->restRequestMock, $this->filterFieldTransfers);

        static::assertCount(1, $filterFieldTransfers);

        $filterFieldTransfer = $filterFieldTransfers->offsetGet(0);

        static::assertEquals(CompanyUserOrderBudgetSearchRestApiConstants::FILTER_FIELD_TYPE_ID_CUSTOMER, $filterFieldTransfer->getType());
        static::assertEquals($surrogateIdentifier, $filterFieldTransfer->getValue());
    }

    /**
     * @return void
     */
    public function testExpandWithoutRestUser(): void
    {
        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getRestUser')
            ->willReturn(null);

        $filterFieldTransfers = $this->plugin->expand($this->restRequestMock, $this->filterFieldTransfers);

        static::assertCount(0, $filterFieldTransfers);
    }
}
