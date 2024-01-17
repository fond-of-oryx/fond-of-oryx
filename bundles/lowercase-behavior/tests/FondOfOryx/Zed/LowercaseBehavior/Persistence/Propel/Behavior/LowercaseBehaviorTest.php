<?php

namespace FondOfOryx\Zed\LowercaseBehavior\Persistence\Propel\Behavior;

use Codeception\Test\Unit;
use Propel\Generator\Util\QuickBuilder as PropelQuickBuilder;
use TestLowercaseBehavior;

class LowercaseBehaviorTest extends Unit
{
    /**
     * @return void
     */
    public function testGenerateColumnValuesToLowercaseByBody(): void
    {
        // Arrange
        $this->buildPropelEntities();

        // Act
        $testEntity = new TestLowercaseBehavior();
        $testEntity->setEmail('Max@Mustermann.de');
        $testEntity->save();

        // Assert
        $this->assertSame($testEntity->getEmail(), 'max@mustermann.de');
    }

    /**
     * @uses TestLowercaseBehavior
     *
     * @return void
     */
    protected function buildPropelEntities(): void
    {
        if (class_exists('TestLowercaseBehavior')) {
            return;
        }

        $schema = '
            <database name="test_lowercase_behavior" defaultIdMethod="native">
                <table name="test_lowercase_behavior">
                    <column name="email" required="true" size="255" type="VARCHAR"/>
                    <behavior name="lowercase">
                        <parameter name="lowercase_columns" value="email"/>
                    </behavior>
                </table>
            </database>';

        PropelQuickBuilder::buildSchema($schema);
    }
}
