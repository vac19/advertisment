<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Salecto\Advertisment\Block\Adminhtml\Advertisment\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Catalog\Block\Adminhtml\Category\AbstractCategory;

/**
 * Class SaveButton
 */
//class SaveButton extends AbstractCategory implements ButtonProviderInterface
class SaveButton extends GenericButton implements ButtonProviderInterface 
{
    /**
     * Save button
     *
     * @return array
     */
    public function getButtonData()
    {
        return [];
    }
}
