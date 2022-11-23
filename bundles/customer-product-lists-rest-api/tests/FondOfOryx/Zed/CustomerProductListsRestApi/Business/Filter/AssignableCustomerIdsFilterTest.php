<?php

namespace FondOfOryx\Zed\CustomerProductListsRestApi\Business\Filter;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerProductListsRestApi\Persistence\CustomerProductListsRestApiRepositoryInterface;
use Generated\Shared\Transfer\RestProductListsAttributesTransfer;

class AssignableCustomerIdsFilterTest extends Unit
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
     * @var \FondOfOryx\Zed\CustomerProductListsRestApi\Business\Filter\AssignableCustomerIdsFilter
     */
    protected $assignableCustomerIdsFilter;

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

        $this->assignableCustomerIdsFilter = new AssignableCustomerIdsFilter($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testFilter(): void
    {
        $assignedCustomerIds = [1, 2, 3, 5];
        $customerReferencesToAssign = ['foo-1', 'foo-4'];
        $customerIdsToAssign = [1, 4];

        $this->restProductListsAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerIdsToAssign')
            ->willReturn($customerReferencesToAssign);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getCustomerIdsByCustomerReferences')
            ->with($customerReferencesToAssign)
            ->willReturn($customerIdsToAssign);

        static::assertEquals(
            [4],
            $this->assignableCustomerIdsFilter->filter(
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
        $customerReferencesToAssign = ['foo-1', 'foo-4'];
        $customerIdsToAssign = [];

        $this->restProductListsAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerIdsToAssign')
            ->willReturn($customerReferencesToAssign);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getCustomerIdsByCustomerReferences')
            ->with($customerReferencesToAssign)
            ->willReturn($customerIdsToAssign);

        static::assertEquals(
            [],
            $this->assignableCustomerIdsFilter->filter(
                $assignedCustomerIds,
                $this->restProductListsAttributesTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testFilterWithoutCustomerIdsToAssign(): void
    {
        $assignedCustomerIds = [1, 2, 3, 5];
        $customerReferencesToAssign = [];

        $this->restProductListsAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerIdsToAssign')
            ->willReturn($customerReferencesToAssign);

        $this->repositoryMock->expects(static::never())
            ->method('getCustomerIdsByCustomerReferences');

        static::assertEquals(
            [],
            $this->assignableCustomerIdsFilter->filter(
                $assignedCustomerIds,
                $this->restProductListsAttributesTransferMock,
            ),
        );
    }
}
