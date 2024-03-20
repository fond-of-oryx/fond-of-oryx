<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Plugin\FilterExpander;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Filter\RequestParameterFilterInterface;
use FondOfOryx\Shared\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiConstants;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Symfony\Component\HttpFoundation\InputBag;
use Symfony\Component\HttpFoundation\Request;

class FullTextExpanderPluginTest extends Unit
{
    /**
     * @var \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestRequestInterface|MockObject $restRequestMock;

    /**
     * @var \Symfony\Component\HttpFoundation\Request|\PHPUnit\Framework\MockObject\MockObject
     */
    protected Request|MockObject $requestMock;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Filter\RequestParameterFilterInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected RequestParameterFilterInterface|MockObject $requestParameterFilterMock;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Plugin\FilterExpander\FullTextExpanderPlugin
     */
    protected FullTextExpanderPlugin $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestMock = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestParameterFilterMock = $this->getMockBuilder(RequestParameterFilterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new FullTextExpanderPlugin();
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $query = new InputBag();
        $query->add([FullTextExpanderPlugin::FILTER_NAME => 'this is a test']);
        $collection = new ArrayObject();

        $this->requestMock->query = $query;

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getHttpRequest')
            ->willReturn($this->requestMock);

        $collection = $this->plugin->expand($this->restRequestMock, $collection);

        static::assertEquals(
            $collection->offsetGet(0)->getValue(),
            'this is a test',
        );

        static::assertEquals(
            $collection->offsetGet(0)->getType(),
            CompanyBusinessUnitAddressSearchRestApiConstants::FILTER_FIELD_TYPE_FULL_TEXT,
        );
    }
}
