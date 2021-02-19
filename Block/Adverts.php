<?php
/*
 * Block for fetch Advertisment collection.
 * @category  Salecto
 * @package   Salecto_Advertisment
 * @author    Salecto
 */
namespace Salecto\Advertisment\Block;

use Magento\Framework\View\Element\Template\Context;
use Salecto\Advertisment\Model\GridModelFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Stdlib\DateTime\DateTime;

class Adverts extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Salecto\Advertisment\Model\GridModelFactory
     */
    protected $_adverts;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $_DateTime;

    /**
     * Constructor
     *
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Salecto\Advertisment\Model\GridModelFactory $adverts
     * @param \Magento\Catalog\Model\ProductFactory $storeManager
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $DateTime
     */
    public function __construct(
        Context $context,
        GridModelFactory $adverts,
        StoreManagerInterface $storeManager,
        DateTime $DateTime
    ) {
        $this->_adverts = $adverts;
        $this->_storeManager = $storeManager;
        $this->_DateTime = $DateTime;
        parent::__construct($context);
    }

    /**
     * @return void
     */
    public function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('Advertisments'));
        
        return parent::_prepareLayout();
    }

    /**
     * Retrieve collection of 'advertisments', filtered with (from-to date, status and display on pages)
     * @param string $page
     * @return array
     */
    public function getAdverts($page = null)
    {
        $currentTime = $this->_DateTime->date();
        $model = $this->_adverts->create();
        $collection = $model->getCollection();
        $collection->addFieldToFilter('from_date', ['lteq' => $currentTime]);
        $collection->addFieldToFilter('to_date', ['gteq' => $currentTime]);
        $collection->addFieldToFilter('ad_status', 1);
        $collection->addFieldToFilter('ad_pages', array('finset' => $page));
        
        return $collection;
    }

    /**
     * Creates Media Url + custom folder path + imageName.extension
     * @param string $imgName
     * @return string
     */
    public function getMediaUrl($imgName)
    {
        $mediaUrl = $this->_storeManager->getStore()
            ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA).'salecto/advertisment/'.$imgName;
        return $mediaUrl;
    }
}
