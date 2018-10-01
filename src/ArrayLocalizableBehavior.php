<?php

namespace Ypsylon\Propel\Behavior\ArrayLocalizable;

use Propel\Generator\Behavior\I18n\I18nBehavior;
use Propel\Generator\Behavior\Versionable\VersionableBehavior;
use Propel\Generator\Exception\EngineException;
use Propel\Generator\Model\Column;
use Propel\Generator\Model\ForeignKey;
use Propel\Generator\Model\PropelTypes;

class ArrayLocalizableBehavior extends I18nBehavior
{
    public function getObjectBuilderModifier()
    {
        if (null === $this->objectBuilderModifier) {
            $this->objectBuilderModifier = new ArrayLocalizableBehaviorObjectBuilderModifier($this);
        }

        return $this->objectBuilderModifier;
    }

    protected function getAllTableColumnsPhpNames()
    {
        $names = [];
        foreach ($this->getTable()->getColumns() as $column) {
            $names[] = $column->getPhpName();
        }

        foreach ($this->getI18nColumns() as $column) {
            $names[] = $column->getPhpName();
        }

        return $names;
    }

    public function getAllTableColumnsGetters()
    {
        $result = [];
        $names = $this->getAllTableColumnsPhpNames();
        foreach ($names as $name) {
            $result[$name] = 'get' . $name;
        }

        return $result;
    }

    public function getAllTableColumnsSetters()
    {
        $result = [];
        $names = $this->getAllTableColumnsPhpNames();
        foreach ($names as $name) {
            $result[$name] = 'set' . $name;
        }

        return $result;
    }
}