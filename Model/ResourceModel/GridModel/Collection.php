<?php

/**
 * Admin Grid Collection.
 *
 * @category  Salecto
 * @package   Salecto_Advertisment
 * @author    Salecto
 */
namespace Salecto\Advertisment\Model\ResourceModel\GridModel;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'ad_id';

    /**
     * Define resource model
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'Salecto\Advertisment\Model\GridModel',
            'Salecto\Advertisment\Model\ResourceModel\GridModel'
        );
    }
}
