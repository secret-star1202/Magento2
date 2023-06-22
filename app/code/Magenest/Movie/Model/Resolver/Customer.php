<?php
declare(strict_types=1);

namespace Magenest\Movie\Model\Resolver;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\CustomerFactory;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlAuthorizationException;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Query\Resolver\ValueFactory;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\Webapi\ServiceOutputProcessor;

/**
 * Customers field resolver, used for GraphQL request processing.
 */

class Customer implements ResolverInterface
{
    /**
     * @var ValueFactory
     */
    private $valueFactory;

    /**
     * @var CustomerFactory
     */
    private $customerFactory;

    /**
     * @var ServiceOutputProcessor
     */
    private $serviceOutputProcessor;

    /**
     * @var ExtensibleDataObjectConverter
     */
    private $dataObjectConverter;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     *
     * @param ValueFactory $valueFactory
     * @param CustomerFactory $customerFactory
     * @param ServiceOutputProcessor $serviceOutputProcessor
     * @param ExtensibleDataObjectConverter $dataObjectConverter
     */
    public function __construct(
        ValueFactory $valueFactory,
        CustomerFactory $customerFactory,
        ServiceOutputProcessor $serviceOutputProcessor,
        ExtensibleDataObjectConverter $dataObjectConverter,
        CustomerRepositoryInterface $customerRepository,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->valueFactory = $valueFactory;
        $this->customerFactory = $customerFactory;
        $this->serviceOutputProcessor = $serviceOutputProcessor;
        $this->dataObjectConverter = $dataObjectConverter;
        $this->customerRepository = $customerRepository;
        $this->logger = $logger;
    }

    /**
     * @param Field $field
     * @param [type] $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return array
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        if (!isset($args['email'])) {
            throw new GraphQlAuthorizationException(
                __(
                    'email for customer should be specified',
                    [\Magento\Customer\Model\Customer::ENTITY]
                )
            );
        }
        try {
            $data = $this->getCustomerData($args['email']);
            $result = function () use ($data) {
                return !empty($data) ? $data : [];
            };
            return $this->valueFactory->create($result);
        } catch (NoSuchEntityException $exception) {
            throw new GraphQlNoSuchEntityException(__($exception->getMessage()));
        } catch (LocalizedException $exception) {
            throw new GraphQlNoSuchEntityException(__($exception->getMessage()));
        }
    }

    /**
     *
     * @param int $context
     * @return array
     * @throws NoSuchEntityException|LocalizedException
     */
    private function getCustomerData($customerEmail) : array
    {
        try {
            $customerData = [];
            $customerColl = $this->customerFactory->create()->getCollection()->addFieldToFilter('email', ['eq'=>$customerEmail]);
            foreach ($customerColl as $customer) {
                array_push($customerData, $customer->getData());
            }
            return isset($customerData[0]) ? $customerData[0] : [];
        } catch (NoSuchEntityException $e) {
            return [];
        } catch (LocalizedException $e) {
            throw new NoSuchEntityException(__($e->getMessage()));
        }
    }
}
