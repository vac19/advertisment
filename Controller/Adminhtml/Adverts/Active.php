<?php
/**
 * action controller for change status to active
 * @category  Salecto
 * @package   Salecto_Advertisment
 * @author    Salecto
 */
namespace Salecto\Advertisment\Controller\Adminhtml\Adverts;
 
use Magento\Backend\App\Action;
use Salecto\Advertisment\Model\GridModel;
 
class Active extends Action
{
    /**
     * @var \Salecto\Advertisment\Model\GridModel
     */
    protected $_model;
 
    /**
     * @param Action\Context $context
     * @param \Salecto\Advertisment\Model\GridModel $model
     */
    public function __construct(
        Action\Context $context,
        GridModel $model
    ) {
        parent::__construct($context);
        $this->_model = $model;
    }
 
    /**
     * status active action
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
                $model->setAdStatus(1)->save();
                $this->messageManager->addSuccess(__('Advertisment %1 Activated', $model->getTitle()));
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
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Salecto_Advertisment::Advertisment_delete');
    }
}
