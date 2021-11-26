<?php

namespace FondOfOryx\Client\ErpInvoicePageSearch\Plugin\SearchExtension;

use Codeception\Test\Unit;
use Elastica\Query;
use Elastica\Query\BoolQuery;
use Elastica\Query\MatchQuery;
use Elastica\Query\Terms;
use Exception;
use FondOfOryx\Client\ErpInvoicePageSearch\Dependency\Client\ErpInvoicePageSearchToCustomerClientInterface;
use FondOfOryx\Client\ErpInvoicePageSearch\Dependency\Client\ErpInvoicePageSearchToErpInvoicePermissionClientInterface;
use FondOfOryx\Client\ErpInvoicePageSearch\ErpInvoicePageSearchFactory;
use FondOfOryx\Shared\ErpInvoicePageSearch\ErpInvoicePageSearchConstants;
use FondOfOryx\Zed\ErpInvoicePermission\Communication\Plugin\Permission\SeeErpInvoicesPermissionPlugin;
use Generated\Shared\Search\ErpInvoiceIndexMap;
use Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\ErpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;

class CompanyBusinessUnitUuidErpInvoicePageSearchQueryExpanderPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface
     */
    protected $queryMock;

    /**
     * @var array<array<string>>
     */
    protected $requestParameters;

    /**
     * @var \Elastica\Query|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $elasticaQueryMock;

    /**
     * @var \Elastica\Query\BoolQuery|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $boolQueryMock;

    /**
     * @var \Elastica\Query\MatchQuery|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $matchQueryMock;

    /**
     * @var \FondOfOryx\Client\ErpInvoicePageSearch\Dependency\Client\ErpInvoicePageSearchToCustomerClientInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $customerClientMock;

    /**
     * @var \FondOfOryx\Client\ErpInvoicePageSearch\Dependency\Client\ErpInvoicePageSearchToErpInvoicePermissionClientInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $erpInvoicePermissionClientMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $customerTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitUuidCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyBusinessUnitUuidCollectionTransferMock;

    /**
     * @var \FondOfOryx\Client\ErpInvoicePageSearch\ErpInvoicePageSearchFactory|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Client\ErpInvoicePageSearch\Plugin\SearchExtension\CompanyBusinessUnitUuidErpInvoicePageSearchQueryExpanderPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->queryMock = $this->getMockBuilder(QueryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->elasticaQueryMock = $this->getMockBuilder(Query::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->boolQueryMock = $this->getMockBuilder(BoolQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->matchQueryMock = $this->getMockBuilder(MatchQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestParameters = [
            ErpInvoicePageSearchConstants::PARAMETER_COMPANY_BUSINESS_UNIT_UUID => [
                'a372035d-77b0-4ca4-8a21-692f49738bcc',
                '478d084d-b399-4094-a249-843af8afcf01',
            ],
        ];

        $this->customerClientMock = $this->getMockBuilder(ErpInvoicePageSearchToCustomerClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoicePermissionClientMock = $this->getMockBuilder(ErpInvoicePageSearchToErpInvoicePermissionClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitUuidCollectionTransferMock = $this->getMockBuilder(CompanyBusinessUnitUuidCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factoryMock = $this->getMockBuilder(ErpInvoicePageSearchFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CompanyBusinessUnitUuidErpInvoicePageSearchQueryExpanderPlugin();
        $this->plugin->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testExpandQuery(): void
    {
        $customerReference = 'FOO-C-1';
        $companyBusinessUnitUuids = [
            $this->requestParameters[ErpInvoicePageSearchConstants::PARAMETER_COMPANY_BUSINESS_UNIT_UUID][0],
        ];

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('getCustomerClient')
            ->willReturn($this->customerClientMock);

        $this->customerClientMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->customerTransferMock);

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($customerReference);

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('getErpInvoicePermissionClient')
            ->willReturn($this->erpInvoicePermissionClientMock);

        $this->erpInvoicePermissionClientMock->expects(static::atLeastOnce())
            ->method('getAccessibleCompanyBusinessUnitUuids')
            ->with(
                static::callback(
                    static function (ErpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer $erpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer) use ($customerReference) {
                        return $erpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer->getCustomerReference() === $customerReference
                            && $erpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer->getPermissionKey() === SeeErpInvoicesPermissionPlugin::KEY;
                    },
                ),
            )->willReturn($this->companyBusinessUnitUuidCollectionTransferMock);

        $this->companyBusinessUnitUuidCollectionTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyBusinessUnitIds')
            ->willReturn($companyBusinessUnitUuids);

        $this->queryMock->expects(static::atLeastOnce())
            ->method('getSearchQuery')
            ->willReturn($this->elasticaQueryMock);

        $this->elasticaQueryMock->expects(static::atLeastOnce())
            ->method('getQuery')
            ->willReturn($this->boolQueryMock);

        $this->boolQueryMock->expects(static::atLeastOnce())
            ->method('addMust')
            ->with(
                static::callback(
                    static function (Terms $terms) use ($companyBusinessUnitUuids) {
                        $data = $terms->toArray();

                        return isset($data['terms'][ErpInvoiceIndexMap::COMPANY_BUSINESS_UNIT_UUID])
                            && $data['terms'][ErpInvoiceIndexMap::COMPANY_BUSINESS_UNIT_UUID] === $companyBusinessUnitUuids;
                    },
                ),
            )->willReturn($this->boolQueryMock);

        $query = $this->plugin->expandQuery(
            $this->queryMock,
            $this->requestParameters,
        );

        static::assertEquals(
            $this->queryMock,
            $query,
        );
    }

    /**
     * @return void
     */
    public function testExpandQueryWithEmptyRequestParameters(): void
    {
        $customerReference = 'FOO-C-1';
        $companyBusinessUnitUuids = $this->requestParameters[ErpInvoicePageSearchConstants::PARAMETER_COMPANY_BUSINESS_UNIT_UUID];

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('getCustomerClient')
            ->willReturn($this->customerClientMock);

        $this->customerClientMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->customerTransferMock);

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($customerReference);

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('getErpInvoicePermissionClient')
            ->willReturn($this->erpInvoicePermissionClientMock);

        $this->erpInvoicePermissionClientMock->expects(static::atLeastOnce())
            ->method('getAccessibleCompanyBusinessUnitUuids')
            ->with(
                static::callback(
                    static function (ErpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer $erpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer) use ($customerReference) {
                        return $erpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer->getCustomerReference() === $customerReference
                            && $erpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer->getPermissionKey() === SeeErpInvoicesPermissionPlugin::KEY;
                    },
                ),
            )->willReturn($this->companyBusinessUnitUuidCollectionTransferMock);

        $this->companyBusinessUnitUuidCollectionTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyBusinessUnitIds')
            ->willReturn($companyBusinessUnitUuids);

        $this->queryMock->expects(static::atLeastOnce())
            ->method('getSearchQuery')
            ->willReturn($this->elasticaQueryMock);

        $this->elasticaQueryMock->expects(static::atLeastOnce())
            ->method('getQuery')
            ->willReturn($this->boolQueryMock);

        $this->boolQueryMock->expects(static::atLeastOnce())
            ->method('addMust')
            ->with(
                static::callback(
                    static function (Terms $terms) use ($companyBusinessUnitUuids) {
                        $data = $terms->toArray();

                        return isset($data['terms'][ErpInvoiceIndexMap::COMPANY_BUSINESS_UNIT_UUID])
                            && $data['terms'][ErpInvoiceIndexMap::COMPANY_BUSINESS_UNIT_UUID] === $companyBusinessUnitUuids;
                    },
                ),
            )->willReturn($this->boolQueryMock);

        $query = $this->plugin->expandQuery(
            $this->queryMock,
            [],
        );

        static::assertEquals(
            $this->queryMock,
            $query,
        );
    }

    /**
     * @return void
     */
    public function testExpandQueryWithUnsupportedRequestParameters(): void
    {
        $customerReference = 'FOO-C-1';
        $companyBusinessUnitUuids = [
            '42518954-f49d-48cb-9d6d-907890b223c8',
        ];

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('getCustomerClient')
            ->willReturn($this->customerClientMock);

        $this->customerClientMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->customerTransferMock);

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($customerReference);

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('getErpInvoicePermissionClient')
            ->willReturn($this->erpInvoicePermissionClientMock);

        $this->erpInvoicePermissionClientMock->expects(static::atLeastOnce())
            ->method('getAccessibleCompanyBusinessUnitUuids')
            ->with(
                static::callback(
                    static function (ErpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer $erpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer) use ($customerReference) {
                        return $erpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer->getCustomerReference() === $customerReference
                            && $erpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer->getPermissionKey() === SeeErpInvoicesPermissionPlugin::KEY;
                    },
                ),
            )->willReturn($this->companyBusinessUnitUuidCollectionTransferMock);

        $this->companyBusinessUnitUuidCollectionTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyBusinessUnitIds')
            ->willReturn($companyBusinessUnitUuids);

        $this->queryMock->expects(static::atLeastOnce())
            ->method('getSearchQuery')
            ->willReturn($this->elasticaQueryMock);

        $this->elasticaQueryMock->expects(static::atLeastOnce())
            ->method('getQuery')
            ->willReturn($this->boolQueryMock);

        $this->boolQueryMock->expects(static::atLeastOnce())
            ->method('addMust')
            ->with(
                static::callback(
                    static function (Terms $terms) {
                        $data = $terms->toArray();

                        return isset($data['terms'][ErpInvoiceIndexMap::COMPANY_BUSINESS_UNIT_UUID])
                            && count($data['terms'][ErpInvoiceIndexMap::COMPANY_BUSINESS_UNIT_UUID]) === 1
                            && $data['terms'][ErpInvoiceIndexMap::COMPANY_BUSINESS_UNIT_UUID][0] === '00000000-0000-0000-0000-000000000000';
                    },
                ),
            )->willReturn($this->boolQueryMock);

        $query = $this->plugin->expandQuery(
            $this->queryMock,
            $this->requestParameters,
        );

        static::assertEquals(
            $this->queryMock,
            $query,
        );
    }

    /**
     * @return void
     */
    public function testExpandQueryWithInvalidRequestParameters(): void
    {
        $customerReference = 'FOO-C-1';
        $companyBusinessUnitUuids = [
            '42518954-f49d-48cb-9d6d-907890b223c8',
        ];

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('getCustomerClient')
            ->willReturn($this->customerClientMock);

        $this->customerClientMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->customerTransferMock);

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($customerReference);

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('getErpInvoicePermissionClient')
            ->willReturn($this->erpInvoicePermissionClientMock);

        $this->erpInvoicePermissionClientMock->expects(static::atLeastOnce())
            ->method('getAccessibleCompanyBusinessUnitUuids')
            ->with(
                static::callback(
                    static function (ErpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer $erpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer) use ($customerReference) {
                        return $erpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer->getCustomerReference() === $customerReference
                            && $erpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer->getPermissionKey() === SeeErpInvoicesPermissionPlugin::KEY;
                    },
                ),
            )->willReturn($this->companyBusinessUnitUuidCollectionTransferMock);

        $this->companyBusinessUnitUuidCollectionTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyBusinessUnitIds')
            ->willReturn($companyBusinessUnitUuids);

        $this->queryMock->expects(static::atLeastOnce())
            ->method('getSearchQuery')
            ->willReturn($this->elasticaQueryMock);

        $this->elasticaQueryMock->expects(static::atLeastOnce())
            ->method('getQuery')
            ->willReturn($this->boolQueryMock);

        $this->boolQueryMock->expects(static::atLeastOnce())
            ->method('addMust')
            ->with(
                static::callback(
                    static function (Terms $terms) use ($companyBusinessUnitUuids) {
                        $data = $terms->toArray();

                        return isset($data['terms'][ErpInvoiceIndexMap::COMPANY_BUSINESS_UNIT_UUID])
                            && $data['terms'][ErpInvoiceIndexMap::COMPANY_BUSINESS_UNIT_UUID] === $companyBusinessUnitUuids;
                    },
                ),
            )->willReturn($this->boolQueryMock);

        $query = $this->plugin->expandQuery(
            $this->queryMock,
            [
                ErpInvoicePageSearchConstants::PARAMETER_COMPANY_BUSINESS_UNIT_UUID => '',
            ],
        );

        static::assertEquals(
            $this->queryMock,
            $query,
        );
    }

    /**
     * @return void
     */
    public function testExpandQueryWithoutBoolQuery(): void
    {
        $customerReference = 'FOO-C-1';
        $companyBusinessUnitUuids = $this->requestParameters[ErpInvoicePageSearchConstants::PARAMETER_COMPANY_BUSINESS_UNIT_UUID];

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('getCustomerClient')
            ->willReturn($this->customerClientMock);

        $this->customerClientMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->customerTransferMock);

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($customerReference);

        $this->factoryMock->expects(static::atLeastOnce())
            ->method('getErpInvoicePermissionClient')
            ->willReturn($this->erpInvoicePermissionClientMock);

        $this->erpInvoicePermissionClientMock->expects(static::atLeastOnce())
            ->method('getAccessibleCompanyBusinessUnitUuids')
            ->with(
                static::callback(
                    static function (ErpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer $erpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer) use ($customerReference) {
                        return $erpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer->getCustomerReference() === $customerReference
                            && $erpInvoicePermissionCompanyBusinessUnitUuidRequestTransfer->getPermissionKey() === SeeErpInvoicesPermissionPlugin::KEY;
                    },
                ),
            )->willReturn($this->companyBusinessUnitUuidCollectionTransferMock);

        $this->companyBusinessUnitUuidCollectionTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyBusinessUnitIds')
            ->willReturn($companyBusinessUnitUuids);

        $this->queryMock->expects(static::atLeastOnce())
            ->method('getSearchQuery')
            ->willReturn($this->elasticaQueryMock);

        $this->elasticaQueryMock->expects(static::atLeastOnce())
            ->method('getQuery')
            ->willReturn($this->matchQueryMock);

        try {
            $this->plugin->expandQuery(
                $this->queryMock,
                $this->requestParameters,
            );

            static::fail();
        } catch (Exception $exception) {
        }
    }

    /**
     * @return void
     */
    public function testExpandQueryWithNotLoggedInCustomer(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('getCustomerClient')
            ->willReturn($this->customerClientMock);

        $this->customerClientMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn(null);

        $this->factoryMock->expects(static::never())
            ->method('getErpInvoicePermissionClient');

        $this->erpInvoicePermissionClientMock->expects(static::never())
            ->method('getAccessibleCompanyBusinessUnitUuids');

        $this->queryMock->expects(static::atLeastOnce())
            ->method('getSearchQuery')
            ->willReturn($this->elasticaQueryMock);

        $this->elasticaQueryMock->expects(static::atLeastOnce())
            ->method('getQuery')
            ->willReturn($this->boolQueryMock);

        $this->boolQueryMock->expects(static::atLeastOnce())
            ->method('addMust')
            ->with(
                static::callback(
                    static function (Terms $terms) {
                        $data = $terms->toArray();

                        return isset($data['terms'][ErpInvoiceIndexMap::COMPANY_BUSINESS_UNIT_UUID])
                            && count($data['terms'][ErpInvoiceIndexMap::COMPANY_BUSINESS_UNIT_UUID]) === 1
                            && $data['terms'][ErpInvoiceIndexMap::COMPANY_BUSINESS_UNIT_UUID][0] === '00000000-0000-0000-0000-000000000000';
                    },
                ),
            )->willReturn($this->boolQueryMock);

        $query = $this->plugin->expandQuery(
            $this->queryMock,
            $this->requestParameters,
        );

        static::assertEquals(
            $this->queryMock,
            $query,
        );
    }
}
