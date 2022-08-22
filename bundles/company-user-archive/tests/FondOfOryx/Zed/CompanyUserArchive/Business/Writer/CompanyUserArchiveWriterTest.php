<?php

namespace FondOfOryx\Zed\CompanyUserArchive\Business\Writer;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUserArchive\Persistence\CompanyUserArchiveEntityManagerInterface;
use Generated\Shared\Transfer\CompanyUserArchiveTransfer;
use Psr\Log\LoggerInterface;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface;
use Spryker\Zed\PropelOrm\Business\Transaction\PropelDatabaseTransactionHandler;

class CompanyUserArchiveWriterTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CompanyUserArchiveTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyUserArchiveTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserCompanyRoleConnector\Dependency\Facade\CompanyUserCompanyRoleConnectorToCompanyRoleFacadeInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $entityManagerMock;

    /**
     * @var \Psr\Log\LoggerInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $loggerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
     */
    protected $transactionHandlerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUserArchive\Business\Writer\CompanyUserArchiveWriterInterface
     */
    protected $writer;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->entityManagerMock = $this
            ->getMockBuilder(CompanyUserArchiveEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserArchiveTransferMock = $this->getMockBuilder(CompanyUserArchiveTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->loggerMock = $this->getMockBuilder(LoggerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transactionHandlerMock = $this->getMockBuilder(PropelDatabaseTransactionHandler::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->writer = new class (
            $this->transactionHandlerMock,
            $this->entityManagerMock,
            $this->loggerMock
        ) extends CompanyUserArchiveWriter
        {
            /**
             * @var \Psr\Log\LoggerInterface
             */
                 protected $logger;

                /**
                 * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
                 */
                private $transactionHandler;

                /**
                 * @param \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface $transactionHandler
                 * @param \FondOfOryx\Zed\CompanyUserArchive\Persistence\CompanyUserArchiveEntityManagerInterface $entityManager
                 * @param \Psr\Log\LoggerInterface $logger
                 */
            public function __construct(
                TransactionHandlerInterface $transactionHandler,
                CompanyUserArchiveEntityManagerInterface $entityManager,
                LoggerInterface $logger
            ) {
                parent::__construct($entityManager, $logger);

                $this->transactionHandler = $transactionHandler;
            }

                /**
                 * @return \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
                 */
            public function getTransactionHandler()
            {
                return $this->transactionHandler;
            }
        };
    }

    /**
     * @return void
     */
    public function testCreateCompanyUserArchive(): void
    {
        $this->transactionHandlerMock->expects(static::atLeastOnce())
            ->method('handleTransaction')
            ->willReturn($this->companyUserArchiveTransferMock);

        static::assertInstanceOf(
            CompanyUserArchiveTransfer::class,
            $this->writer->createCompanyUserArchive($this->companyUserArchiveTransferMock),
        );
    }
}
