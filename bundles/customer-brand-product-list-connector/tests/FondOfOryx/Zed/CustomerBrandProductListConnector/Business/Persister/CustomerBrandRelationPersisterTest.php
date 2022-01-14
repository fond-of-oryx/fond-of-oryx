<?php

namespace FondOfOryx\Zed\CustomerBrandProductListConnector\Business\Persister;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerBrandProductListConnector\Business\Reader\BrandReaderInterface;
use FondOfOryx\Zed\CustomerBrandProductListConnector\Dependecny\Facade\CustomerBrandProductListConnectorToBrandCustomerFacadeInterface;
use Generated\Shared\Transfer\CustomerBrandRelationTransfer;
use Generated\Shared\Transfer\CustomerProductListRelationTransfer;

class CustomerBrandRelationPersisterTest extends Unit
{
 /**
  * @var \FondOfOryx\Zed\CustomerBrandProductListConnector\Business\Reader\BrandReaderInterface|\PHPUnit\Framework\MockObject\MockObject
  */
    protected $brandReaderMock;

    /**
     * @var \FondOfOryx\Zed\CustomerBrandProductListConnector\Dependecny\Facade\CustomerBrandProductListConnectorToBrandCustomerFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $brandCustomerFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerProductListRelationTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerProductListRelationTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerBrandProductListConnector\Business\Persister\CustomerBrandRelationPersister
     */
    protected $customerBrandRelationPersister;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->brandReaderMock = $this->getMockBuilder(BrandReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandCustomerFacadeMock = $this->getMockBuilder(
            CustomerBrandProductListConnectorToBrandCustomerFacadeInterface::class,
        )->disableOriginalConstructor()->getMock();

        $this->customerProductListRelationTransferMock = $this->getMockBuilder(CustomerProductListRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerBrandRelationPersister = new CustomerBrandRelationPersister(
            $this->brandReaderMock,
            $this->brandCustomerFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testPersistByCustomerProductListRelation(): void
    {
        $brandIds = [1, 2, 3];
        $idCustomer = 1;

        $this->customerProductListRelationTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn($idCustomer);

        $this->brandReaderMock->expects(static::atLeastOnce())
            ->method('getBrandIdsByCustomerProductListRelation')
            ->with($this->customerProductListRelationTransferMock)
            ->willReturn($brandIds);

        $this->brandCustomerFacadeMock->expects(static::atLeastOnce())
            ->method('saveCustomerBrandRelation')
            ->with(
                static::callback(
                    static function (
                        CustomerBrandRelationTransfer $customerBrandRelationTransfer
                    ) use (
                        $idCustomer,
                        $brandIds
                    ) {
                        return $customerBrandRelationTransfer->getIdCustomer() === $idCustomer
                            && $customerBrandRelationTransfer->getIdBrands() === $brandIds;
                    },
                ),
            );

        $this->customerBrandRelationPersister->persistByCustomerProductListRelation(
            $this->customerProductListRelationTransferMock,
        );
    }

    /**
     * @return void
     */
    public function testPersistByCustomerProductListRelationWithoutIdCustomer(): void
    {
        $this->customerProductListRelationTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn(null);

        $this->brandReaderMock->expects(static::never())
            ->method('getBrandIdsByCustomerProductListRelation');

        $this->brandCustomerFacadeMock->expects(static::never())
            ->method('saveCustomerBrandRelation');

        $this->customerBrandRelationPersister->persistByCustomerProductListRelation(
            $this->customerProductListRelationTransferMock,
        );
    }
}
