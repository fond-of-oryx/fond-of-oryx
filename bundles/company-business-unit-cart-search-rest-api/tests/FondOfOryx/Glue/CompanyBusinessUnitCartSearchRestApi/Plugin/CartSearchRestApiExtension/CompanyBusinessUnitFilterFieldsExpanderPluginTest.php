<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitCartSearchRestApi\Plugin\CartSearchRestApiExtension;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Glue\CompanyBusinessUnitCartSearchRestApi\CompanyBusinessUnitCartSearchRestApiConfig;
use FondOfOryx\Shared\CompanyBusinessUnitCartSearchRestApi\CompanyBusinessUnitCartSearchRestApiConstants;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Symfony\Component\HttpFoundation\InputBag;
use Symfony\Component\HttpFoundation\Request;

class CompanyBusinessUnitFilterFieldsExpanderPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface|mixed
     */
    protected $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface|mixed
     */
    protected $restResourceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Symfony\Component\HttpFoundation\Request|mixed
     */
    protected $httpRequestMock;

    /**
     * @var \ArrayObject<\Generated\Shared\Transfer\FilterFieldTransfer>
     */
    protected $filterFieldTransfers;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitCartSearchRestApi\Plugin\CartSearchRestApiExtension\CompanyBusinessUnitFilterFieldsExpanderPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceMock = $this->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->httpRequestMock = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterFieldTransfers = new ArrayObject();

        $this->plugin = new CompanyBusinessUnitFilterFieldsExpanderPlugin();
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $companyUuid = 'cb3eb2e7-3c15-438d-870f-5206d594879b';

        $this->httpRequestMock->query = new InputBag(
            [
                CompanyBusinessUnitCartSearchRestApiConfig::PARAMETER_NAME_COMPANY_BUSINESS_UNIT_ID => $companyUuid,
            ],
        );

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getResource')
            ->willReturn($this->restResourceMock);

        $this->restResourceMock->expects(static::atLeastOnce())
            ->method('getId')
            ->willReturn(null);

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getHttpRequest')
            ->willReturn($this->httpRequestMock);

        $filterFieldTransfers = $this->plugin->expand($this->restRequestMock, $this->filterFieldTransfers);

        static::assertCount(1, $filterFieldTransfers);

        $filterFieldTransfer = $filterFieldTransfers->offsetGet(0);

        static::assertEquals(CompanyBusinessUnitCartSearchRestApiConstants::FILTER_FIELD_TYPE_COMPANY_BUSINESS_UNIT_UUID, $filterFieldTransfer->getType());
        static::assertEquals($companyUuid, $filterFieldTransfer->getValue());
    }

    /**
     * @return void
     */
    public function testExpandWithoutRequiredParam(): void
    {
        $this->httpRequestMock->query = new InputBag([]);

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getResource')
            ->willReturn($this->restResourceMock);

        $this->restResourceMock->expects(static::atLeastOnce())
            ->method('getId')
            ->willReturn(null);

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getHttpRequest')
            ->willReturn($this->httpRequestMock);

        $filterFieldTransfers = $this->plugin->expand($this->restRequestMock, $this->filterFieldTransfers);

        static::assertCount(0, $filterFieldTransfers);
    }

    /**
     * @return void
     */
    public function testExpandWithRestResourceId(): void
    {
        $restResourceId = 'cb3eb2e7-3c15-438d-870f-5206d594879b';

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getResource')
            ->willReturn($this->restResourceMock);

        $this->restResourceMock->expects(static::atLeastOnce())
            ->method('getId')
            ->willReturn($restResourceId);

        $this->restRequestMock->expects(static::never())
            ->method('getHttpRequest');

        $filterFieldTransfers = $this->plugin->expand($this->restRequestMock, $this->filterFieldTransfers);

        static::assertCount(0, $filterFieldTransfers);
    }
}
