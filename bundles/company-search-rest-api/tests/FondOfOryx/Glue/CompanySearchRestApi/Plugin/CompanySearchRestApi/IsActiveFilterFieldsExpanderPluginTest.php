<?php

namespace FondOfOryx\Glue\CompanySearchRestApi\Plugin\CompanySearchRestApi;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Glue\CompanySearchRestApi\Plugin\CompanySearchRestApiExtension\IsActiveFilterFieldsExpanderPlugin;
use FondOfOryx\Shared\CompanySearchRestApi\CompanySearchRestApiConstants;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

class IsActiveFilterFieldsExpanderPluginTest extends Unit
{
    /**
     * @var \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestRequestInterface|MockObject $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Symfony\Component\HttpFoundation\Request
     */
    protected MockObject|Request $httpRequestMock;

    /**
     * @var \ArrayObject<\PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\FilterFieldTransfer>
     */
    protected ArrayObject $filterFieldTransfers;

    /**
     * @var \FondOfOryx\Glue\CompanySearchRestApi\Plugin\CompanySearchRestApiExtension\IsActiveFilterFieldsExpanderPlugin
     */
    protected IsActiveFilterFieldsExpanderPlugin $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->httpRequestMock = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterFieldTransfers = new ArrayObject();

        $this->plugin = new IsActiveFilterFieldsExpanderPlugin();
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $isActive = 'false';

        $this->httpRequestMock->query = new ParameterBag(
            [
                CompanySearchRestApiConstants::PARAMETER_NAME_IS_ACTIVE => $isActive,
            ],
        );

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getHttpRequest')
            ->willReturn($this->httpRequestMock);

        $filterFieldTransfers = $this->plugin->expand(
            $this->restRequestMock,
            $this->filterFieldTransfers,
        );

        static::assertCount(1, $filterFieldTransfers);

        $filterFieldTransfer = $filterFieldTransfers->offsetGet(0);

        static::assertEquals($isActive, $filterFieldTransfer->getValue());
        static::assertEquals(
            CompanySearchRestApiConstants::FILTER_FIELD_TYPE_IS_ACTIVE,
            $filterFieldTransfer->getType(),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithoutRequiredParam(): void
    {
        $this->httpRequestMock->query = new ParameterBag([]);

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getHttpRequest')
            ->willReturn($this->httpRequestMock);

        $filterFieldTransfers = $this->plugin->expand($this->restRequestMock, $this->filterFieldTransfers);

        $filterFieldTransfer = $filterFieldTransfers->offsetGet(0);

        static::assertEquals('true', $filterFieldTransfer->getValue());
        static::assertEquals(
            CompanySearchRestApiConstants::FILTER_FIELD_TYPE_IS_ACTIVE,
            $filterFieldTransfer->getType(),
        );
    }
}
