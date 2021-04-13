<?php


namespace FondOfOryx\Zed\ReturnLabel\Persistence;


use Codeception\Test\Unit;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;
use Orm\Zed\Company\Persistence\SpyCompanyQuery;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery;
use Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery;
use Orm\Zed\Customer\Persistence\SpyCustomerQuery;

class ReturnLabelRepositoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Persistence\ReturnLabelPersistenceFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyCompanyUnitAddressQueryMock;

    /**
     * @var \Orm\Zed\Company\Persistence\SpyCompanyQuery|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyCompanyQueryMock;

    /**
     * @var \Orm\Zed\CompanyUser\Persistence\SpyCompanyUserQuery|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyCompanyUserQueryMock;

    /**
     * @var \Orm\Zed\Customer\Persistence\SpyCustomerQuery|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyCustomerQueryMock;

    /**
     * @var \Generated\Shared\Transfer\ReturnLabelRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Persistence\ReturnLabelRepository;
     */
    protected $repository;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->factoryMock = $this->getMockBuilder(ReturnLabelPersistenceFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyCompanyUnitAddressQueryMock = $this->getMockBuilder(SpyCompanyUnitAddressQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyCompanyQueryMock = $this->getMockBuilder(SpyCompanyQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyCompanyUserQueryMock = $this->getMockBuilder(SpyCompanyUserQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyCustomerQueryMock = $this->getMockBuilder(SpyCustomerQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelRequestTransferMock = $this->getMockBuilder(ReturnLabelRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repository = new ReturnLabelRepository();
        $this->repository->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testGetCompanyUnitAddressByReturnLabelRequestReturnNull(): void
    {
        // $this->repository->getCompanyUnitAddressByReturnLabelRequest($this->returnLabelRequestTransferMock);
    }
}
