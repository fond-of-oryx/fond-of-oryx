<?php

namespace FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter;

use Codeception\Test\Unit;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

class CompanyRoleNameFilterTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface|mixed
     */
    protected $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Symfony\Component\HttpFoundation\Request|mixed
     */
    protected $httpRequestMock;

    /**
     * @var \Symfony\Component\HttpFoundation\ParameterBag
     */
    protected $inputBag;

    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\CompanyRoleNameFilter
     */
    protected $companyRoleNameFilter;

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

        $this->companyRoleNameFilter = new CompanyRoleNameFilter();
    }

    /**
     * @return void
     */
    public function testGetRequestParameter(): void
    {
        $this->httpRequestMock->query = new ParameterBag(['company-role-name' => ['foo', 'bar']]);

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getHttpRequest')
            ->willReturn($this->httpRequestMock);

        static::assertEquals(
            ['foo', 'bar'],
            $this->companyRoleNameFilter->filterFromRestRequest($this->restRequestMock),
        );
    }

    /**
     * @return void
     */
    public function testGetRequestParameterWithNonExistingName(): void
    {
        $this->httpRequestMock->query = new ParameterBag();

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getHttpRequest')
            ->willReturn($this->httpRequestMock);

        static::assertEquals(
            [],
            $this->companyRoleNameFilter->filterFromRestRequest($this->restRequestMock),
        );
    }
}
