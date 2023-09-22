<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Model\Mapper\RestDataMapperInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Validator\DurationValidatorInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade\RepresentativeCompanyUserTradeFairRestApiToCompanyTypeFacadeInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade\RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Persistence\RepresentativeCompanyUserTradeFairRestApiRepositoryInterface;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiConfig;
use Generated\Shared\Transfer\CompanyTypeTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\PaginationTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairAttributesTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairResponseTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Psr\Log\LoggerInterface;

class TradeFairRepresentationManagerTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade\RepresentativeCompanyUserTradeFairRestApiToCompanyTypeFacadeInterface
     */
    protected MockObject|RepresentativeCompanyUserTradeFairRestApiToCompanyTypeFacadeInterface $companyTypeFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyTypeTransfer
     */
    protected MockObject|CompanyTypeTransfer $companyTypeTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CustomerTransfer
     */
    protected MockObject|CustomerTransfer $customerTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Validator\DurationValidatorInterface
     */
    protected DurationValidatorInterface|MockObject $durationValidatorMock;

    /**
     * @var \Generated\Shared\Transfer\PaginationTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected PaginationTransfer|MockObject $paginationTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade\RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeInterface
     */
    protected MockObject|RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeInterface $representativeCompanyUserTradeFairFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Persistence\RepresentativeCompanyUserTradeFairRestApiRepositoryInterface
     */
    protected MockObject|RepresentativeCompanyUserTradeFairRestApiRepositoryInterface $repositoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer
     */
    protected MockObject|RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairAttributesTransfer
     */
    protected MockObject|RestRepresentativeCompanyUserTradeFairAttributesTransfer $restRepresentativeCompanyUserTradeFairAttributesTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer
     */
    protected MockObject|RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RepresentativeCompanyUserTradeFairCollectionTransfer|MockObject $representativeCompanyUserTradeFairCollectionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestRepresentativeCompanyUserTradeFairTransfer|MockObject $restRepresentativeCompanyUserTradeFairTransferMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Model\Mapper\RestDataMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestDataMapperInterface|MockObject $restDataMapperMock;

    /**
     * @var \Psr\Log\LoggerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected LoggerInterface|MockObject $loggerMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Model\TradeFairRepresentationManager
     */
    protected TradeFairRepresentationManager $tradeFairRepresentation;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyTypeFacadeMock = $this
            ->getMockBuilder(RepresentativeCompanyUserTradeFairRestApiToCompanyTypeFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTypeTransferMock = $this
            ->getMockBuilder(CompanyTypeTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this
            ->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->durationValidatorMock = $this
            ->getMockBuilder(DurationValidatorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserTradeFairFacadeMock = $this
            ->getMockBuilder(RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock = $this
            ->getMockBuilder(RestRepresentativeCompanyUserTradeFairAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserTradeFairTransferMock = $this
            ->getMockBuilder(RepresentativeCompanyUserTradeFairTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->loggerMock = $this
            ->getMockBuilder(LoggerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRepresentativeCompanyUserTradeFairRequestTransferMock = $this
            ->getMockBuilder(RestRepresentativeCompanyUserTradeFairRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRepresentativeCompanyUserTradeFairTransferMock = $this
            ->getMockBuilder(RestRepresentativeCompanyUserTradeFairTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restDataMapperMock = $this
            ->getMockBuilder(RestDataMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->paginationTransferMock = $this
            ->getMockBuilder(PaginationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this
            ->getMockBuilder(RepresentativeCompanyUserTradeFairRestApiRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserTradeFairCollectionTransferMock = $this
            ->getMockBuilder(RepresentativeCompanyUserTradeFairCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->tradeFairRepresentation = new TradeFairRepresentationManager(
            $this->representativeCompanyUserTradeFairFacadeMock,
            $this->companyTypeFacadeMock,
            $this->durationValidatorMock,
            $this->repositoryMock,
            $this->restDataMapperMock,
            $this->loggerMock,
        );
    }

    /**
     * @return void
     */
    public function testAddTradeFairRepresentation(): void
    {
        $customerReferenceOriginator = 'customer-reference-originator';
        $customerReferenceRepresentative = 'customer-reference-representative';
        $tradeFairName = 'fair trade';
        $startAt = '1970-01-01';
        $endAt = '1970-01-05';
        $originatorId = 1;
        $representationId = 2;
        $companyTypeId = 1;

        $this->companyTypeFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyTypeManufacturer')
            ->willReturn($this->companyTypeTransferMock);

        $this->restRepresentativeCompanyUserTradeFairRequestTransferMock->expects(static::atLeastOnce())
            ->method('getAttributes')
            ->willReturn($this->restRepresentativeCompanyUserTradeFairAttributesTransferMock);

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReferenceOriginator')
            ->willReturn($customerReferenceOriginator);

        $this->companyTypeTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompanyType')
            ->willReturn($companyTypeId);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('hasPermission')
            ->with(
                'CanManageRepresentationOnTradeFairPermissionPlugin',
                $customerReferenceOriginator,
                $companyTypeId,
            )
            ->willReturn(true);

        $this->durationValidatorMock->expects(static::atLeastOnce())
            ->method('validate')
            ->with($this->restRepresentativeCompanyUserTradeFairAttributesTransferMock)
            ->willReturn(true);

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReferenceRepresentative')
            ->willReturn($customerReferenceRepresentative);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getIdCustomerByReference')
            ->withConsecutive(
                [$customerReferenceOriginator],
                [$customerReferenceRepresentative],
            )
            ->willReturnOnConsecutiveCalls(
                $originatorId,
                $representationId,
            );

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getTradeFairName')
            ->willReturn($tradeFairName);

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getStartAt')
            ->willReturn($startAt);

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getEndAt')
            ->willReturn($endAt);

        $this->representativeCompanyUserTradeFairFacadeMock->expects(static::atLeastOnce())
            ->method('addRepresentativeCompanyUserTradeFair')
            ->willReturn($this->representativeCompanyUserTradeFairTransferMock);

        $restRepresentativeCompanyUserTradeFairResponse = $this->tradeFairRepresentation
            ->addTradeFairRepresentation($this->restRepresentativeCompanyUserTradeFairRequestTransferMock);

        $this->assertInstanceOf(
            RestRepresentativeCompanyUserTradeFairResponseTransfer::class,
            $restRepresentativeCompanyUserTradeFairResponse,
        );

        $this->assertEquals(true, $restRepresentativeCompanyUserTradeFairResponse->getIsSuccessful());
    }

    /**
     * @return void
     */
    public function testAddTradeFairRepresentationWithValidationError(): void
    {
        $customerReferenceOriginator = 'customer-reference-originator';
        $companyTypeId = 1;

        $this->companyTypeFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyTypeManufacturer')
            ->willReturn($this->companyTypeTransferMock);

        $this->restRepresentativeCompanyUserTradeFairRequestTransferMock->expects(static::atLeastOnce())
            ->method('getAttributes')
            ->willReturn($this->restRepresentativeCompanyUserTradeFairAttributesTransferMock);

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReferenceOriginator')
            ->willReturn($customerReferenceOriginator);

        $this->companyTypeTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompanyType')
            ->willReturn($companyTypeId);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('hasPermission')
            ->with(
                'CanManageRepresentationOnTradeFairPermissionPlugin',
                $customerReferenceOriginator,
                $companyTypeId,
            )
            ->willReturn(false);

        $restRepresentativeCompanyUserTradeFairResponse = $this->tradeFairRepresentation
            ->addTradeFairRepresentation($this->restRepresentativeCompanyUserTradeFairRequestTransferMock);

        $this->assertInstanceOf(
            RestRepresentativeCompanyUserTradeFairResponseTransfer::class,
            $restRepresentativeCompanyUserTradeFairResponse,
        );

        $this->assertEquals(false, $restRepresentativeCompanyUserTradeFairResponse->getIsSuccessful());
        $this->assertEquals(
            RepresentativeCompanyUserTradeFairRestApiConfig::ERROR_MESSAGE_USER_IS_NOT_ALLOWED_TO_ADD_TRADE_FAIR_REPRESENTATION,
            $restRepresentativeCompanyUserTradeFairResponse->getError()->getDetail(),
        );
    }

    /**
     * @return void
     */
    public function testUpdateTradeFairRepresentation(): void
    {
        $customerReference = 'customer-reference';
        $date1 = '1970-01-01';
        $date2 = '1970-01-05';
        $companyTypeId = 1;
        $name = 'name';
        $uuid = 'xxxx-xxxxx-xxxx-xxxx';

        $this->restRepresentativeCompanyUserTradeFairRequestTransferMock->expects(static::atLeastOnce())
            ->method('getAttributes')
            ->willReturn($this->restRepresentativeCompanyUserTradeFairAttributesTransferMock);

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('requireUuid')
            ->willReturnSelf();

        $this->companyTypeFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyTypeManufacturer')
            ->willReturn($this->companyTypeTransferMock);

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReferenceOriginator')
            ->willReturn($customerReference);

        $this->companyTypeTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompanyType')
            ->willReturn($companyTypeId);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('hasPermission')
            ->with(
                'CanManageRepresentationOnTradeFairPermissionPlugin',
                $customerReference,
                $companyTypeId,
            )
            ->willReturn(true);

        $this->durationValidatorMock->expects(static::atLeastOnce())
            ->method('validate')
            ->with($this->restRepresentativeCompanyUserTradeFairAttributesTransferMock)
            ->willReturn(true);

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getUuid')
            ->willReturn($uuid);

        $this->representativeCompanyUserTradeFairFacadeMock->expects(static::atLeastOnce())
            ->method('findTradeFairRepresentationByUuid')
            ->with($uuid)
            ->willReturn($this->representativeCompanyUserTradeFairTransferMock);

        $this->representativeCompanyUserTradeFairTransferMock->expects(static::atLeastOnce())
            ->method('getDistributor')
            ->willReturn($this->customerTransferMock);

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($customerReference);

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReferenceRepresentative')
            ->willReturn($customerReference);

        $this->representativeCompanyUserTradeFairTransferMock->expects(static::atLeastOnce())
            ->method('setActive')
            ->willReturnSelf();

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getStartAt')
            ->willReturn($date2);

        $this->representativeCompanyUserTradeFairTransferMock->expects(static::atLeastOnce())
            ->method('getStartAt')
            ->willReturn($date1);

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getEndAt')
            ->willReturn($date2);

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getTradeFairName')
            ->willReturn($name);

        $this->representativeCompanyUserTradeFairTransferMock->expects(static::atLeastOnce())
            ->method('setEndAt')
            ->with($date2)
            ->willReturnSelf();

        $this->representativeCompanyUserTradeFairTransferMock->expects(static::atLeastOnce())
            ->method('setName')
            ->with($name)
            ->willReturnSelf();

        $this->representativeCompanyUserTradeFairTransferMock->expects(static::atLeastOnce())
            ->method('setStartAt')
            ->with($date2)
            ->willReturnSelf();

        $this->representativeCompanyUserTradeFairTransferMock->expects(static::atLeastOnce())
            ->method('getStartAt')
            ->willReturn($date1);

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getStartAt')
            ->willReturn($date1);

        $this->representativeCompanyUserTradeFairFacadeMock->expects(static::atLeastOnce())
            ->method('updateRepresentativeCompanyUserTradeFair')
            ->with($this->representativeCompanyUserTradeFairTransferMock)
            ->willReturn($this->representativeCompanyUserTradeFairTransferMock);

        $restRepresentativeCompanyUserTradeFairResponse = $this->tradeFairRepresentation
            ->updateTradeFairRepresentation($this->restRepresentativeCompanyUserTradeFairRequestTransferMock);

        $this->assertInstanceOf(
            RestRepresentativeCompanyUserTradeFairResponseTransfer::class,
            $restRepresentativeCompanyUserTradeFairResponse,
        );
    }

    /**
     * @return void
     */
    public function testUpdateTradeFairRepresentationWithValidationError(): void
    {
        $customerReference = 'customer-reference';
        $companyTypeId = 1;

        $this->restRepresentativeCompanyUserTradeFairRequestTransferMock->expects(static::atLeastOnce())
            ->method('getAttributes')
            ->willReturn($this->restRepresentativeCompanyUserTradeFairAttributesTransferMock);

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('requireUuid')
            ->willReturnSelf();

        $this->companyTypeFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyTypeManufacturer')
            ->willReturn($this->companyTypeTransferMock);

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReferenceOriginator')
            ->willReturn($customerReference);

        $this->companyTypeTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompanyType')
            ->willReturn($companyTypeId);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('hasPermission')
            ->with(
                'CanManageRepresentationOnTradeFairPermissionPlugin',
                $customerReference,
                $companyTypeId,
            )
            ->willReturn(false);

        $restRepresentativeCompanyUserTradeFairResponse = $this->tradeFairRepresentation
            ->updateTradeFairRepresentation($this->restRepresentativeCompanyUserTradeFairRequestTransferMock);

        $this->assertInstanceOf(
            RestRepresentativeCompanyUserTradeFairResponseTransfer::class,
            $restRepresentativeCompanyUserTradeFairResponse,
        );

        $this->assertEquals(
            RepresentativeCompanyUserTradeFairRestApiConfig::ERROR_MESSAGE_USER_IS_NOT_ALLOWED_TO_ADD_TRADE_FAIR_REPRESENTATION,
            $restRepresentativeCompanyUserTradeFairResponse->getError()->getDetail(),
        );
    }

    /**
     * @return void
     */
    public function testUpdateTradeFairRepresentationWithSameDistributorAndOriginator(): void
    {
        $startAt = '1970-01-01';
        $endAt = '1970-01-05';
        $uuid = 'xxxx-xxxxx-xxxx-xxxx';
        $customerReferenceOriginator = 'customer-reference-originator';
        $customerReferenceRepresentative = 'customer-reference-representative';
        $tradeFairName = 'fair trade';
        $originatorId = 1;
        $representationId = 2;
        $companyTypeId = 1;

        $this->restRepresentativeCompanyUserTradeFairRequestTransferMock->expects(static::atLeastOnce())
            ->method('getAttributes')
            ->willReturn($this->restRepresentativeCompanyUserTradeFairAttributesTransferMock);

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('requireUuid')
            ->willReturnSelf();

        $this->companyTypeFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyTypeManufacturer')
            ->willReturn($this->companyTypeTransferMock);

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReferenceOriginator')
            ->willReturn($customerReferenceOriginator);

        $this->companyTypeTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompanyType')
            ->willReturn($companyTypeId);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('hasPermission')
            ->with(
                'CanManageRepresentationOnTradeFairPermissionPlugin',
                $customerReferenceOriginator,
                $companyTypeId,
            )
            ->willReturn(true);

        $this->durationValidatorMock->expects(static::atLeastOnce())
            ->method('validate')
            ->with($this->restRepresentativeCompanyUserTradeFairAttributesTransferMock)
            ->willReturn(true);

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getUuid')
            ->willReturn($uuid);

        $this->representativeCompanyUserTradeFairFacadeMock->expects(static::atLeastOnce())
            ->method('findTradeFairRepresentationByUuid')
            ->with($uuid)
            ->willReturn($this->representativeCompanyUserTradeFairTransferMock);

        $this->representativeCompanyUserTradeFairTransferMock->expects(static::atLeastOnce())
            ->method('getDistributor')
            ->willReturn($this->customerTransferMock);

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($customerReferenceOriginator);

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReferenceRepresentative')
            ->willReturn($customerReferenceRepresentative);

        $this->representativeCompanyUserTradeFairTransferMock->expects(static::atLeastOnce())
            ->method('setActive')
            ->willReturnSelf();

        $this->representativeCompanyUserTradeFairFacadeMock->expects(static::atLeastOnce())
            ->method('updateRepresentativeCompanyUserTradeFair')
            ->with($this->representativeCompanyUserTradeFairTransferMock)
            ->willReturn($this->representativeCompanyUserTradeFairTransferMock);

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReferenceRepresentative')
            ->willReturn($customerReferenceRepresentative);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getIdCustomerByReference')
            ->withConsecutive(
                [$customerReferenceOriginator],
                [$customerReferenceRepresentative],
            )
            ->willReturnOnConsecutiveCalls(
                $originatorId,
                $representationId,
            );

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getTradeFairName')
            ->willReturn($tradeFairName);

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getStartAt')
            ->willReturn($startAt);

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getEndAt')
            ->willReturn($endAt);

        $this->representativeCompanyUserTradeFairFacadeMock->expects(static::atLeastOnce())
            ->method('addRepresentativeCompanyUserTradeFair')
            ->willReturn($this->representativeCompanyUserTradeFairTransferMock);

        $restRepresentativeCompanyUserTradeFairResponse = $this->tradeFairRepresentation
            ->updateTradeFairRepresentation($this->restRepresentativeCompanyUserTradeFairRequestTransferMock);

        $this->assertInstanceOf(
            RestRepresentativeCompanyUserTradeFairResponseTransfer::class,
            $restRepresentativeCompanyUserTradeFairResponse,
        );

        $this->assertEquals(
            true,
            $restRepresentativeCompanyUserTradeFairResponse->getIsSuccessful(),
        );
    }

    /**
     * @return void
     */
    public function testDeleteTradeFairRepresentation(): void
    {
        $uuid = 'xxxx-xxxxx-xxxx-xxxx';

        $this->restRepresentativeCompanyUserTradeFairRequestTransferMock->expects(static::atLeastOnce())
            ->method('getAttributes')
            ->willReturn($this->restRepresentativeCompanyUserTradeFairAttributesTransferMock);

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('requireUuid')
            ->willReturnSelf();

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getUuid')
            ->willReturn($uuid);

        $this->representativeCompanyUserTradeFairFacadeMock->expects(static::atLeastOnce())
            ->method('deleteRepresentativeCompanyUserTradeFair')
            ->willReturn($this->representativeCompanyUserTradeFairTransferMock);

        $restRepresentativeCompanyUserTradeFairResponse = $this
            ->tradeFairRepresentation->deleteTradeFairRepresentation($this->restRepresentativeCompanyUserTradeFairRequestTransferMock);

        $this->assertInstanceOf(
            RestRepresentativeCompanyUserTradeFairResponseTransfer::class,
            $restRepresentativeCompanyUserTradeFairResponse,
        );
    }

    /**
     * @return void
     */
    public function testGetTradeFairRepresentation(): void
    {
        $uuid = 'xxxx-xxxxx-xxxx-xxxx';

        $this->restRepresentativeCompanyUserTradeFairRequestTransferMock->expects(static::atLeastOnce())
            ->method('getAttributes')
            ->willReturn($this->restRepresentativeCompanyUserTradeFairAttributesTransferMock);

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getUuid')
            ->willReturn($uuid);

        $this->representativeCompanyUserTradeFairFacadeMock->expects(static::atLeastOnce())
            ->method('getRepresentativeCompanyUserTradeFair')
            ->willReturn($this->representativeCompanyUserTradeFairCollectionTransferMock);

        $this->representativeCompanyUserTradeFairCollectionTransferMock->expects(static::atLeastOnce())
            ->method('getPagination')
            ->willReturn($this->paginationTransferMock);

        $restRepresentativeCompanyUserTradeFairResponse = $this
            ->tradeFairRepresentation->getTradeFairRepresentation($this->restRepresentativeCompanyUserTradeFairRequestTransferMock);

        $this->assertInstanceOf(
            RestRepresentativeCompanyUserTradeFairResponseTransfer::class,
            $restRepresentativeCompanyUserTradeFairResponse,
        );
    }

    /**
     * @return void
     */
    public function testAddTradeFairRepresentationwithDurationExceededValidationError(): void
    {
        $customerReferenceOriginator = 'customer-reference-originator';
        $companyTypeId = 1;

        $this->companyTypeFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyTypeManufacturer')
            ->willReturn($this->companyTypeTransferMock);

        $this->restRepresentativeCompanyUserTradeFairRequestTransferMock->expects(static::atLeastOnce())
            ->method('getAttributes')
            ->willReturn($this->restRepresentativeCompanyUserTradeFairAttributesTransferMock);

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReferenceOriginator')
            ->willReturn($customerReferenceOriginator);

        $this->companyTypeTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompanyType')
            ->willReturn($companyTypeId);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('hasPermission')
            ->with(
                'CanManageRepresentationOnTradeFairPermissionPlugin',
                $customerReferenceOriginator,
                $companyTypeId,
            )
            ->willReturn(true);

        $this->durationValidatorMock->expects(static::atLeastOnce())
            ->method('validate')
            ->with($this->restRepresentativeCompanyUserTradeFairAttributesTransferMock)
            ->willReturn(false);

        $restRepresentativeCompanyUserTradeFairResponse = $this->tradeFairRepresentation
            ->addTradeFairRepresentation($this->restRepresentativeCompanyUserTradeFairRequestTransferMock);

        $this->assertInstanceOf(
            RestRepresentativeCompanyUserTradeFairResponseTransfer::class,
            $restRepresentativeCompanyUserTradeFairResponse,
        );

        $this->assertEquals(false, $restRepresentativeCompanyUserTradeFairResponse->getIsSuccessful());
        $this->assertEquals(
            RepresentativeCompanyUserTradeFairRestApiConfig::ERROR_MESSAGE_REPRESENTATION_DURATION_EXCEEDED,
            $restRepresentativeCompanyUserTradeFairResponse->getError()->getDetail(),
        );
    }

    /**
     * @return void
     */
    public function testUpdateTradeFairRepresentationWithStatusFalse(): void
    {
        $startAt1 = '1970-01-01';
        $startAt2 = '1970-01-05';
        $uuid = 'xxxx-xxxxx-xxxx-xxxx';
        $customerReference = 'customer-reference';
        $companyTypeId = 1;
        $name = 'name';

        $this->restRepresentativeCompanyUserTradeFairRequestTransferMock->expects(static::atLeastOnce())
            ->method('getAttributes')
            ->willReturn($this->restRepresentativeCompanyUserTradeFairAttributesTransferMock);

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('requireUuid')
            ->willReturnSelf();

        $this->companyTypeFacadeMock->expects(static::atLeastOnce())
            ->method('getCompanyTypeManufacturer')
            ->willReturn($this->companyTypeTransferMock);

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReferenceOriginator')
            ->willReturn($customerReference);

        $this->companyTypeTransferMock->expects(static::atLeastOnce())
            ->method('getIdCompanyType')
            ->willReturn($companyTypeId);

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('hasPermission')
            ->with(
                'CanManageRepresentationOnTradeFairPermissionPlugin',
                $customerReference,
                $companyTypeId,
            )
            ->willReturn(true);

        $this->durationValidatorMock->expects(static::atLeastOnce())
            ->method('validate')
            ->with($this->restRepresentativeCompanyUserTradeFairAttributesTransferMock)
            ->willReturn(true);

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getUuid')
            ->willReturn($uuid);

        $this->representativeCompanyUserTradeFairFacadeMock->expects(static::atLeastOnce())
            ->method('findTradeFairRepresentationByUuid')
            ->with($uuid)
            ->willReturn($this->representativeCompanyUserTradeFairTransferMock);

        $this->representativeCompanyUserTradeFairTransferMock->expects(static::atLeastOnce())
            ->method('getDistributor')
            ->willReturn($this->customerTransferMock);

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($customerReference);

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReferenceRepresentative')
            ->willReturn($customerReference);

        $this->representativeCompanyUserTradeFairTransferMock->expects(static::atLeastOnce())
            ->method('setActive')
            ->willReturnSelf();

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getTradeFairName')
            ->willReturn($name);

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getStartAt')
            ->willReturn($startAt1);

        $this->representativeCompanyUserTradeFairTransferMock->expects(static::atLeastOnce())
            ->method('getStartAt')
            ->willReturn($startAt2);

        $this->representativeCompanyUserTradeFairTransferMock->expects(static::atLeastOnce())
            ->method('setEndAt')
            ->willReturnSelf();

        $this->representativeCompanyUserTradeFairTransferMock->expects(static::atLeastOnce())
            ->method('setStartAt')
            ->willReturnSelf();

        $this->representativeCompanyUserTradeFairTransferMock->expects(static::atLeastOnce())
            ->method('setName')->with($name)
            ->willReturnSelf();

        $this->representativeCompanyUserTradeFairFacadeMock->expects(static::atLeastOnce())
            ->method('updateRepresentativeCompanyUserTradeFair')
            ->with($this->representativeCompanyUserTradeFairTransferMock)
            ->willReturn($this->representativeCompanyUserTradeFairTransferMock);

        $this->restRepresentativeCompanyUserTradeFairAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReferenceRepresentative')
            ->willReturn($customerReference);

        $restRepresentativeCompanyUserTradeFairResponse = $this->tradeFairRepresentation
            ->updateTradeFairRepresentation($this->restRepresentativeCompanyUserTradeFairRequestTransferMock);

        $this->assertInstanceOf(
            RestRepresentativeCompanyUserTradeFairResponseTransfer::class,
            $restRepresentativeCompanyUserTradeFairResponse,
        );
    }
}
