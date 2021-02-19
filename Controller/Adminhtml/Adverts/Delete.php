<?php
/**
 * Salecto mass Advert Delete Controller.
 * @category  Salecto
 * @package   Salecto_Advertisment
 * @author    Salecto
 */
namespace Salecto\Advertisment\Controller\Adminhtml\Adverts;
 
use Magento\Backend\App\Action;
use Salecto\Advertisment\Model\GridModel;
use Magento\Framework\Filesystem\Driver\File;
use Magento\Framework\Filesystem;
use Magento\Framework\App\Filesystem\DirectoryList;
 
class Delete extends Action
{
    /**
     * @var \Salecto\Advertisment\Model\GridModel
     */
    protected $_model;

    /**
     * @var \Magento\Framework\Filesystem
     */
    protected $fileSystem;

    /**
     * @var \Magento\Framework\Filesystem\Driver\File
     */
    protected $file;
 
    /**
     * @param Action\Context $context
     * @param \Maxime\Jobs\Model\Department $model
     * @param \Magento\Framework\Filesystem $fileSystem
     * @param \Magento\Framework\Filesystem\Driver\File $file
     */
    public function __construct(
        Action\Context $context,
        GridModel $model,
        Filesystem $fileSystem,
        File $file
    ) {
        $this->fileSystem = $fileSystem;
        $this->file = $file;
        $this->_model = $model;
        parent::__construct($context);
    }
 
    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('ad_id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->_model;
                $model->load($id);
                $this->deleteFile($model->getAdImg());
                $model->delete();
                $this->messageManager->addSuccess(__('Advertisment Deteted'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        $this->messageManager->addError(__('Advertisment does not exist'));
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * Delete image from folder
     * @param string $fileName
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
        return $this->_authorization->isAllowed('Salecto_Advertisment::Advertisment_delete');
    }
}
