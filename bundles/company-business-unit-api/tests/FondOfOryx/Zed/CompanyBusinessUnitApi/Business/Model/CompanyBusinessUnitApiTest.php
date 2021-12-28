<?php


namespace FondOfOryx\Zed\CompanyBusinessUnitApi\Business\Model;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\CompanyBusinessUnitApi\Dependency\Facade\CompanyBusinessUnitApiToCompanyBusinessUnitFacadeInterface;
use FondOfOryx\Zed\CompanyBusinessUnitApi\Dependency\QueryContainer\CompanyBusinessUnitApiToApiQueryContainerInterface;
use FondOfOryx\Zed\CompanyBusinessUnitApi\Persistence\CompanyBusinessUnitApiRepositoryInterface;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Generated\Shared\Transfer\CompanyBusinessUnitResponseTransfer;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;

class CompanyBusinessUnitApiTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyBusinessUnitApi\Dependency\QueryContainer\CompanyBusinessUnitApiToApiQueryContainerInterface
     */
    protected $apiQueryContainerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyBusinessUnitApi\Dependency\Facade\CompanyBusinessUnitApiToCompanyBusinessUnitFacadeInterface
     */
    protected $companyBusinessUnitFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitApi\Persistence\CompanyBusinessUnitApiRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiDataTransfer
     */
    protected $apiDataTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyBusinessUnitResponseTransfer
     */
    protected $companyBusinessUnitResponseTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiItemTransfer
     */
    protected $apiItemTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiCollectionTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitApi\Business\Model\CompanyBusinessUnitApi
     */
    protected $companyBusinessUnitApi;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiQueryContainerMock = $this->getMockBuilder(CompanyBusinessUnitApiToApiQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitFacadeMock = $this->getMockBuilder(CompanyBusinessUnitApiToCompanyBusinessUnitFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(CompanyBusinessUnitApiRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitResponseTransferMock = $this->getMockBuilder(CompanyBusinessUnitResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitTransferMock = $this->getMockBuilder(CompanyBusinessUnitTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitApi = new CompanyBusinessUnitApi(
            $this->apiQueryContainerMock,
            $this->companyBusinessUnitFacadeMock,
            $this->repositoryMock,
        );
    }

    /**
     * @return void
     */
    public function testAdd(): void
    {
        $idCompanyBusinessUnit = 1;
        $data = [];

        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($data);

        $this->companyBusinessUnitFacadeMock->expects(static::atLeastOnce())
            ->method('create')
            ->willReturn($this->companyBusinessUnitResponseTransferMock);

        $this->companyBusinessUnitResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->companyBusinessUnitResponseTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyBusinessUnitTransfer')
            ->willReturn($this->companyBusinessUnitTransferMock);

        $this->companyBusinessUnitTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompanyBusinessUnit')
            ->willReturn($idCompanyBusinessUnit);

        $this->apiQueryContainerMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->with($this->companyBusinessUnitTransferMock, $idCompanyBusinessUnit)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->companyBusinessUnitApi->add($this->apiDataTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testAddWithError(): void
    {
        $data = [];

        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($data);

        $this->companyBusinessUnitFacadeMock->expects(static::atLeastOnce())
            ->method('create')
            ->willReturn($this->companyBusinessUnitResponseTransferMock);

        $this->companyBusinessUnitResponseTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyBusinessUnitTransfer')
            ->willReturn(null);

        $this->companyBusinessUnitResponseTransferMock->expects(static::never())
            ->method('getIsSuccessful');

        $this->companyBusinessUnitTransferMock->expects(static::never())
            ->method('getIdCompanyBusinessUnit');

        $this->apiQueryContainerMock->expects(static::never())
            ->method('createApiItem');

        try {
            $this->companyBusinessUnitApi->add($this->apiDataTransferMock);
            static::fail();
        } catch (Exception $exception) {
        }
    }

    /**
     * @return void
     */
    public function testGet(): void
    {
        $idCompanyBusinessUnit = 1;

        $this->companyBusinessUnitFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyBusinessUnitById')
            ->willReturn($this->companyBusinessUnitTransferMock);

        $this->companyBusinessUnitTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompanyBusinessUnit')
            ->willReturn($idCompanyBusinessUnit);

        $this->apiQueryContainerMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->with($this->companyBusinessUnitTransferMock, $idCompanyBusinessUnit)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->companyBusinessUnitApi->get($idCompanyBusinessUnit),
        );
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $idCompanyBusinessUnit = 1;
        $data = [];

        $this->companyBusinessUnitFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyBusinessUnitById')
            ->willReturn($this->companyBusinessUnitTransferMock);

        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($data);

        $this->companyBusinessUnitFacadeMock->expects(static::atLeastOnce())
            ->method('update')
            ->willReturn($this->companyBusinessUnitResponseTransferMock);

        $this->companyBusinessUnitResponseTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyBusinessUnitTransfer')
            ->willReturn($this->companyBusinessUnitTransferMock);

        $this->companyBusinessUnitResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->apiQueryContainerMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->companyBusinessUnitApi->update($idCompanyBusinessUnit, $this->apiDataTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testUpdateWithError(): void
    {
        $idCompanyBusinessUnit = 1;
        $data = [];

        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($data);

        $this->companyBusinessUnitFacadeMock->expects(static::atLeastOnce())
            ->method('update')
            ->willReturn($this->companyBusinessUnitResponseTransferMock);

        $this->companyBusinessUnitResponseTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyBusinessUnitTransfer')
            ->willReturn(null);

        $this->companyBusinessUnitResponseTransferMock->expects(static::never())
            ->method('getIsSuccessful');

        $this->apiQueryContainerMock->expects(static::never())
            ->method('createApiItem');

        try {
            $this->companyBusinessUnitApi->update($idCompanyBusinessUnit, $this->apiDataTransferMock);
            static::fail();
        } catch (Exception $exception) {
        }
    }

    /**
     * @return void
     */
    public function testRemove(): void
    {
        $idCompanyBusinessUnit = 1;

        $this->companyBusinessUnitFacadeMock->expects(static::atLeastOnce())
            ->method('delete')
            ->with(
                static::callback(
                    static function (CompanyBusinessUnitTransfer $companyBusinessUnitTransfer) use ($idCompanyBusinessUnit) {
                        return $companyBusinessUnitTransfer->getIdCompanyBusinessUnit() === $idCompanyBusinessUnit;
                    },
                ),
            );

        $this->apiQueryContainerMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->with([], $idCompanyBusinessUnit)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->companyBusinessUnitApi->remove($idCompanyBusinessUnit),
        );
    }

    /**
     * @return void
     */
    public function testFind(): void
    {
        $apiCollectionTransferData = [
            [
                'id_company_business_unit' => 1,
            ],
            [],
        ];

        $data = [
            'id_company_business_unit' => 1,
            'foo' => 'bar',
        ];

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('find')
            ->with($this->apiRequestTransferMock)
            ->willReturn($this->apiCollectionTransferMock);

        $this->apiCollectionTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($apiCollectionTransferData);

        $this->companyBusinessUnitFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyBusinessUnitById')
            ->with(
                static::callback(
                    static function (CompanyBusinessUnitTransfer $companyBusinessUnitTransfer) use ($apiCollectionTransferData) {
                        return $apiCollectionTransferData[0]['id_company_business_unit'] === $companyBusinessUnitTransfer->getIdCompanyBusinessUnit();
                    },
                ),
            )->willReturn($this->companyBusinessUnitTransferMock);

        $this->companyBusinessUnitTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn($data);

        $this->apiCollectionTransferMock->expects(static::atLeastOnce())
            ->method('setData')
            ->with(
                static::callback(
                    static function (array $newData) use ($data) {
                        return count($newData) === 1
                            && isset($newData[0]['id_company_business_unit'], $newData[0]['foo'])
                            && $newData[0]['id_company_business_unit'] === $data['id_company_business_unit']
                            && $newData[0]['foo'] === $data['foo'];
                    },
                ),
            )->willReturn($this->apiCollectionTransferMock);

        static::assertEquals(
            $this->apiCollectionTransferMock,
            $this->companyBusinessUnitApi->find($this->apiRequestTransferMock),
        );
    }
}
