<?php

namespace Ypsylon\Propel\Behavior\ArrayLocalizable;

use Propel\Generator\Behavior\I18n\I18nBehaviorObjectBuilderModifier;
use Propel\Generator\Model\Column;
use Propel\Generator\Model\PropelTypes;

class ArrayLocalizableBehaviorObjectBuilderModifier extends I18nBehaviorObjectBuilderModifier
{
    public function objectMethods($builder)
    {
        $script = parent::objectMethods($builder); // TODO: Change the autogenerated stub

        $script .= $this->addFromLocalizedArray();
        $script .= $this->addToLocalizedArray();

        return $script;
    }

    protected function addFromLocalizedArray()
    {
        return $this->behavior->renderTemplate('objectFromLocalizedArray', [
            'setterMethods' => $this->behavior->getAllTableColumnsSetters()
        ]);
    }

    protected function addToLocalizedArray()
    {
        return $this->behavior->renderTemplate('objectToLocalizedArray', [
            'getterMethods' => $this->behavior->getAllTableColumnsGetters(),
        ]);
    }
}