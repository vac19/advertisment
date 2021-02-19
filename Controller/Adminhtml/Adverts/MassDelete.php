<?php
/**
 * class for mass delete advertisment.
 * @category  Salecto
 * @package   Salecto_Advertisment
 * @author    Salecto
 */
namespace Salecto\Advertisment\Controller\Adminhtml\Adverts;

use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Salecto\Advertisment\Model\ResourceModel\GridModel\CollectionFactory;
use Magento\Framework\Filesystem\Driver\File;
use Magento\Framework\Filesystem;
use Magento\Framework\App\Filesystem\DirectoryList;

class MassDelete extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\Filesystem
     */
    protected $fileSystem;

    /**
     * @var \Magento\Framework\Filesystem\Driver\File
     */
    protected $file;

    /**
     * Massactions filter.
     * @var \Magento\Ui\Component\MassAction\Filter
     */
    protected $_filter;

    /**
     * @var \Salecto\Advertisment\Model\ResourceModel\GridModel\CollectionFactory
     */
    protected $_collectionFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Ui\Component\MassAction\Filter $filter
     * @param \Salecto\Advertisment\Model\ResourceModel\GridModel\CollectionFactory $collectionFactory
     * @param \
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        Filesystem $fileSystem,
        File $file
    ) {

        $this->_filter = $filter;
        $this->_collectionFactory = $collectionFactory;
        $this->fileSystem = $fileSystem;
        $this->file = $file;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $collection = $this->_filter->getCollection($this->_collectionFactory->create());
        $recordDeleted = 0;
        foreach ($collection->getItems() as $record) {
            $this->deleteFile($record->getAdImg());
            $record->delete();
            $recordDeleted++;
        }
        $this->messageManager->addSuccess(__('A total of %1 advertisment(s) activated.', $recordDeleted));

        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/index');
    }

    /**
   * Execute the command
   *
   * @param string $fileName
   * @throws \Exception
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
        return $this->_authorization->isAllowed('Salecto_Advertisment::advertisment_massinactive');
    }
}
