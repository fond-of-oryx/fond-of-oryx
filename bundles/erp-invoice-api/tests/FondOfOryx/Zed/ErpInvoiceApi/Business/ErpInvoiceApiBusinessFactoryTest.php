<?php

namespace FondOfOryx\Zed\ErpInvoiceApi\Business;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\ErpInvoiceApi\Business\Model\ErpInvoiceApi;
use FondOfOryx\Zed\ErpInvoiceApi\Business\Validator\ErpInvoiceApiValidator;
use FondOfOryx\Zed\ErpInvoiceApi\Dependency\Facade\ErpInvoiceApiToApiFacadeInterface;
use FondOfOryx\Zed\ErpInvoiceApi\Dependency\Facade\ErpInvoiceApiToErpInvoiceFacadeInterface;
use FondOfOryx\Zed\ErpInvoiceApi\ErpInvoiceApiDependencyProvider;
use FondOfOryx\Zed\ErpInvoiceApi\Persistence\ErpInvoiceApiRepository;
use Spryker\Zed\Kernel\Container;

class ErpInvoiceApiBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoiceApi\Dependency\Facade\ErpInvoiceApiToErpInvoiceFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoiceApi\Dependency\Facade\ErpInvoiceApiToApiFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoiceApi\Persistence\ErpInvoiceApiRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoiceApi\Business\ErpInvoiceApiBusinessFactory
     */
    protected $erpInvoiceApiBusinessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceFacadeMock = $this->getMockBuilder(ErpInvoiceApiToErpInvoiceFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiFacadeMock = $this->getMockBuilder(ErpInvoiceApiToApiFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(ErpInvoiceApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceApiBusinessFactory = new ErpInvoiceApiBusinessFactory();
        $this->erpInvoiceApiBusinessFactory->setContainer($this->containerMock);
        $this->erpInvoiceApiBusinessFactory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateErpInvoiceApi(): void
    {
        $self = $this;

        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case ErpInvoiceApiDependencyProvider::FACADE_API:
                        return $self->apiFacadeMock;
                    case ErpInvoiceApiDependencyProvider::FACADE_ERP_INVOICE:
                        return $self->erpInvoiceFacadeMock;
                }

                throw new Exception('Unexpected call');
            });

        static::assertInstanceOf(
            ErpInvoiceApi::class,
            $this->erpInvoiceApiBusinessFactory->createErpInvoiceApi(),
        );
    }

    /**
     * @return void
     */
    public function testCreateErpInvoiceApiValidator(): void
    {
        static::assertInstanceOf(
            ErpInvoiceApiValidator::class,
            $this->erpInvoiceApiBusinessFactory->createErpInvoiceApiValidator(),
        );
    }
}
