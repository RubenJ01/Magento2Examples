<?php

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\DataObject;

class Row extends AbstractFieldArray
{
    private ?Column $templateRenderer = null;

    /**
     * Prepare rendering of new table row
     *
     * @throws LocalizedException
     */
    protected function _prepareToRender(): void
    {
        $this->addColumn('example_column_1', [
            'label' => __('Example 1'),
            'class' => 'required-entry',
            'renderer' => ''
        ]);
        $this->addColumn('example_column_2', [
            'label' => __('Example 2'),
            'class' => 'required-entry',
            'renderer' => ''
        ]);
        $this->addColumn('template', [
            'label' => __('Select'),
            'renderer' => $this->getTemplateRenderer()
        ]);

        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add Row');
    }

    /**
     * Prepare additional data attributes for table row
     *
     * @param DataObject $row
     * @throws LocalizedException
     */
    protected function _prepareArrayRow(DataObject $row): void
    {
        $options = [];
        $template = $row->getData('template');

        if ($template !== null) {
            $options['option_' . $this->getTemplateRenderer()->calcOptionHash($template)] = 'selected="selected"';
        }

        $row->setData('option_extra_attrs', $options);
    }


    /**
     * Get the template renderer block
     *
     * @throws LocalizedException
     */
    private function getTemplateRenderer(): Column
    {
        if ($this->templateRenderer === null) {
            $block = $this->getLayout()->createBlock(
                Column::class,
                '',
                ['data' => ['is_render_to_js_template' => true]]
            );

            if (!$block instanceof Column) {
                throw new LocalizedException(__('Cannot create column renderer block.'));
            }

            $this->templateRenderer = $block;
        }

        return $this->templateRenderer;
    }
}
