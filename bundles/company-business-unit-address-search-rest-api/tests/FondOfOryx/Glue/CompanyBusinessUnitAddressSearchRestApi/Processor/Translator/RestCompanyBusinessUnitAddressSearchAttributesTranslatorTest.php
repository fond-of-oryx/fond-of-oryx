<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Translator;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Dependency\Client\CompanyBusinessUnitAddressSearchRestApiToGlossaryStorageClientInterface;
use Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchAttributesTransfer;
use Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchSortTransfer;

class RestCompanyBusinessUnitAddressSearchAttributesTranslatorTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Dependency\Client\CompanyBusinessUnitAddressSearchRestApiToGlossaryStorageClientInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $glossaryStorageClientMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCompanyBusinessUnitAddressSearchAttributesTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchSortTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCompanyBusinessUnitAddressSearchSortTransferMock;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Translator\RestCompanyBusinessUnitAddressSearchAttributesTranslator
     */
    protected $restCompanyBusinessUnitAddressSearchAttributesTranslator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->glossaryStorageClientMock = $this->getMockBuilder(CompanyBusinessUnitAddressSearchRestApiToGlossaryStorageClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyBusinessUnitAddressSearchAttributesTransferMock = $this->getMockBuilder(RestCompanyBusinessUnitAddressSearchAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyBusinessUnitAddressSearchSortTransferMock = $this->getMockBuilder(RestCompanyBusinessUnitAddressSearchSortTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyBusinessUnitAddressSearchAttributesTranslator = new RestCompanyBusinessUnitAddressSearchAttributesTranslator(
            $this->glossaryStorageClientMock,
        );
    }

    /**
     * @return void
     */
    public function testTranslate(): void
    {
        $self = $this;

        $locale = 'de_DE';
        $untranslated = [
            'name_asc' => 'companies_rest_api.sort.name_asc',
            'name_desc' => 'companies_rest_api.sort.name_desc',
        ];
        $translated = [
            'name_asc' => 'Name aufsteigend',
            'name_desc' => 'Name absteigend',
        ];

        $this->restCompanyBusinessUnitAddressSearchAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getSort')
            ->willReturn($this->restCompanyBusinessUnitAddressSearchSortTransferMock);

        $this->restCompanyBusinessUnitAddressSearchSortTransferMock->expects(static::atLeastOnce())
            ->method('getSortParamLocalizedNames')
            ->willReturn($untranslated);

        $callCount = $this->atLeastOnce();
        $this->glossaryStorageClientMock->expects($callCount)
            ->method('translate')
            ->willReturnCallback(static function (string $id, string $localeName, array $parameters = []) use ($self, $callCount, $untranslated, $translated, $locale) {
                /** @phpstan-ignore-next-line */
                if (method_exists($callCount, 'getInvocationCount')) {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->getInvocationCount();
                } else {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->numberOfInvocations();
                }

                switch ($count) {
                    case 1:
                        $self->assertSame($untranslated['name_asc'], $id);
                        $self->assertSame($locale, $localeName);

                        return $translated['name_asc'];
                    case 2:
                        $self->assertSame($untranslated['name_desc'], $id);
                        $self->assertSame($locale, $localeName);

                        return $translated['name_desc'];
                }

                throw new Exception('Unexpected call count');
            });

        $this->restCompanyBusinessUnitAddressSearchSortTransferMock->expects(static::atLeastOnce())
            ->method('setSortParamLocalizedNames')
            ->with(
                static::callback(
                    static function (array $sortParamLocalizedNames) use ($translated) {
                        return $sortParamLocalizedNames == $translated;
                    },
                ),
            )->willReturn($this->restCompanyBusinessUnitAddressSearchSortTransferMock);

        static::assertEquals(
            $this->restCompanyBusinessUnitAddressSearchAttributesTransferMock,
            $this->restCompanyBusinessUnitAddressSearchAttributesTranslator->translate(
                $this->restCompanyBusinessUnitAddressSearchAttributesTransferMock,
                $locale,
            ),
        );
    }

    /**
     * @return void
     */
    public function testTranslateWithNullableSort(): void
    {
        $locale = 'de_DE';

        $this->restCompanyBusinessUnitAddressSearchAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getSort')
            ->willReturn(null);

        $this->glossaryStorageClientMock->expects(static::never())
            ->method('translate');

        static::assertEquals(
            $this->restCompanyBusinessUnitAddressSearchAttributesTransferMock,
            $this->restCompanyBusinessUnitAddressSearchAttributesTranslator->translate(
                $this->restCompanyBusinessUnitAddressSearchAttributesTransferMock,
                $locale,
            ),
        );
    }
}
