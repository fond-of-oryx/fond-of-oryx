<?php
namespace FondOfOryx\Zed\LowercaseBehavior\Persistence\Propel\Behavior;

use FondOfOryx\Zed\LowercaseBehavior\Persistence\Propel\Behavior\Exception\ColumnNotFoundException;
use Propel\Generator\Model\Behavior;

class LowercaseBehavior extends Behavior
{
    /**
     * @var string
     */
    protected const KEY_PARAMETER_LOWERCASE_COLUMN = 'lowercase_columns';

    /**
     * @var string
     */
    protected const ERROR_COLUMN_NOT_FOUND = 'Column %s does not exist in table %s.';

    /**
     * @return string
     */
    public function objectMethods(): string
    {
        return $this->addColumnValuesToLowercase();
    }

    /**
     * @return string
     */
    public function preSave(): string
    {
        return "
        \$this->columnValuesToLowercase();
        ";
    }

    /**
     * @throws \FondOfOryx\Zed\LowercaseBehavior\Persistence\Propel\Behavior\Exception\ColumnNotFoundException
     *
     * @return string
     */
    protected function addColumnValuesToLowercase(): string
    {
        $body = '';
        $parameters = $this->getParameters();

        if (!isset($parameters[static::KEY_PARAMETER_LOWERCASE_COLUMN])) {
            return $this->generateColumnValuesToLowercaseByBody($body);
        }

        $lowercaseColumns = explode(',', $parameters[static::KEY_PARAMETER_LOWERCASE_COLUMN]);

        foreach ($lowercaseColumns as $index => $lowercaseColumn) {
            if (!$this->getTable()->hasColumn($lowercaseColumn)) {
                throw new ColumnNotFoundException(sprintf(
                    static::ERROR_COLUMN_NOT_FOUND,
                    $lowercaseColumn,
                    $this->getTable()->getName(),
                ));
            }

            $pascalCaseColumn = str_replace(' ', '', ucwords(str_replace('_', ' ', $lowercaseColumn)));
            $getterMethodName = sprintf('get%s', $pascalCaseColumn);
            $setterMethodName = sprintf('set%s', $pascalCaseColumn);

            if ($index > 0) {
                $body .= '';
            }

            $body .= "\$this->$setterMethodName(strtolower(\$this->$getterMethodName()));";
        }

        return $this->generateColumnValuesToLowercaseByBody($body);
    }

    /**
     * @param string $body
     *
     * @return string
     */
    protected function generateColumnValuesToLowercaseByBody(string $body = ''): string
    {
        return "
/**
 * @return void
 */
protected function columnValuesToLowercase()
{
    $body
}
        ";
    }
}
