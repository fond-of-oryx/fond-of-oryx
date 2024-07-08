<?php

namespace FondOfOryx\Client\EasyApi\Zed;

use Codeception\Test\Unit;
use FondOfOryx\Client\EasyApi\Dependency\Client\EasyApiToZedRequestClientInterface;
use Generated\Shared\Transfer\EasyApiFilterTransfer;
use Generated\Shared\Transfer\EasyApiRequestTransfer;
use Generated\Shared\Transfer\EasyApiResponseTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class EasyApiZedStubTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\EasyApiRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected EasyApiRequestTransfer|MockObject $easyApiRequestTransfer;

    /**
     * @var \Generated\Shared\Transfer\EasyApiFilterTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected EasyApiFilterTransfer|MockObject $easyApiFilterTransfer;

    /**
     * @var \Generated\Shared\Transfer\EasyApiResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected EasyApiResponseTransfer|MockObject $easyApiResponseTransfer;

    /**
     * @var \FondOfOryx\Client\EasyApi\Dependency\Client\EasyApiToZedRequestClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|EasyApiToZedRequestClientInterface $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\EasyApi\Zed\EasyApiZedStub
     */
    protected EasyApiZedStub $easyApiZedStub;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->easyApiRequestTransfer = $this->getMockBuilder(EasyApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->easyApiFilterTransfer = $this->getMockBuilder(EasyApiFilterTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->easyApiResponseTransfer = $this->getMockBuilder(EasyApiResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedRequestClientMock = $this->getMockBuilder(EasyApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->easyApiZedStub = new EasyApiZedStub(
            $this->zedRequestClientMock,
        );
    }

    /**
     * @return void
     */
    public function testGetDocument(): void
    {
        $this->zedRequestClientMock->expects(static::atLeastOnce())
            ->method('call')
            ->with(
                EasyApiZedStub::URL_GET_DOCUMENT,
                $this->easyApiRequestTransfer,
            )->willReturn($this->easyApiResponseTransfer);

        static::assertEquals(
            $this->easyApiResponseTransfer,
            $this->easyApiZedStub->getDocument(
                $this->easyApiRequestTransfer,
            ),
        );
    }

    /**
     * @return void
     */
    public function testFindDocument(): void
    {
        $this->zedRequestClientMock->expects(static::atLeastOnce())
            ->method('call')
            ->with(
                EasyApiZedStub::URL_FIND_DOCUMENT,
                $this->easyApiFilterTransfer,
            )->willReturn($this->easyApiResponseTransfer);

        static::assertEquals(
            $this->easyApiResponseTransfer,
            $this->easyApiZedStub->findDocument(
                $this->easyApiFilterTransfer,
            ),
        );
    }
}
