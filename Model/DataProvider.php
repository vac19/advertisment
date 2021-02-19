<?php

/**
 * Ui Form DataProvider Model.
 * @category  Salecto
 * @package   Salecto_Advertisment
 * @author    Salecto
 */

namespace Salecto\Advertisment\Model;
 
use Salecto\Advertisment\Model\ResourceModel\GridModel\CollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Downloadable\Helper\File;
 
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface Object 
     */
    protected $_storeManager;

    /**
     * @var \Magento\Downloadable\Helper\File Object 
     */
    protected $_file;

    /**
     * constructer
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param object \Salecto\Advertisment\Model\ResourceModel\GridModel\CollectionFactory $formCollectionFactory
     * @param object \Magento\Store\Model\StoreManagerInterface $requestFieldName
     * @param object \Magento\Downloadable\Helper\File $file
     * @param array $data
     * @param array $meta
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $formCollectionFactory,
        array $meta = [],
        array $data = [],
        StoreManagerInterface $storeManager,
        File $file
    ) {
        $this->collection = $formCollectionFactory->create();
        $this->_file = $file;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->_storeManager = $storeManager;
    }
 
    /**
     * Creates data for for admin ui form (including image data [name,url,size])
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $advert) {
            $fileName = 'salecto/advertisment/'.$advert->getData("ad_img");
            $fileSize =  $this->_file->getFileSize($fileName);
            if ($advert->getData("ad_img") !== '') {
                $image = [];
                $image[0]['name'] = $advert->getData("ad_img");
                $image[0]['url'] = $this->getMediaUrl($image[0]['name']);
                $image[0]['size'] = $fileSize;
                $advert->setData("ad_img",$image);
            }
            $this->loadedData[$advert->getId()] = $advert->getData();
        }
        return $this->loadedData;
    }

    /**
     * creates media url along with advertisment image name and folder path.
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
