<?php
/**
 * Plugin for append custom menu with default class,features and stuffs.
 * @category  Salecto
 * @package   Salecto_Advertisment
 * @author    Salecto
 */
namespace Salecto\Advertisment\Plugin;

use Magento\Framework\Data\Tree\NodeFactory;
use Magento\Framework\UrlInterface;

class AdvertMenu {
    /**
     * @var NodeFactory
     */
    protected $nodeFactory;

    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @param NodeFactory  $nodeFactory
     * @param UrlInterface $urlBuilder
     */
    public function __construct(
        NodeFactory $nodeFactory,
        UrlInterface $urlBuilder
    ) {
        $this->nodeFactory = $nodeFactory;
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * Before GetHtml handler
     *
     * @param object \Magento\Theme\Block\Html\Topmenu $subject 
     * @param string $outermostClass
     * @param string $childrenWrapClass
     * @param int $limit
     */
    public function beforeGetHtml(
        \Magento\Theme\Block\Html\Topmenu $subject,
        $outermostClass = '',
        $childrenWrapClass = '',
        $limit = 0
    ) {
        /**
         * Parent Menu
         */
        $menuNode = $this->nodeFactory->create(
            [
                'data' => $this->getNodeAsArray("Advertisment", "adverts"),
                'idField' => 'id',
                'tree' => $subject->getMenu()->getTree(),
            ]
        );
        /**
         * Add Child Menu
         */
        /*$menuNode->addChild(
            $this->nodeFactory->create(
                [
                    'data' => $this->getNodeAsArray("Sub Menu", "sub-menu"),
                    'idField' => 'id',
                    'tree' => $subject->getMenu()->getTree(),
                ]
            )
        );*/
        $subject->getMenu()->addChild($menuNode);
    }

    /**
     * creates value array for '$menuNode'
     * string $name (menu Text)
     * string $id (menu url)
     * @return array
     */
    protected function getNodeAsArray($name, $id) {
        $url = $this->urlBuilder->getUrl($id);
        return [
            'name' => __($name),
            'id' => $id,
            'url' => $url,
            'has_active' => false,
            'is_active' => false,
        ];
    }
}
