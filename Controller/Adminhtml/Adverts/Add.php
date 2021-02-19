<?php
/**
 * Controller action for load admin ui form.
 * @category  Salecto
 * @package   Salecto_Advertisment
 * @author    Salecto
 */
namespace Salecto\Advertisment\Controller\Adminhtml\Adverts;

class Add extends \Magento\Backend\App\Action
{
	/** 
	 * @var \Magento\Framework\View\Result\PageFactory 
	 */
	protected $resultPageFactory;
	
	/**
     * @param Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
	public function __construct(
	     \Magento\Backend\App\Action\Context $context,
	     \Magento\Framework\View\Result\PageFactory $resultPageFactory
	) {
	     $this->resultPageFactory = $resultPageFactory;
	     parent::__construct($context);
	}
	
	/**
	* Page Load Action
	*
	* @return \Magento\Framework\View\Result\Page
	*/
	public function execute()
	{
		$resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Salecto_Advertisment::advertisment');
        $resultPage->getConfig()->getTitle()->prepend(__('Add Advertisment'));
        return $resultPage;
	}
}
