<?php

namespace FondOfOryx\Zed\CompanyRoleApi\Business\Model;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\CompanyRoleApi\Dependency\Facade\CompanyRoleApiToCompanyRoleFacadeInterface;
use FondOfOryx\Zed\CompanyRoleApi\Dependency\QueryContainer\CompanyRoleApiToApiQueryContainerInterface;
use FondOfOryx\Zed\CompanyRoleApi\Persistence\CompanyRoleApiRepositoryInterface;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Generated\Shared\Transfer\CompanyRoleTransfer;

class CompanyRoleApiTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyRoleApi\Dependency\QueryContainer\CompanyRoleApiToApiQueryContainerInterface
     */
    protected $apiQueryContainerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyRoleApi\Dependency\Facade\CompanyRoleApiToCompanyRoleFacadeInterface
     */
    protected $companyRoleFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyRoleApi\Persistence\CompanyRoleApiRepositoryInterface
     */
    protected $repositoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiItemTransfer
     */
    protected $apiItemTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiCollectionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiRequestTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyRoleTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyRoleApi\Business\Model\CompanyRoleApi
     */
    protected $companyRoleApi;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiQueryContainerMock = $this->getMockBuilder(CompanyRoleApiToApiQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleFacadeMock = $this->getMockBuilder(CompanyRoleApiToCompanyRoleFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(CompanyRoleApiRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleTransferMock = $this->getMockBuilder(CompanyRoleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleApi = new CompanyRoleApi(
            $this->apiQueryContainerMock,
            $this->companyRoleFacadeMock,
            $this->repositoryMock,
        );
    }

    /**
     * @return void
     */
    public function testGet(): void
    {
        $idCompanyRole = 1;

        $this->companyRoleFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyRoleById')
            ->with(
                static::callback(
                    static function (CompanyRoleTransfer $companyRoleTransfer) use ($idCompanyRole) {
                        return $companyRoleTransfer->getIdCompanyRole() === $idCompanyRole;
                    },
                ),
            )->willReturn($this->companyRoleTransferMock);

        $this->apiQueryContainerMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->with($this->companyRoleTransferMock, $idCompanyRole)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals($this->apiItemTransferMock, $this->companyRoleApi->get($idCompanyRole));
    }

    /**
     * @return void
     */
    public function testGetWithEntityNotFoundException(): void
    {
        $idCompanyRole = 1;

        $this->companyRoleFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyRoleById')
            ->with(
                static::callback(
                    static function (CompanyRoleTransfer $companyRoleTransfer) use ($idCompanyRole) {
                        return $companyRoleTransfer->getIdCompanyRole() === $idCompanyRole;
                    },
                ),
            )->willThrowException(new Exception());

        $this->apiQueryContainerMock->expects(static::never())
            ->method('createApiItem');

        try {
            $this->companyRoleApi->get($idCompanyRole);
            static::fail();
        } catch (Exception $e) {
        }
    }

    /**
     * @return void
     */
    public function testFind(): void
    {
        $apiCollectionTransferData = [
            [
                'id_company_role' => 1,
            ],
            [],
        ];

        $data = [
            'id_company_role' => 1,
            'foo' => 'bar',
        ];

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('find')
            ->with($this->apiRequestTransferMock)
            ->willReturn($this->apiCollectionTransferMock);

        $this->apiCollectionTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($apiCollectionTransferData);

        $this->companyRoleFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyRoleById')
            ->with(
                static::callback(
                    static function (CompanyRoleTransfer $companyRoleTransfer) use ($apiCollectionTransferData) {
                        return $companyRoleTransfer->getIdCompanyRole() === $apiCollectionTransferData[0]['id_company_role'];
                    },
                ),
            )->willReturn($this->companyRoleTransferMock);

        $this->companyRoleTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn($data);

        $this->apiCollectionTransferMock->expects(static::atLeastOnce())
            ->method('setData')
            ->with(
                static::callback(
                    static function (array $newData) use ($data) {
                        return count($newData) === 1
                            && isset($newData[0]['id_company_role'], $newData[0]['foo'])
                            && $newData[0]['id_company_role'] === $data['id_company_role']
                            && $newData[0]['foo'] === $data['foo'];
                    },
                ),
            )->willReturn($this->apiCollectionTransferMock);

        static::assertEquals(
            $this->apiCollectionTransferMock,
            $this->companyRoleApi->find($this->apiRequestTransferMock),
        );
    }
}
