<?php

namespace FondOfOryx\Glue\BusinessOnBehalfCompanyUserSearchRestApi\Plugin\CompanyUserSearchRestApiExtension;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Shared\BusinessOnBehalfCompanyUserSearchRestApi\BusinessOnBehalfCompanyUserSearchRestApiConstants;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

class BusinessOnBehalfFilterFieldsExpanderPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected RestRequestInterface|MockObject $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Symfony\Component\HttpFoundation\Request
     */
    protected MockObject|Request $httpRequestMock;

    /**
     * @var \ArrayObject<\PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\FilterFieldTransfer>
     */
    protected ArrayObject $filterFieldTransferMocks;

    /**
     * @var \FondOfOryx\Glue\BusinessOnBehalfCompanyUserSearchRestApi\Plugin\CompanyUserSearchRestApiExtension\BusinessOnBehalfFilterFieldsExpanderPlugin
     */
    protected BusinessOnBehalfFilterFieldsExpanderPlugin $plugin;

    /**
     * @Override
     *
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

        $this->filterFieldTransferMocks = new ArrayObject();

        $this->plugin = new BusinessOnBehalfFilterFieldsExpanderPlugin();
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $isDefault = 'true';

        $this->httpRequestMock->query = new ParameterBag(
            [
                BusinessOnBehalfCompanyUserSearchRestApiConstants::PARAMETER_NAME_IS_DEFAULT => $isDefault,
            ],
        );

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getHttpRequest')
            ->willReturn($this->httpRequestMock);

        $filterFieldTransfers = $this->plugin->expand($this->restRequestMock, $this->filterFieldTransferMocks);

        static::assertCount(1, $filterFieldTransfers);

        $filterFieldTransfer = $filterFieldTransfers->offsetGet(0);

        static::assertEquals($isDefault, $filterFieldTransfer->getValue());
        static::assertEquals(
            BusinessOnBehalfCompanyUserSearchRestApiConstants::FILTER_FIELD_TYPE_IS_DEFAULT,
            $filterFieldTransfer->getType(),
        );
    }
}
