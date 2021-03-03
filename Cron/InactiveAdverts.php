<?php

namespace Salecto\Advertisment\Cron;

use \Psr\Log\LoggerInterface;
use Salecto\Advertisment\Model\ResourceModel\GridModel\CollectionFactory;
use Magento\Framework\Stdlib\DateTime\DateTime;

class InactiveAdverts
{
	/**
     * @var CollectionFactory
     */
    protected $_collectionFactory;

	 /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $_DateTime;

    /**
     * Constructor
     *
     * @param \Salecto\Advertisment\Model\ResourceModel\GridModel\CollectionFactory $collectionFactory
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $DateTime
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
    	CollectionFactory $collectionFactory,
        LoggerInterface $logger,
        DateTime $DateTime
    )
    {
    	$this->_collectionFactory = $collectionFactory;
        $this->logger = $logger;
        $this->_DateTime = $DateTime;
    }

    /**
     * Retrieve collection of 'advertisments', loop collection condition, item which  * are not within date range and set status to 1 (inactive). 
     * @return null
     */
	public function execute()
	{
		$currentTime = $this->_DateTime->date();
		$collection = $this->_collectionFactory->create();
		foreach ($collection->getItems() as $record) {
			if ((($record->getFromDate() <= $currentTime) && ($record->getToDate() >= $currentTime))===false)
            {
            	$record->setAdStatus(0)->save();
            }
        }
        $this->logger->info('All Status Deactivated');
	}
}
