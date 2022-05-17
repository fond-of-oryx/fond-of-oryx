<?php

namespace FondOfOryx\Zed\CompanyUnitAddressApi\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUnitAddressApi\Dependency\Facade\CompanyUnitAddressApiToCompanyUnitAddressFacadeInterface;
use FondOfOryx\Zed\CompanyUnitAddressApi\Dependency\QueryContainer\CompanyUnitAddressApiToApiQueryContainerInterface;
use FondOfOryx\Zed\CompanyUnitAddressApi\Persistence\CompanyUnitAddressApiRepositoryInterface;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\ResponseMessageTransfer;
use Spryker\Zed\Api\Business\Exception\EntityNotFoundException;
use Spryker\Zed\Api\Business\Exception\EntityNotSavedException;

class CompanyUnitAddressApiTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyUnitAddressApi\Dependency\QueryContainer\CompanyUnitAddressApiToApiQueryContainerInterface
     */
    protected $apiQueryContainerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyUnitAddressApi\Dependency\Facade\CompanyUnitAddressApiToCompanyUnitAddressFacadeInterface
     */
    protected $companyUnitAddressFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUnitAddressApi\Persistence\CompanyUnitAddressApiRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiDataTransfer
     */
    protected $apiDataTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer
     */
    protected $companyUnitAddressResponseTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUnitAddressTransfer
     */
    protected $companyUnitAddressTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiItemTransfer
     */
    protected $apiItemTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ResponseMessageTransfer
     */
    protected $responseMessageTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiRequestTransfer
     */
    protected $apiRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiCollectionTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUnitAddressApi\Business\Model\CompanyUnitAddressApi
     */
    protected $companyUnitAddressApi;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->apiQueryContainerMock = $this->getMockBuilder(CompanyUnitAddressApiToApiQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressFacadeMock = $this->getMockBuilder(CompanyUnitAddressApiToCompanyUnitAddressFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(CompanyUnitAddressApiRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressResponseTransferMock = $this->getMockBuilder(CompanyUnitAddressResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressTransferMock = $this->getMockBuilder(CompanyUnitAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->responseMessageTransferMock = $this->getMockBuilder(ResponseMessageTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressApi = new CompanyUnitAddressApi(
            $this->apiQueryContainerMock,
            $this->companyUnitAddressFacadeMock,
            $this->repositoryMock,
        );
    }

    /**
     * @return void
     */
    public function testAdd(): void
    {
        $idCompanyUnitAddress = 1;
        $data = [
            'address1' => 'Address 1',
        ];

        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($data);

        $this->companyUnitAddressFacadeMock->expects(static::atLeastOnce())
            ->method('create')
            ->with(
                static::callback(
                    static function (CompanyUnitAddressTransfer $companyUnitAddressTransfer) use ($data) {
                        return $companyUnitAddressTransfer->getAddress1() === $data['address1'];
                    },
                ),
            )->willReturn($this->companyUnitAddressResponseTransferMock);

        $this->companyUnitAddressResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->companyUnitAddressResponseTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddressTransfer')
            ->willReturn($this->companyUnitAddressTransferMock);

        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompanyUnitAddress')
            ->willReturn($idCompanyUnitAddress);

        $this->apiQueryContainerMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->with($this->companyUnitAddressTransferMock, $idCompanyUnitAddress)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->companyUnitAddressApi->add($this->apiDataTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testAddEntityNotSavedException(): void
    {
        $data = [
            'address1' => 'Address 1',
        ];

        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($data);

        $this->companyUnitAddressFacadeMock->expects(static::atLeastOnce())
            ->method('create')
            ->with(
                static::callback(
                    static function (CompanyUnitAddressTransfer $companyUnitAddressTransfer) use ($data) {
                        return $companyUnitAddressTransfer->getAddress1() === $data['address1'];
                    },
                ),
            )->willReturn($this->companyUnitAddressResponseTransferMock);

        $this->companyUnitAddressResponseTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddressTransfer')
            ->willReturn(null);

        $this->companyUnitAddressResponseTransferMock->expects(static::never())
            ->method('getIsSuccessful');

        $this->apiQueryContainerMock->expects(static::never())
            ->method('createApiItem');

        try {
            $this->companyUnitAddressApi->add($this->apiDataTransferMock);
            static::fail();
        } catch (EntityNotSavedException $e) {
        }
    }

    /**
     * @return void
     */
    public function testGet(): void
    {
        $idCompanyUnitAddress = 1;

        $this->companyUnitAddressFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddressById')
            ->with(
                static::callback(
                    static function (CompanyUnitAddressTransfer $companyUnitAddressTransfer) use ($idCompanyUnitAddress) {
                        return $companyUnitAddressTransfer->getIdCompanyUnitAddress() === $idCompanyUnitAddress;
                    },
                ),
            )->willReturn($this->companyUnitAddressTransferMock);

        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompanyUnitAddress')
            ->willReturn($idCompanyUnitAddress);

        $this->apiQueryContainerMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->with(
                $this->companyUnitAddressTransferMock,
                $idCompanyUnitAddress,
            )->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->companyUnitAddressApi->get($idCompanyUnitAddress),
        );
    }

    /**
     * @return void
     */
    public function testGetEntityNotFoundException(): void
    {
        $idCompanyUnitAddress = 1;

        $this->companyUnitAddressFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddressById')
            ->with(
                static::callback(
                    static function (CompanyUnitAddressTransfer $companyUnitAddressTransfer) use ($idCompanyUnitAddress) {
                        return $companyUnitAddressTransfer->getIdCompanyUnitAddress() === $idCompanyUnitAddress;
                    },
                ),
            )->willReturn($this->companyUnitAddressTransferMock);

        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompanyUnitAddress')
            ->willReturn(null);

        $this->apiQueryContainerMock->expects(static::never())
            ->method('createApiItem');

        try {
            $this->companyUnitAddressApi->get($idCompanyUnitAddress);
            static::fail();
        } catch (EntityNotFoundException $e) {
        }
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $idCompanyUnitAddress = 1;
        $data = [];

        $this->companyUnitAddressFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddressById')
            ->with(
                static::callback(
                    static function (
                        CompanyUnitAddressTransfer $companyUnitAddressTransfer
                    ) use ($idCompanyUnitAddress) {
                        return $companyUnitAddressTransfer->getIdCompanyUnitAddress() === $idCompanyUnitAddress;
                    },
                ),
            )->willReturn($this->companyUnitAddressTransferMock);

        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompanyUnitAddress')
            ->willReturn($idCompanyUnitAddress);

        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($data);

        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('fromArray')
            ->with($data, true)
            ->willReturn($this->companyUnitAddressTransferMock);

        $this->companyUnitAddressFacadeMock->expects(static::atLeastOnce())
            ->method('update')
            ->with($this->companyUnitAddressTransferMock)
            ->willReturn($this->companyUnitAddressResponseTransferMock);

        $this->companyUnitAddressResponseTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddressTransfer')
            ->willReturn($this->companyUnitAddressTransferMock);

        $this->companyUnitAddressResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->apiQueryContainerMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->with($this->companyUnitAddressTransferMock, $idCompanyUnitAddress)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->companyUnitAddressApi->update($idCompanyUnitAddress, $this->apiDataTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testUpdateEntityNotFoundException(): void
    {
        $idCompanyUnitAddress = 1;

        $this->companyUnitAddressFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddressById')
            ->with(
                static::callback(
                    static function (
                        CompanyUnitAddressTransfer $companyUnitAddressTransfer
                    ) use ($idCompanyUnitAddress) {
                        return $companyUnitAddressTransfer->getIdCompanyUnitAddress() === $idCompanyUnitAddress;
                    },
                ),
            )->willReturn($this->companyUnitAddressTransferMock);

        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompanyUnitAddress')
            ->willReturn(null);

        $this->apiDataTransferMock->expects(static::never())
            ->method('getData');

        $this->companyUnitAddressTransferMock->expects(static::never())
            ->method('fromArray');

        $this->companyUnitAddressFacadeMock->expects(static::never())
            ->method('update');

        $this->apiQueryContainerMock->expects(static::never())
            ->method('createApiItem');

        try {
            $this->companyUnitAddressApi->update(
                $idCompanyUnitAddress,
                $this->apiDataTransferMock,
            );
            static::fail();
        } catch (EntityNotFoundException $e) {
        }
    }

    /**
     * @return void
     */
    public function testUpdateEntityNotSavedException(): void
    {
        $idCompanyUnitAddress = 1;
        $data = [];

        $this->companyUnitAddressFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddressById')
            ->with(
                static::callback(
                    static function (
                        CompanyUnitAddressTransfer $companyUnitAddressTransfer
                    ) use ($idCompanyUnitAddress) {
                        return $companyUnitAddressTransfer->getIdCompanyUnitAddress() === $idCompanyUnitAddress;
                    },
                ),
            )->willReturn($this->companyUnitAddressTransferMock);

        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompanyUnitAddress')
            ->willReturn($idCompanyUnitAddress);

        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($data);

        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('fromArray')
            ->with($data, true)
            ->willReturn($this->companyUnitAddressTransferMock);

        $this->companyUnitAddressFacadeMock->expects(static::atLeastOnce())
            ->method('update')
            ->with($this->companyUnitAddressTransferMock)
            ->willReturn($this->companyUnitAddressResponseTransferMock);

        $this->companyUnitAddressResponseTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddressTransfer')
            ->willReturn(null);

        $this->companyUnitAddressResponseTransferMock->expects(static::never())
            ->method('getIsSuccessful');

        $this->apiQueryContainerMock->expects(static::never())
            ->method('createApiItem');

        try {
            $this->companyUnitAddressApi->update(
                $idCompanyUnitAddress,
                $this->apiDataTransferMock,
            );
            static::fail();
        } catch (EntityNotSavedException $e) {
        }
    }

    /**
     * @return void
     */
    public function testRemove(): void
    {
        $idCompanyUnitAddress = 1;

        $this->companyUnitAddressFacadeMock->expects(static::atLeastOnce())
            ->method('delete')
            ->with(
                static::callback(
                    static function (
                        CompanyUnitAddressTransfer $companyUnitAddressTransfer
                    ) use ($idCompanyUnitAddress) {
                        return $companyUnitAddressTransfer->getIdCompanyUnitAddress() === $idCompanyUnitAddress;
                    },
                ),
            );

        $this->apiQueryContainerMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->with([], $idCompanyUnitAddress)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->companyUnitAddressApi->remove($idCompanyUnitAddress),
        );
    }

    /**
     * @return void
     */
    public function testFind(): void
    {
        $apiCollectionTransferData = [
            [
                'id_company_unit_address' => 1,
            ],
            [],
        ];

        $data = [
            'id_company_unit_address' => 1,
            'address1' => 'Address 1',
        ];

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('find')
            ->with($this->apiRequestTransferMock)
            ->willReturn($this->apiCollectionTransferMock);

        $this->apiCollectionTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($apiCollectionTransferData);

        $this->companyUnitAddressFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyUnitAddressById')
            ->with(
                static::callback(
                    static function (
                        CompanyUnitAddressTransfer $companyUnitAddressTransfer
                    ) use ($apiCollectionTransferData) {
                        $idCompanyUnitAddress = $apiCollectionTransferData[0]['id_company_unit_address'];

                        return $companyUnitAddressTransfer->getIdCompanyUnitAddress() === $idCompanyUnitAddress;
                    },
                ),
            )->willReturn($this->companyUnitAddressTransferMock);

        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompanyUnitAddress')
            ->willReturn($apiCollectionTransferData[0]['id_company_unit_address']);

        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn($data);

        $this->apiCollectionTransferMock->expects(static::atLeastOnce())
            ->method('setData')
            ->with(
                static::callback(
                    static function (array $newData) use ($data) {
                        return count($newData) === 1
                            && isset($newData[0]['id_company_unit_address'], $newData[0]['address1'])
                            && $newData[0]['id_company_unit_address'] === $data['id_company_unit_address']
                            && $newData[0]['address1'] === $data['address1'];
                    },
                ),
            )->willReturn($this->apiCollectionTransferMock);

        static::assertEquals(
            $this->apiCollectionTransferMock,
            $this->companyUnitAddressApi->find($this->apiRequestTransferMock),
        );
    }
}
