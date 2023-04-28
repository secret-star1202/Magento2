<?php

namespace Magenest\Movie\Ui\DataProvider\Product\Form\Modifier;

use Magento\Catalog\Api\Data\ProductAttributeInterface;
use Magento\Catalog\Model\Locator\LocatorInterface;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Eav\Api\AttributeRepositoryInterface;
use Magento\Framework\Stdlib\ArrayManager;

/**
 * Class ScheduleDesignUpdateMetaProvider customizes Schedule Design Update panel
 *
 * @api
 * @since 101.0.0
 */
class PreSellDesignUpdate extends AbstractModifier
{
    /**
     * @var   LocatorInterface
     * @since 101.0.0
     */
    protected $locator;

    /**
     * @var   ArrayManager
     * @since 101.0.0
     */
    protected $arrayManager;

    /**
     * @var AttributeRepositoryInterface
     */
    private $attributeRepository;

    public function __construct(
        LocatorInterface             $locator,
        ArrayManager                 $arrayManager,
        AttributeRepositoryInterface $attributeRepository = null
    ) {
        $this->locator = $locator;
        $this->arrayManager = $arrayManager;
        $this->attributeRepository = $attributeRepository
            ?: \Magento\Framework\App\ObjectManager::getInstance()->get(AttributeRepositoryInterface::class);
    }

    /**
     * @inheritdoc
     *
     * @since 101.0.0
     */
    public function modifyMeta(array $meta)
    {
        return $this->customizeDateRangeField($meta);
    }

    /**
     * @inheritdoc
     *
     * @since 101.0.0
     */
    public function modifyData(array $data)
    {
        $modelId = $this->locator->getProduct()->getId();
        $productStatus = $this->locator->getProduct()->getStatus();
        if (!empty($productStatus) && !empty($modelId)) {
            $data[$modelId][static::DATA_SOURCE_DEFAULT][ProductAttributeInterface::CODE_STATUS] = $productStatus;
        } elseif (!isset($data[$modelId][static::DATA_SOURCE_DEFAULT][ProductAttributeInterface::CODE_STATUS])) {
            $attributeStatus = $this->attributeRepository->get(
                ProductAttributeInterface::ENTITY_TYPE_CODE,
                ProductAttributeInterface::CODE_STATUS
            );
            $data[$modelId][static::DATA_SOURCE_DEFAULT][ProductAttributeInterface::CODE_STATUS] =
                $attributeStatus->getDefaultValue() ?: 1;
        }
        return $data;
    }

    /**
     * Customize date range field if from and to fields belong to one group
     *
     * @param array $meta
     * @return array
     * @since 101.0.0
     */
    protected function customizeDateRangeField(array $meta)
    {
        $fromField = 'start_time';
        $toField = 'end_time';

        $fromFieldPath = $this->arrayManager->findPath($fromField, $meta, null, 'children');
        $toFieldPath = $this->arrayManager->findPath($toField, $meta, null, 'children');

        if ($fromFieldPath && $toFieldPath) {
            $fromContainerPath = $this->arrayManager->slicePath($fromFieldPath, 0, -2);
            $toContainerPath = $this->arrayManager->slicePath($toFieldPath, 0, -2);

            $meta = $this->arrayManager->merge(
                $fromFieldPath . self::META_CONFIG_PATH,
                $meta,
                [
                    'label' => __('Time Start'),
                    'additionalClasses' => 'admin__field-date',
                    'options' => [
                        "minDate" => "-20",
                        "maxDate" => "-16"
                    ]
                ]
            );
            $meta = $this->arrayManager->merge(
                $toFieldPath . self::META_CONFIG_PATH,
                $meta,
                [
                    'label' => __('To'),
                    'scopeLabel' => null,
                    'additionalClasses' => 'admin__field-date',
                    'options' => [
                        "minDate" => "-20",
                        "maxDate" => "-16"
                    ]
//                    'component' => 'Magenest_Movie/js/customDateTime'
                ]
            );
            $meta = $this->arrayManager->merge(
                $fromContainerPath . self::META_CONFIG_PATH,
                $meta,
                [
                    'label' => false,
                    'required' => false,
                    'additionalClasses' => 'admin__control-grouped-date',
                    'breakLine' => false,
                    'component' => 'Magento_Ui/js/form/components/group',
                ]
            );
            $meta = $this->arrayManager->set(
                $fromContainerPath . '/children/' . $toField,
                $meta,
                $this->arrayManager->get($toFieldPath, $meta)
            );

            $meta = $this->arrayManager->remove($toContainerPath, $meta);
        }

        return $meta;
    }
}
