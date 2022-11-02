<?php

namespace FondOfOryx\Zed\CompanyProductListsRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyProductListsRestApi\Business\Persister\CompanyProductListRelationPersisterInterface;
use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;

class CompanyProductListsRestApiFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyProductListsRestApi\Business\CompanyProductListsRestApiBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $businessFactoryMock;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListsRestApi\Business\Persister\CompanyProductListRelationPersisterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyProductListRelationPersisterMock;

    /**
     * @var \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restProductListUpdateRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ProductListTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListsRestApi\Business\CompanyProductListsRestApiFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->businessFactoryMock = $this->getMockBuilder(CompanyProductListsRestApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyProductListRelationPersisterMock = $this->getMockBuilder(CompanyProductListRelationPersisterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListUpdateRequestTransferMock = $this->getMockBuilder(RestProductListUpdateRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListTransferMock = $this->getMockBuilder(ProductListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CompanyProductListsRestApiFacade();
        $this->facade->setFactory($this->businessFactoryMock);
    }

    /**
     * @return void
     */
    public function testPersistCompanyProductListRelation(): void
    {
        $this->businessFactoryMock->expects(static::atLeastOnce())
            ->method('createCompanyProductListRelationPersister')
            ->willReturn($this->companyProductListRelationPersisterMock);

        $this->companyProductListRelationPersisterMock->expects(static::atLeastOnce())
            ->method('persist')
            ->with($this->restProductListUpdateRequestTransferMock, $this->productListTransferMock);

        $this->facade->persistCompanyProductListRelation(
            $this->restProductListUpdateRequestTransferMock,
            $this->productListTransferMock,
        );
    }
}
