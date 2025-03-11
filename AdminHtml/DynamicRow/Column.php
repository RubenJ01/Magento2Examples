<?php

use Magento\Framework\View\Element\Context;
use Magento\Framework\View\Element\Html\Select;

class Column extends Select
{
    public function _toHtml(): string
    {
        if (!$this->getOptions()) {
            $this->setOptions($this->getSourceOptions());
        }
        return parent::_toHtml();
    }

    private function getSourceOptions(): array
    {
        return [
            ['label' => 'label1', 'value' => 'value1'],
            ['label' => 'label2', 'value' => 'value2'],
        ];
    }
}
