<?php

/**
 * Action controller for save/update advertisment admin Ui form 
 * @category  Salecto
 * @package   Salecto_Advertisment
 * @author    Salecto
 */
namespace Salecto\Advertisment\Controller\Adminhtml\Adverts;
use Magento\Backend\App\Action\Context;
use Salecto\Advertisment\Model\GridModel;
use Salecto\Advertisment\Model\ImageUploader;
use Magento\Framework\Filesystem\Driver\File;
use Magento\Framework\Filesystem;
use Magento\Framework\App\Filesystem\DirectoryList;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \Salecto\Advertisment\Model\GridFactory
     */
    protected $gridFactory;

    /**
     * @var \Salecto\Advertisment\Model\ImageUploader
     */
    protected $imgUpload;

    /**
     * @var \Magento\Framework\Filesystem
     */
    protected $fileSystem;

    /**
     * @var \Magento\Framework\Filesystem\Driver\Filey
     */
    protected $file;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Salecto\Advertisment\Model\GridFactory $gridFactory
     * @param \Salecto\Advertisment\Model\ImageUploader @ImgUpload
     * @param \Magento\Framework\Filesystem $fileSystem
     * @param \Magento\Framework\Filesystem\Driver\File $file
     */
    public function __construct(
        Context $context,
        GridModel $gridFactory,
        ImageUploader $ImgUpload,
        Filesystem $fileSystem,
        File $file
    ) {
        parent::__construct($context);
        $this->gridFactory = $gridFactory;
        $this->imgUpload = $ImgUpload;
        $this->fileSystem = $fileSystem;
        $this->file = $file;
    }

    /**
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * Advertisment save/update
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if (!$data) {
            $this->_redirect('*/*/index');
            $this->messageManager->addSuccess(__('No form Data Found.'));
            return;
        }
        

        if (isset($data['ad_img'][0]['name']) && isset($data['ad_img'][0]['tmp_name'])) {
            $data['ad_img'] = $data['ad_img'][0]['name'];
            $this->imgUpload->moveFileFromTmp($data['ad_img']);
            if(isset($data['ad_id'])){
                $loadImage = $this->gridFactory->load($data['ad_id']);
                $getImage = $loadImage->getAdImg();
                $this->deleteFile($getImage);
            }
        } elseif (isset($data['ad_img'][0]['name']) && !isset($data['ad_img'][0]['tmp_name'])) {
            $data['ad_img'] = $data['ad_img'][0]['name'];
        } else {
            $data['ad_img'] = '';
        }

        $data['ad_pages'] = (!empty($data['ad_pages'])) ? implode(",", $data['ad_pages']) : null;

        try {
            $this->gridFactory->setData($data)->save();
            $this->messageManager->addSuccess(__('Advertisment saved successfully.'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect('*/*/index');
    }

    /**
     * Delete image from folder
     *
     * @return bool
     */
    public function deleteFile($fileName)
    {
        $path = 'salecto/advertisment/';
        $mediaRootDir = $this->fileSystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath().$path;
        try{
            if ($this->file->isExists($mediaRootDir . $fileName)) {
                return $this->file->deleteFile($mediaRootDir . $fileName);
            }
        }catch (\Exception $e) {
            $this->messageManager->addException($e, __('Can\'t delete the file'));
        }
    }

    /**
     * {@inheritdoc}
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Salecto_Advertisment::save');
    }
}
