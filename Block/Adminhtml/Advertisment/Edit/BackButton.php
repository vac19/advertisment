<?php
/*
 * Block to fill eliments of Back button for UiForm in backend 
 * @category  Salecto
 * @package   Salecto_Advertisment
 * @author    Salecto
 */
namespace Salecto\Advertisment\Block\Adminhtml\Advertisment\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Catalog\Block\Adminhtml\Category\AbstractCategory;

class BackButton extends GenericButton implements ButtonProviderInterface 
{
    /**
     * Save button
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", 'advertisment/adverts'),
            'class' => 'back',
            'sort_order' => 10
        ];
    }
}
