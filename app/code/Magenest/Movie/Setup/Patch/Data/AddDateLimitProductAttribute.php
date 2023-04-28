<?php

namespace Magenest\Movie\Setup\Patch\Data;

use Magento\Catalog\Model\Attribute\Backend\Startdate;
use Magento\Catalog\Setup\CategorySetup;
use Magento\Catalog\Setup\CategorySetupFactory;
use Magento\Eav\Model\Entity\Attribute\Backend\Datetime;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Model\Entity\Attribute\SetFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;

class AddDateLimitProductAttribute implements DataPatchInterface, PatchRevertableInterface
{
    private $moduleDataSetup;

    /**
     * @var CategorySetupFactory
     */
    private $categorySetupFactory;

    /**
     * @var SetFactory
     */
    private $attributeSetFactory;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param CategorySetupFactory $categorySetupFactory
     * @param SetFactory $attributeSetFactory
     *
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        CategorySetupFactory     $categorySetupFactory,
        SetFactory               $attributeSetFactory
    )
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->categorySetupFactory = $categorySetupFactory;
        $this->attributeSetFactory = $attributeSetFactory;
    }

    /**
     * @throws \Zend_Validate_Exception
     * @throws LocalizedException
     */
    public function apply()
    {
        /** @var CategorySetup $categorySetup */
        $categorySetup = $this->categorySetupFactory->create(['setup' => $this->moduleDataSetup]);
        $categorySetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'start_time',
            [
                'type' => 'datetime',
                'label' => 'Date Start',
                'input' => 'datetime',
                'frontend' => 'Magento\Eav\Model\Entity\Attribute\Frontend\Datetime',
                'class' => 'validate-date validate-date-range date-range-from',
                'backend' => Startdate::class,
                'visible' => true,
                'required' => false,
                'sort_order' => 7,
                'global' => ScopedAttributeInterface::SCOPE_WEBSITE,
                'used_in_product_listing' => true,
                'is_used_in_grid' => true,
                'is_visible_in_grid' => false,
                'is_filterable_in_grid' => false,
                'user_defined' => false,
                'default' => '',
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => false,
                'unique' => false,
            ],
        );
        $categorySetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'end_time',
            [
                'type' => 'datetime',
                'label' => 'To',
                'input' => 'datetime',
                'frontend' => 'Magento\Eav\Model\Entity\Attribute\Frontend\Datetime',
                'class' => 'validate-date validate-date-range date-range-from',
                'backend' => Datetime::class,
                'visible' => true,
                'required' => false,
                'sort_order' => 7,
                'global' => ScopedAttributeInterface::SCOPE_WEBSITE,
                'used_in_product_listing' => true,
                'is_used_in_grid' => true,
                'is_visible_in_grid' => false,
                'is_filterable_in_grid' => false,
                'user_defined' => false,
                'default' => '',
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => false,
                'unique' => false,
            ]
        );
        return $this;
    }

    public static function getDependencies()
    {
        return [

        ];
    }

    public static function getVersion()
    {
        return '2.0.4';
    }

    /**
     * @inheritdoc
     */
    public function getAliases()
    {
        return [];
    }

    public function revert()
    {
        // TODO: Implement revert() method.
    }
}
