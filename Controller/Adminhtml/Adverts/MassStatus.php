<?php
/**
 * Salecto mass Advert Delete Controller.
 * @category  Salecto
 * @package   Salecto_Advertisment
 * @author    Salecto
 */
namespace Salecto\Advertisment\Controller\Adminhtml\Adverts;

use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Salecto\Advertisment\Model\ResourceModel\GridModel\CollectionFactory;

class MassStatus extends \Magento\Backend\App\Action
{
    /**
     * Massactions filter.
     * @var Filter
     */
    protected $_filter;

    /**
     * @var CollectionFactory
     */
    protected $_collectionFactory;

    /**
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param \Magento\Framework\Filesystem $fileSystem
     * @param \Magento\Framework\Filesystem\Driver\File $file
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory
    ) {

        $this->_filter = $filter;
        $this->_collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    /**
     * Advertisment mass status changed (active/inactive)
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        ($this->getRequest()->getParam('status')) ? $status = 'Activated' : $status = 'Inactivated';
        $collection = $this->_filter->getCollection($this->_collectionFactory->create());
        $recordActivated = 0;
        foreach ($collection->getItems() as $record) {
            $record->setAdStatus($this->getRequest()->getParam('status'))->save();
            $recordActivated++;
        }
        $this->messageManager->addSuccess(__('A total of %1 advertisment(s) %2.', $recordActivated, $status));

        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/index');
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
