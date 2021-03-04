<?php

namespace FondOfOryx\Client\ErpOrderPageSearch\Plugin\SearchExtension;

use ArrayObject;
use Codeception\Test\Unit;
use Elastica\Query;
use Elastica\Query\BoolQuery;
use Exception;
use FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client\ErpOrderPageSearchToCompanyUserClientInterface;
use FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client\ErpOrderPageSearchToCustomerClientInterface;
use FondOfOryx\Client\ErpOrderPageSearch\ErpOrderPageSearchFactory;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyUserCollectionTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;
use stdClass;

class ErpOrderPageSearchCompanyBusinessUnitUuidFilterQueryExpanderPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Elastica\Query\BoolQuery
     */
    protected $elasticaBoolQueryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     */
    protected $companyBusinessUnitTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUserCollectionTransfer
     */
    protected $companyUserCollectionTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUserTransfer
     */
    protected $companyUserTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CustomerTransfer
     */
    protected $customerTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Elastica\Query
     */
    protected $elasticaQueryMock;

    /**
     * @var \FondOfOryx\Client\ErpOrderPageSearch\Plugin\SearchExtension\ErpOrderPageSearchCompanyBusinessUnitUuidFilterQueryExpanderPlugin
     */
    protected $erpOrderPageSearchCompanyBusinessUnitUuidFilterQueryExpanderPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client\ErpOrderPageSearchToCompanyUserClientInterface
     */
    protected $erpOrderPageSearchToCompanyUserClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client\ErpOrderPageSearchToCustomerClientInterface
     */
    protected $erpOrderPageSearchToCustomerClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Client\ErpOrderPageSearch\ErpOrderPageSearchFactory
     */
    protected $erpOrderPageSearchFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface
     */
    protected $pluginQueryMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->pluginQueryMock = $this->getMockBuilder(QueryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchFactoryMock = $this->getMockBuilder(ErpOrderPageSearchFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchToCustomerClientMock = $this->getMockBuilder(ErpOrderPageSearchToCustomerClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchToCompanyUserClientMock = $this->getMockBuilder(ErpOrderPageSearchToCompanyUserClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserCollectionTransferMock = $this->getMockBuilder(CompanyUserCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserTransferMock = $this->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitTransferMock = $this->getMockBuilder(CompanyBusinessUnitTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->elasticaQueryMock = $this->getMockBuilder(Query::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->elasticaBoolQueryMock = $this->getMockBuilder(BoolQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchCompanyBusinessUnitUuidFilterQueryExpanderPlugin =
            new ErpOrderPageSearchCompanyBusinessUnitUuidFilterQueryExpanderPlugin();

        $this->erpOrderPageSearchCompanyBusinessUnitUuidFilterQueryExpanderPlugin
            ->setFactory($this->erpOrderPageSearchFactoryMock);
    }

    /**
     * @skip
     *
     * @return void
     */
    public function testExpandQuery(): void
    {
        $companyUsers = new ArrayObject();
        $companyUsers->append($this->companyUserTransferMock);

        $requestParameters = [
            'filters' => [
                'company-business-unit' => [
                    [
                        'resource' => 'company-business-unit',
                        'value' => '73327634-71c4-11eb-9439-0242ac130002',
                        'field' => 'uuid',
                    ],
                ],
            ],
        ];

        $this->erpOrderPageSearchFactoryMock->expects(static::atLeastOnce())
            ->method('getCustomerClient')
            ->willReturn($this->erpOrderPageSearchToCustomerClientMock);

        $this->erpOrderPageSearchToCustomerClientMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->customerTransferMock);

        $this->erpOrderPageSearchFactoryMock->expects(static::atLeastOnce())
            ->method('getCompanyUserClient')
            ->willReturn($this->erpOrderPageSearchToCompanyUserClientMock);

        $this->erpOrderPageSearchToCompanyUserClientMock->expects(static::atLeastOnce())
            ->method('getActiveCompanyUsersByCustomerReference')
            ->with($this->customerTransferMock)
            ->willReturn($this->companyUserCollectionTransferMock);

        $this->companyUserCollectionTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUsers')
            ->willReturn($companyUsers);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUserReference')
            ->willReturn('company-user-reference');

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getExternalReference')
            ->willReturn('external-reference');

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyBusinessUnit')
            ->willReturn($this->companyBusinessUnitTransferMock);

        $this->companyBusinessUnitTransferMock->expects(static::atLeastOnce())
            ->method('getUuid')
            ->willReturn('73327634-71c4-11eb-9439-0242ac130002');

        $this->companyBusinessUnitTransferMock->expects(static::atLeastOnce())
            ->method('getUuid')
            ->willReturn('73327634-71c4-11eb-9439-0242ac130002');

        $this->companyBusinessUnitTransferMock->expects(static::atLeastOnce())
            ->method('getExternalReference')
            ->willReturn('company-business-unit-external-reference');

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyBusinessUnit')
            ->willReturn($this->companyBusinessUnitTransferMock);

        $this->companyBusinessUnitTransferMock->expects(static::atLeastOnce())
            ->method('getUuid')
            ->willReturn('73327634-71c4-11eb-9439-0242ac130002');

        $this->pluginQueryMock->expects(static::atLeastOnce())
            ->method('getSearchQuery')
            ->willReturn($this->elasticaQueryMock);

        $this->elasticaQueryMock->expects(static::atLeastOnce())
            ->method('getQuery')
            ->willReturn($this->elasticaBoolQueryMock);

        $this->elasticaBoolQueryMock->expects(static::atLeastOnce())
            ->method('addMust')
            ->willReturn($this->elasticaBoolQueryMock);

        $query = $this->erpOrderPageSearchCompanyBusinessUnitUuidFilterQueryExpanderPlugin->expandQuery(
            $this->pluginQueryMock,
            $requestParameters
        );

        $this->assertInstanceOf(
            QueryInterface::class,
            $query
        );
    }

    /**
     * @return void
     */
    public function testExpandQueryWithWrongBoolQueryObject(): void
    {
        $companyUsers = new ArrayObject();
        $requestParameters = [
            'filters' => [],
        ];

        $this->erpOrderPageSearchFactoryMock->expects(static::atLeastOnce())
            ->method('getCustomerClient')
            ->willReturn($this->erpOrderPageSearchToCustomerClientMock);

        $this->erpOrderPageSearchToCustomerClientMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->customerTransferMock);

        $this->erpOrderPageSearchFactoryMock->expects(static::atLeastOnce())
            ->method('getCompanyUserClient')
            ->willReturn($this->erpOrderPageSearchToCompanyUserClientMock);

        $this->erpOrderPageSearchToCompanyUserClientMock->expects(static::atLeastOnce())
            ->method('getActiveCompanyUsersByCustomerReference')
            ->with($this->customerTransferMock)
            ->willReturn($this->companyUserCollectionTransferMock);

        $this->companyUserCollectionTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUsers')
            ->willReturn($companyUsers);

        $this->customerTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUserTransfer')
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyBusinessUnit')
            ->willReturn($this->companyBusinessUnitTransferMock);

        $this->companyBusinessUnitTransferMock->expects(static::atLeastOnce())
            ->method('getUuid')
            ->willReturn('73327634-71c4-11eb-9439-0242ac130002');

        $this->pluginQueryMock->expects(static::atLeastOnce())
            ->method('getSearchQuery')
            ->willReturn($this->elasticaQueryMock);

        $this->elasticaQueryMock->expects(static::atLeastOnce())
            ->method('getQuery')
            ->willReturn(new stdClass());

        $this->expectException(Exception::class);

        $this->erpOrderPageSearchCompanyBusinessUnitUuidFilterQueryExpanderPlugin->expandQuery(
            $this->pluginQueryMock,
            $requestParameters
        );
    }
}
