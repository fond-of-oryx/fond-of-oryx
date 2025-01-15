<?php

namespace FondOfOryx\Zed\CompanyDeleter\Business;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\CompanyDeleter\Business\Executor\PluginExecutor;
use FondOfOryx\Zed\CompanyDeleter\Business\Model\CompanyDeleter;
use FondOfOryx\Zed\CompanyDeleter\CompanyDeleterDependencyProvider;
use FondOfOryx\Zed\CompanyDeleter\Dependency\Facade\CompanyDeleterToCompanyFacadeInterface;
use Psr\Log\LoggerInterface;
use Spryker\Shared\Log\Config\LoggerConfigInterface;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface;

class CompanyDeleterBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleter\Dependency\Facade\CompanyDeleterToCompanyFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyFacadeMock;

    /**
     * @var \Psr\Log\LoggerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $loggerMock;

    /**
     * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $transactionHandlerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleter\Business\CompanyDeleterBusinessFactory
     */
    protected $businessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyFacadeMock = $this->getMockBuilder(CompanyDeleterToCompanyFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->loggerMock = $this->getMockBuilder(LoggerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transactionHandlerMock = $this->getMockBuilder(TransactionHandlerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new class ($this->transactionHandlerMock, $this->loggerMock) extends CompanyDeleterBusinessFactory {
            /**
             * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
             */
            protected $transactionHandlerMock;

            /**
             * @var \Psr\Log\LoggerInterface
             */
            protected $loggerMock;

            /**
             * @param \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface $transactionHandler
             * @param \Psr\Log\LoggerInterface $logger
             */
            public function __construct(TransactionHandlerInterface $transactionHandler, LoggerInterface $logger)
            {
                $this->transactionHandlerMock = $transactionHandler;
                $this->loggerMock = $logger;
            }

            /**
             * @return \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
             */
            public function getTransactionHandler()
            {
                return $this->transactionHandlerMock;
            }

            /**
             * @param \Spryker\Shared\Log\Config\LoggerConfigInterface|null $loggerConfig
             *
             * @return \Psr\Log\LoggerInterface
             */
            protected function getLogger(?LoggerConfigInterface $loggerConfig = null): LoggerInterface
            {
                return $this->loggerMock;
            }
        };
        $this->businessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyDeleter(): void
    {
        $self = $this;

        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case CompanyDeleterDependencyProvider::FACADE_COMPANY:
                        return $self->companyFacadeMock;
                    case CompanyDeleterDependencyProvider::PLUGINS_PRE_COMPANY_DELETER:
                        return [];
                    case CompanyDeleterDependencyProvider::PLUGINS_POST_COMPANY_DELETER:
                        return [];
                }

                throw new Exception('Unexpected call');
            });

        static::assertInstanceOf(
            CompanyDeleter::class,
            $this->businessFactory->createCompanyDeleter(),
        );
    }

    /**
     * @return void
     */
    public function testCreateCompanyDeleterPluginExecutor(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturnCallback(static function (string $key) {
                switch ($key) {
                    case CompanyDeleterDependencyProvider::PLUGINS_PRE_COMPANY_DELETER:
                        return [];
                    case CompanyDeleterDependencyProvider::PLUGINS_POST_COMPANY_DELETER:
                        return [];
                }

                throw new Exception('Unexpected call');
            });

        static::assertInstanceOf(
            PluginExecutor::class,
            $this->businessFactory->createCompanyDeleterPluginExecutor(),
        );
    }
}
