<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Setup\Model\Declaration\Schema\Dto;

/**
 * Constraint structural element
 * Used for creating additional rules on db tables
 */
class Constraint extends GenericElement implements
    ElementInterface,
    TableElementInterface
{
    /**
     * @var Table
     */
    private $table;

    /**
     * @param string $name
     * @param string $elementType
     * @param Table $table
     * @param array $columns
     */
    public function __construct(
        string $name,
        string $elementType,
        Table $table
    ) {
        parent::__construct($name, $elementType);
        $this->table = $table;
    }

    /**
     * Retrieve table name
     *
     * @return Table
     */
    public function getTable()
    {
        return $this->table;
    }
}
