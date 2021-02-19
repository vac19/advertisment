<?php

/**
 * Grid Grid Model.
 * @category  Salecto
 * @package   Salecto_Advertisment
 * @author    Salecto
 */
namespace Salecto\Advertisment\Model;

class GridModel extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    const ENTITY_ID = 'ad_id';
    const TITLE = 'title';
    const CONTENT = 'content';
    const PUBLISH_DATE = 'publish_date';
    const IS_ACTIVE = 'is_active';
    const UPDATE_TIME = 'update_time';
    const PAGES = 'ad_pages';
    const CREATED_AT = 'created_at';
    
    /**
     * CMS page cache tag.
     */
    const CACHE_TAG = 'salecto_grid_records';

    /**
     * @var string
     */
    protected $_cacheTag = 'salecto_grid_records';

    /**
     * Prefix of model events names.
     *
     * @var string
     */
    protected $_eventPrefix = 'salecto_grid_records';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('Salecto\Advertisment\Model\ResourceModel\GridModel');
    }
    /**
     * Get EntityId.
     *
     * @return int
     */
    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * Set EntityId.
     *
     * @param int $entityId
     * @return void
     */
    public function setEntityId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    /**
     * Get Title.
     *
     * @return varchar
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * Set Title.
     *
     * @param int $title
     * @return void
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Get getContent.
     *
     * @return varchar
     */
    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * Set Content.
     *
     * @param int $content
     * @return void
     */
    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * Get PublishDate.
     *
     * @return varchar
     */
    public function getPublishDate()
    {
        return $this->getData(self::PUBLISH_DATE);
    }

    /**
     * Set PublishDate.
     *
     * @param int $publishDate
     * @return void
     */
    public function setPublishDate($publishDate)
    {
        return $this->setData(self::PUBLISH_DATE, $publishDate);
    }

    /**
     * Get IsActive.
     *
     * @return bool
     */
    public function getIsActive()
    {
        return $this->getData(self::IS_ACTIVE);
    }

    /**
     * Set IsActive.
     *
     * @param int $isActive
     * @return void
     */
    public function setIsActive($isActive)
    {
        return $this->setData(self::IS_ACTIVE, $isActive);
    }

    /**
     * Get UpdateTime.
     *
     * @return varchar
     */
    public function getUpdateTime()
    {
        return $this->getData(self::UPDATE_TIME);
    }

    /**
     * Set UpdateTime.
     *
     * @param int $updatetime
     * @return void
     */
    public function setUpdateTime($updateTime)
    {
        return $this->setData(self::UPDATE_TIME, $updateTime);
    }

    /**
     * Get CreatedAt.
     *
     * @return varchar
     */
    public function getAdPages()
    {
        return $this->getData(self::PAGES);
    }

    /**
     * Set CreatedAt.
     *
     * @param int $createdAt
     * @return void
     */
    public function setAdPages($createdAt)
    {
        return $this->setData(self::PAGES, $createdAt);
    }


    /**
     * Get CreatedAt.
     *
     * @return varchar
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Set CreatedAt.
     *
     * @param int $createdAt
     * @return void
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }
}
