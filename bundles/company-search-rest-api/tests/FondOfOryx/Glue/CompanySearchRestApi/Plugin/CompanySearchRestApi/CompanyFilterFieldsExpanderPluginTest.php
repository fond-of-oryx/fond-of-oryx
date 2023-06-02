<?php

namespace FondOfOryx\Glue\CompanySearchRestApi\Plugin\CompanySearchRestApi;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Glue\CompanySearchRestApi\Plugin\CompanySearchRestApiExtension\CompanyFilterFieldsExpanderPlugin;
use FondOfOryx\Shared\CompanySearchRestApi\CompanySearchRestApiConstants;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

class CompanyFilterFieldsExpanderPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected RestRequestInterface|MockObject $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Symfony\Component\HttpFoundation\Request&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected MockObject|Request $httpRequestMock;

    /**
     * @var \ArrayObject<\PHPUnit\Framework\MockObject\MockObject|(\Generated\Shared\Transfer\FilterFieldTransfer&\PHPUnit\Framework\MockObject\MockObject)>
     */
    protected ArrayObject $filterFieldTransfers;

    /**
     * @var \FondOfOryx\Glue\CompanySearchRestApi\Plugin\CompanySearchRestApiExtension\CompanyFilterFieldsExpanderPlugin
     */
    protected CompanyFilterFieldsExpanderPlugin $plugin;

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

        $this->plugin = new CompanyFilterFieldsExpanderPlugin();
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $companyUuid = 'cb3eb2e7-3c15-438d-870f-5206d594879b';

        $this->httpRequestMock->query = new ParameterBag(
            [
                CompanySearchRestApiConstants::PARAMETER_NAME_ID => $companyUuid,
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

        static::assertEquals($companyUuid, $filterFieldTransfer->getValue());
        static::assertEquals(
            CompanySearchRestApiConstants::FILTER_FIELD_TYPE_UUID,
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

        static::assertCount(0, $filterFieldTransfers);
    }
}
