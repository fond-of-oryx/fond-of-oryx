<?php

namespace FondOfOryx\Glue\CompanyUserCartSearchRestApi\Plugin\CartSearchRestApiExtension;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Shared\CompanyUserCartSearchRestApi\CompanyUserCartSearchRestApiConstants;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

class CompanyUserFilterFieldsExpanderPluginTest extends Unit
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
    protected ArrayObject $filterFieldTransferMocks;

    /**
     * @var \FondOfOryx\Glue\CompanyUserCartSearchRestApi\Plugin\CartSearchRestApiExtension\CompanyUserFilterFieldsExpanderPlugin
     */
    protected CompanyUserFilterFieldsExpanderPlugin $plugin;

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

        $this->plugin = new CompanyUserFilterFieldsExpanderPlugin();
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $companyUserReference = 'foo';

        $this->httpRequestMock->query = new ParameterBag(
            [
                CompanyUserCartSearchRestApiConstants::PARAMETER_NAME_COMPANY_USER_REFERENCE => $companyUserReference,
            ],
        );

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getHttpRequest')
            ->willReturn($this->httpRequestMock);

        $filterFieldTransfers = $this->plugin->expand($this->restRequestMock, $this->filterFieldTransferMocks);

        static::assertCount(1, $filterFieldTransfers);

        $filterFieldTransfer = $filterFieldTransfers->offsetGet(0);

        static::assertEquals($companyUserReference, $filterFieldTransfer->getValue());
        static::assertEquals(
            CompanyUserCartSearchRestApiConstants::FILTER_FIELD_TYPE_COMPANY_USER_REFERENCE,
            $filterFieldTransfer->getType(),
        );
    }
}
