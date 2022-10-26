<?php

namespace FondOfOryx\Zed\CustomerProductListsRestApi\Business\Filter;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerProductListsRestApi\Persistence\CustomerProductListsRestApiRepositoryInterface;
use Generated\Shared\Transfer\RestProductListsAttributesTransfer;

class DeassignableCustomerIdsFilterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerProductListsRestApi\Persistence\CustomerProductListsRestApiRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\RestProductListsAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restProductListsAttributesTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListsRestApi\Business\Filter\DeassignableCustomerIdsFilter
     */
    protected $deassignableCustomerIdsFilter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(CustomerProductListsRestApiRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListsAttributesTransferMock = $this->getMockBuilder(RestProductListsAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->deassignableCustomerIdsFilter = new DeassignableCustomerIdsFilter($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testFilter(): void
    {
        $assignedCustomerIds = [1, 2, 3, 5];
        $customerReferencesToDeassign = ['foo-1', 'foo-4'];
        $customerIdsToDeassign = [1, 4];

        $this->restProductListsAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerIdsToDeassign')
            ->willReturn($customerReferencesToDeassign);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getCustomerIdsByCustomerReferences')
            ->with($customerReferencesToDeassign)
            ->willReturn($customerIdsToDeassign);

        static::assertEquals(
            [1],
            $this->deassignableCustomerIdsFilter->filter(
                $assignedCustomerIds,
                $this->restProductListsAttributesTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testFilterWithNonExistingCustomerReference(): void
    {
        $assignedCustomerIds = [1, 2, 3, 5];
        $customerReferencesToDeassign = ['foo-1', 'foo-4'];
        $customerIdsToDeassign = [];

        $this->restProductListsAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerIdsToDeassign')
            ->willReturn($customerReferencesToDeassign);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getCustomerIdsByCustomerReferences')
            ->with($customerReferencesToDeassign)
            ->willReturn($customerIdsToDeassign);

        static::assertEquals(
            [],
            $this->deassignableCustomerIdsFilter->filter(
                $assignedCustomerIds,
                $this->restProductListsAttributesTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testFilterWithoutCustomerIdsToDeassign(): void
    {
        $assignedCustomerIds = [1, 2, 3, 5];
        $customerReferencesToDeassign = [];

        $this->restProductListsAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerIdsToDeassign')
            ->willReturn($customerReferencesToDeassign);

        $this->repositoryMock->expects(static::never())
            ->method('getCustomerIdsByCustomerReferences');

        static::assertEquals(
            [],
            $this->deassignableCustomerIdsFilter->filter(
                $assignedCustomerIds,
                $this->restProductListsAttributesTransferMock,
            ),
        );
    }
}
