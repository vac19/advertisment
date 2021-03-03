<?php
namespace Salecto\Advertisment\Ui\Component\Listing\Column;


use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\Stdlib\DateTime\DateTime;

class AdCondition extends Column
{   
    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $_DateTime;

    /**
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $DateTime
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param array $components
     * @param array $data
     */
    public function __construct(
        DateTime $DateTime,
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    ) {
        $this->_DateTime = $DateTime;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     *
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        $customColumnName = $this->getData('name');

        if (isset($dataSource['data']['items'])) {
            foreach($dataSource['data']['items'] as &$item) {
                $item[$customColumnName] = $this->getAdCondition($item);
            }    
        }
        return $dataSource;
    }

    /**
     * Conditional function to set key and value in datasource array
     * based on date range if condition.
     *
     * @param array $item
     *
     * @return array key and value.
     */
    public function getAdCondition($item){
        $currentTime = $this->_DateTime->date();
        $adCondition = ((($item['from_date'] <= $currentTime) && ($item['to_date'] >= $currentTime))===false) ? 'Not in date range' : 'In date range';
        return $adCondition;
    }
}
