<?php
/**
 * Model class for ResourceModel
 * @category  Salecto
 * @package   Salecto_Advertisment
 * @author    Salecto
 */
namespace Salecto\Advertisment\Model\ResourceModel;

/**
 * Grid Grid mysql resource.
 */
class GridModel extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * @var string
     */
    protected $_idFieldName = 'ad_id';
    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $_date;

    /**
     * Construct.
     *
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     * @param \Magento\Framework\Stdlib\DateTime\DateTime       $date
     * @param string|null                                       $resourcePrefix
     */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        $resourcePrefix = null
    ) {
        parent::__construct($context, $resourcePrefix);
        $this->_date = $date;
    }

    /**
     * Initialize resource model.
     * @return object
     */
    protected function _construct()
    {
        $this->_init('salecto_advert', 'ad_id');
    }
}
