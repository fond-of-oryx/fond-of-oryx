<?php

namespace FondOfOryx\Zed\CompanyApi\Business\Model;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\CompanyApi\Dependency\Facade\CompanyApiToApiFacadeInterface;
use FondOfOryx\Zed\CompanyApi\Dependency\Facade\CompanyApiToCompanyFacadeInterface;
use FondOfOryx\Zed\CompanyApi\Persistence\CompanyApiRepositoryInterface;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Generated\Shared\Transfer\CompanyResponseTransfer;
use Generated\Shared\Transfer\CompanyTransfer;

class CompanyApiTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyApi\Dependency\Facade\CompanyApiToApiFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CompanyApi\Dependency\Facade\CompanyApiToCompanyFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiDataTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiDataTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiItemTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyApi\Persistence\CompanyApiRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyApiRepositoryMock;

    /**
     * @var \Generated\Shared\Transfer\ApiCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiCollectionTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyApi\Business\Model\CompanyApi
     */
    protected $companyApi;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiFacadeMock = $this->getMockBuilder(CompanyApiToApiFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyFacadeMock = $this->getMockBuilder(CompanyApiToCompanyFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyResponseTransferMock = $this->getMockBuilder(CompanyResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyApiRepositoryMock = $this->getMockBuilder(CompanyApiRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyApi = new CompanyApi(
            $this->apiFacadeMock,
            $this->companyFacadeMock,
            $this->companyApiRepositoryMock,
        );
    }

    /**
     * @return void
     */
    public function testAdd(): void
    {
        $idCompany = 1;

        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn([]);

        $this->companyFacadeMock->expects(static::atLeastOnce())
            ->method('create')
            ->willReturn($this->companyResponseTransferMock);

        $this->companyResponseTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyTransfer')
            ->willReturn($this->companyTransferMock);

        $this->companyResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->companyTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompany')
            ->willReturn($idCompany);

        $this->apiFacadeMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->with($this->companyTransferMock, $idCompany)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->companyApi->add($this->apiDataTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testAddWithError(): void
    {
        $idCompany = 1;

        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn([]);

        $this->companyFacadeMock->expects(static::atLeastOnce())
            ->method('create')
            ->willReturn($this->companyResponseTransferMock);

        $this->companyResponseTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyTransfer')
            ->willReturn(null);

        $this->companyResponseTransferMock->expects(static::never())
            ->method('getIsSuccessful');

        $this->companyTransferMock->expects(static::never())
            ->method('getIdCompany');

        $this->apiFacadeMock->expects(static::never())
            ->method('createApiItem');

        try {
            $this->companyApi->add($this->apiDataTransferMock);
            static::fail();
        } catch (Exception $exception) {
        }
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $idCompany = 1;
        $data = [];

        $this->companyFacadeMock->expects(static::atLeastOnce())
            ->method('findCompanyById')
            ->with($idCompany)
            ->willReturn($this->companyTransferMock);

        $this->companyTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompany')
            ->willReturn($idCompany);

        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($data);

        $this->companyTransferMock->expects(static::atLeastOnce())
            ->method('fromArray')
            ->with($data, true)
            ->willReturn($this->companyTransferMock);

        $this->companyFacadeMock->expects(static::atLeastOnce())
            ->method('update')
            ->willReturn($this->companyResponseTransferMock);

        $this->companyResponseTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyTransfer')
            ->willReturn($this->companyTransferMock);

        $this->companyResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->companyTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompany')
            ->willReturn($idCompany);

        $this->apiFacadeMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->with($this->companyTransferMock, (string)$idCompany)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->companyApi->update($idCompany, $this->apiDataTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testUpdateWithError(): void
    {
        $data = [];
        $idCompany = 1;

        $this->companyFacadeMock->expects(static::atLeastOnce())
            ->method('findCompanyById')
            ->with($idCompany)
            ->willReturn($this->companyTransferMock);

        $this->companyTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompany')
            ->willReturn($idCompany);

        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($data);

        $this->companyTransferMock->expects(static::atLeastOnce())
            ->method('fromArray')
            ->with($data, true)
            ->willReturn($this->companyTransferMock);

        $this->companyFacadeMock->expects(static::atLeastOnce())
            ->method('update')
            ->willReturn($this->companyResponseTransferMock);

        $this->companyResponseTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyTransfer')
            ->willReturn(null);

        $this->companyResponseTransferMock->expects(static::never())
            ->method('getIsSuccessful');

        $this->apiFacadeMock->expects(static::never())
            ->method('createApiItem');

        try {
            $this->companyApi->update($idCompany, $this->apiDataTransferMock);
            static::fail();
        } catch (Exception $exception) {
        }
    }

    /**
     * @return void
     */
    public function testRemove(): void
    {
        $idCompany = 1;

        $this->companyFacadeMock->expects(static::atLeastOnce())
            ->method('delete')
            ->with(
                static::callback(
                    static function (CompanyTransfer $companyTransfer) use ($idCompany) {
                        return $companyTransfer->getIdCompany() === $idCompany;
                    },
                ),
            );

        $this->apiFacadeMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->with(null, (string)$idCompany)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->companyApi->remove($idCompany),
        );
    }

    /**
     * @return void
     */
    public function testGet(): void
    {
        $idCompany = 1;

        $this->companyFacadeMock->expects(static::atLeastOnce())
            ->method('findCompanyById')
            ->with($idCompany)
            ->willReturn($this->companyTransferMock);

        $this->companyTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompany')
            ->willReturn($idCompany);

        $this->apiFacadeMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->with($this->companyTransferMock, $idCompany)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->companyApi->get($idCompany),
        );
    }

    /**
     * @return void
     */
    public function testGetWithNotExistingCompany(): void
    {
        $idCompany = 2;

        $this->companyFacadeMock->expects(static::atLeastOnce())
            ->method('findCompanyById')
            ->with($idCompany)
            ->willReturn(null);

        try {
            $this->companyApi->get($idCompany);
            static::fail();
        } catch (Exception $exception) {
        }
    }

    /**
     * @return void
     */
    public function testFind(): void
    {
        $apiCollectionTransferData = [
            [
                'id_company' => 1,
            ],
            [],
        ];

        $data = [
            'id_company' => 1,
            'foo' => 'bar',
        ];

        $this->companyApiRepositoryMock->expects(static::atLeastOnce())
            ->method('find')
            ->with($this->apiRequestTransferMock)
            ->willReturn($this->apiCollectionTransferMock);

        $this->apiCollectionTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($apiCollectionTransferData);

        $this->companyFacadeMock->expects(static::atLeastOnce())
            ->method('findCompanyById')
            ->with($apiCollectionTransferData[0]['id_company'])
            ->willReturn($this->companyTransferMock);

        $this->companyTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompany')
            ->willReturn($apiCollectionTransferData[0]['id_company']);

        $this->companyTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn($data);

        $this->apiCollectionTransferMock->expects(static::atLeastOnce())
            ->method('setData')
            ->with(
                static::callback(
                    static function (array $newData) use ($data) {
                        return count($newData) === 1
                            && isset($newData[0]['id_company'], $newData[0]['foo'])
                            && $newData[0]['id_company'] === $data['id_company']
                            && $newData[0]['foo'] === $data['foo'];
                    },
                ),
            )->willReturn($this->apiCollectionTransferMock);

        static::assertEquals(
            $this->apiCollectionTransferMock,
            $this->companyApi->find($this->apiRequestTransferMock),
        );
    }
}
