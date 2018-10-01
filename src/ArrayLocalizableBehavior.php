<?php

namespace Ypsylon\Propel\Behavior\ArrayLocalizable;

use Propel\Generator\Behavior\I18n\I18nBehavior;
use Propel\Generator\Model\Behavior;

class ArrayLocalizableBehavior extends Behavior
{
    public function objectMethods()
    {
        $script = '';
        $script .= $this->addFromLocalizedArray();
        $script .= $this->addToLocalizedArray();

        return $script;
    }


    protected function addFromLocalizedArray()
    {
        return $this->renderTemplate('objectFromLocalizedArray', [
            'setterMethods' => $this->getAllTableColumnsSetters()
        ]);
    }

    protected function addToLocalizedArray()
    {
        return $this->renderTemplate('objectToLocalizedArray', [
            'getterMethods' => $this->getAllTableColumnsGetters(),
        ]);
    }

    protected function getI18nColumns()
    {
        foreach ($this->table->getBehaviors() as $behavior) {
            if ($behavior instanceof I18nBehavior) {
                return $behavior->getI18nColumns();
            }
        }

        return [];
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