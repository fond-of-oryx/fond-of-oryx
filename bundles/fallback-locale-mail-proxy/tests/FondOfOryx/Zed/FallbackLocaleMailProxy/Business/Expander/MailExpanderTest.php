<?php

namespace FondOfOryx\Zed\FallbackLocaleMailProxy\Business\Expander;

use Codeception\Test\Unit;
use FondOfOryx\Zed\FallbackLocaleMailProxy\Business\Reader\StoreReaderInterface;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\StoreTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class MailExpanderTest extends Unit
{
    /**
     * @var (\FondOfOryx\Zed\FallbackLocaleMailProxy\Business\Reader\StoreReaderInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|StoreReaderInterface $storeReaderMock;

    /**
     * @var (\Generated\Shared\Transfer\MailTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|MailTransfer $mailTransferMock;

    /**
     * @var (\Generated\Shared\Transfer\StoreTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected StoreTransfer|MockObject $storeTransferMock;

    /**
     * @var (\Generated\Shared\Transfer\LocaleTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|LocaleTransfer $localeTransferMock;

    /**
     * @var \FondOfOryx\Zed\FallbackLocaleMailProxy\Business\Expander\MailExpander
     */
    protected MailExpander $mailExpander;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->storeReaderMock = $this->getMockBuilder(StoreReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailTransferMock = $this->getMockBuilder(MailTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeTransferMock = $this->getMockBuilder(StoreTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailExpander = new MailExpander(
            $this->storeReaderMock,
        );
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $defaultLocaleIsoCode = 'en_US';
        $localeName = 'fr_FR';
        $availableLocaleIsoCodes = [
            $defaultLocaleIsoCode,
            'de_DE',
        ];

        $this->storeReaderMock->expects(static::atLeastOnce())
            ->method('getByMail')
            ->with($this->mailTransferMock)
            ->willReturn($this->storeTransferMock);

        $this->storeTransferMock->expects(static::atLeastOnce())
            ->method('getDefaultLocaleIsoCode')
            ->willReturn($defaultLocaleIsoCode);

        $this->mailTransferMock->expects(static::atLeastOnce())
            ->method('getLocale')
            ->willReturn($this->localeTransferMock);

        $this->storeTransferMock->expects(static::atLeastOnce())
            ->method('getAvailableLocaleIsoCodes')
            ->willReturn($availableLocaleIsoCodes);

        $this->localeTransferMock->expects(static::atLeastOnce())
            ->method('getLocaleName')
            ->willReturn($localeName);

        $this->mailTransferMock->expects(static::atLeastOnce())
            ->method('setLocale')
            ->with(
                static::callback(
                    static function (LocaleTransfer $localeTransfer) use ($defaultLocaleIsoCode) {
                        return $localeTransfer->getLocaleName() === $defaultLocaleIsoCode;
                    },
                ),
            )->willReturn($this->mailTransferMock);

        static::assertEquals(
            $this->mailTransferMock,
            $this->mailExpander->expand($this->mailTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithNullableLocale(): void
    {
        $defaultLocaleIsoCode = 'en_US';

        $this->storeReaderMock->expects(static::atLeastOnce())
            ->method('getByMail')
            ->with($this->mailTransferMock)
            ->willReturn($this->storeTransferMock);

        $this->storeTransferMock->expects(static::atLeastOnce())
            ->method('getDefaultLocaleIsoCode')
            ->willReturn($defaultLocaleIsoCode);

        $this->mailTransferMock->expects(static::atLeastOnce())
            ->method('getLocale')
            ->willReturn(null);

        $this->storeTransferMock->expects(static::never())
            ->method('getAvailableLocaleIsoCodes');

        $this->localeTransferMock->expects(static::never())
            ->method('getLocaleName');

        $this->mailTransferMock->expects(static::atLeastOnce())
            ->method('setLocale')
            ->with(
                static::callback(
                    static function (LocaleTransfer $localeTransfer) use ($defaultLocaleIsoCode) {
                        return $localeTransfer->getLocaleName() === $defaultLocaleIsoCode;
                    },
                ),
            )->willReturn($this->mailTransferMock);

        static::assertEquals(
            $this->mailTransferMock,
            $this->mailExpander->expand($this->mailTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithoutManipulation(): void
    {
        $defaultLocaleIsoCode = 'en_US';
        $localeName = 'de_DE';
        $availableLocaleIsoCodes = [
            $defaultLocaleIsoCode,
            $localeName,
        ];

        $this->storeReaderMock->expects(static::atLeastOnce())
            ->method('getByMail')
            ->with($this->mailTransferMock)
            ->willReturn($this->storeTransferMock);

        $this->storeTransferMock->expects(static::atLeastOnce())
            ->method('getDefaultLocaleIsoCode')
            ->willReturn($defaultLocaleIsoCode);

        $this->mailTransferMock->expects(static::atLeastOnce())
            ->method('getLocale')
            ->willReturn($this->localeTransferMock);

        $this->storeTransferMock->expects(static::atLeastOnce())
            ->method('getAvailableLocaleIsoCodes')
            ->willReturn($availableLocaleIsoCodes);

        $this->localeTransferMock->expects(static::atLeastOnce())
            ->method('getLocaleName')
            ->willReturn($localeName);

        $this->mailTransferMock->expects(static::never())
            ->method('setLocale');

        static::assertEquals(
            $this->mailTransferMock,
            $this->mailExpander->expand($this->mailTransferMock),
        );
    }
}
