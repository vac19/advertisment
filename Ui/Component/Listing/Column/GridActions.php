<?php
/**
 * Ui class for add items in action dropdown in admin grid 
 * @category  Salecto
 * @package   Salecto_Advertisment
 * @author    Salecto
 */
namespace Salecto\Advertisment\Ui\Component\Listing\Column;
class GridActions extends \Magento\Ui\Component\Listing\Columns\Column
{
    /**
     * set actions url for items in grid action dropdown 
     */
    const URL_EDIT_PATH = 'advertisment/adverts/add';
    const URL_DELETE_PATH = 'advertisment/adverts/delete';
    const URL_ACTIVE_PATH = 'advertisment/adverts/active';
    const URL_INACTIVE_PATH = 'advertisment/adverts/inactive';

    /*
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlBuilder;
    /**
     * @param \Magento\Framework\UrlInterface                              $urlBuilder
     * @param \Magento\Framework\View\Element\UiComponent\ContextInterface $context
     * @param \Magento\Framework\View\Element\UiComponentFactory           $uiComponentFactory
     * @param array                                                        $components
     * @param array                                                        $data
     */
    public function __construct(
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Built action Urls
     *
     * @param array|int|null $ids
     * @return SourceProviderInterface
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                if (isset($item['ad_id'])) {
                    $item[$this->getData('name')] = [
                        'edit' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_EDIT_PATH,
                                [
                                    'ad_id' => $item['ad_id'
                                    ],
                                ]
                            ),
                            'label' => __('Edit'),
                        ],
                        'delete' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_DELETE_PATH,
                                [
                                    'ad_id' => $item['ad_id'
                                    ],
                                ]
                            ),
                            'label' => __('Delete'),
                        ],
                        'active' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_ACTIVE_PATH,
                                [
                                    'ad_id' => $item['ad_id'
                                    ],
                                ]
                            ),
                            'label' => __('Active'),
                        ],
                        'inactive' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_INACTIVE_PATH,
                                [
                                    'ad_id' => $item['ad_id'
                                    ],
                                ]
                            ),
                            'label' => __('Inactive'),
                        ],
                    ];
                }
            }
        }
        return $dataSource;
    }
}
