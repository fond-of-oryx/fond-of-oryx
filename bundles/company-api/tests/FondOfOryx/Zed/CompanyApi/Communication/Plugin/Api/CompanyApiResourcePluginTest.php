<?php


namespace FondOfOryx\Zed\CompanyApi\Communication\Plugin\Api;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyApi\Business\CompanyApiFacade;
use FondOfOryx\Zed\CompanyApi\CompanyApiConfig;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

class CompanyApiResourcePluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyApi\Communication\Plugin\Api\CompanyApiResourcePlugin
     */
    protected $companyApiResourcePlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiDataTransfer
     */
    protected $apiDataTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyApi\Business\CompanyApiFacade
     */
    protected $companyApiFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiItemTransfer
     */
    protected $apiItemTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiRequestTransfer
     */
    protected $apiRequestTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiCollectionTransfer
     */
    protected $apiCollectionTransferMock;

    /**
     * @var int
     */
    protected $idCompany;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyApiFacadeMock = $this->getMockBuilder(CompanyApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->idCompany = 1;

        $this->companyApiResourcePlugin = new CompanyApiResourcePlugin();

        $this->companyApiResourcePlugin->setFacade($this->companyApiFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetResourceName(): void
    {
        static::assertSame(
            CompanyApiConfig::RESOURCE_COMPANIES,
            $this->companyApiResourcePlugin->getResourceName(),
        );
    }

    /**
     * @return void
     */
    public function testAdd(): void
    {
        $this->companyApiFacadeMock->expects(static::atLeastOnce())
            ->method('addCompany')
            ->with($this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->companyApiResourcePlugin->add($this->apiDataTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testGet(): void
    {
        $this->companyApiFacadeMock->expects(static::atLeastOnce())
            ->method('getCompany')
            ->with($this->idCompany)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals($this->apiItemTransferMock, $this->companyApiResourcePlugin->get($this->idCompany));
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $this->companyApiFacadeMock->expects(static::atLeastOnce())
            ->method('updateCompany')
            ->with($this->idCompany, $this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->companyApiResourcePlugin->update($this->idCompany, $this->apiDataTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testRemove(): void
    {
        $this->companyApiFacadeMock->expects(static::atLeastOnce())
            ->method('removeCompany')
            ->with($this->idCompany)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals($this->apiItemTransferMock, $this->companyApiResourcePlugin->remove($this->idCompany));
    }

    /**
     * @return void
     */
    public function testFind(): void
    {
        $this->companyApiFacadeMock->expects(static::atLeastOnce())
            ->method('findCompanies')
            ->with($this->apiRequestTransferMock)
            ->willReturn($this->apiCollectionTransferMock);

        static::assertEquals(
            $this->apiCollectionTransferMock,
            $this->companyApiResourcePlugin->find($this->apiRequestTransferMock),
        );
    }
}
