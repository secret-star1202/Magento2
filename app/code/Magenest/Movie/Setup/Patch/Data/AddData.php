<?php

namespace Magenest\Movie\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magenest\Movie\Model\BlogFactory;
use Magenest\Movie\Model\ResourceModel\Blog as ResourceModelBlog;
class AddData implements DataPatchInterface, PatchVersionInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private ModuleDataSetupInterface $moduleDataSetup;

    /**
     * @var BlogFactory
     */
    private BlogFactory $blogFactory;
    /**
     * @var resourceModelBlog
     */
    private ResourceModelBlog $resourceModelBlog;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param resourceModelBlog $resourceModelBlog
     * @param BlogFactory $blogFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        ResourceModelBlog $resourceModelBlog,
        BlogFactory $blogFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->blogFactory=$blogFactory;
        $this->resourceModelBlog=$resourceModelBlog;
    }

    /**
     * Apply method is used for apply the data patch
     *
     * @inheritdoc
     */
    public function apply()
    {
        $sampleData = [
            [
                'author_id' => '1',
                'title' => 'Test',
                'description' => 'Test',
                'content' => 'Test',
                'url_rewrite' => 'Test',
                'rating' => '3',
                'status' => '1'
            ],
            [
                'author_id' => '1',
                'title' => 'Test',
                'description' => 'Test',
                'content' => 'Test',
                'url_rewrite' => 'Test',
                'rating' => '3',
                'status' => '1'
            ],
            [
                'author_id' => '1',
                'title' => 'Test',
                'description' => 'Test',
                'content' => 'Test',
                'url_rewrite' => 'Test',
                'rating' => '3',
                'status' => '1'
            ]
        ];
        foreach ($sampleData as $data) {
            $insertData = $this->blogFactory->create()->setData($data);
            $this->resourceModelBlog->save($insertData);
        }
    }

    /**
     * @inheritdoc
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function getAliases(): array
    {
        return [];
    }

    /**
     * @return string
     */
    public static function getVersion(): string
    {
        return " ";
    }
}
