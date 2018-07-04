<?php
namespace OpenTechiz\Helloworld\Block;

/**
* 
*/
class Product extends \Magento\Framework\View\Element\Template
{
	protected $_registry;
	protected $_catalogSession;
    protected $_productRepository;
    protected $_productRepositoryInterface;
    private $productFactory;

	public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Catalog\Model\Session $catalogSession,
        \Magento\Catalog\Model\ProductRepository $productRepository,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepositoryInterface,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        array $data = []
    ) {
        $this->_registry = $registry;
        $this->_catalogSession = $catalogSession;
        $this->_productRepository = $productRepository;
        $this->_productRepositoryInterface = $productRepositoryInterface;
        $this->productFactory = $productFactory;
        parent::__construct($context, $data);
   	}

    public function getHelloWorldTxt()
    {
        return 'Hello world!'.$this->_registry->registry('custom_va');

    }

    public function getCatalogSession() 
    {
        return $this->_catalogSession;
    }
    //Load Product by sku using object  manager
    public function getProductById($id) {
        return $this->_productRepository->getById($id);
    }

    public function getProductBySku($sku) {
        return $this->_productRepository->get($sku);
    }

    //Load Product by sku using ProductRepositoryInterface
    public function loadMyProduct($sku)
    {
        return $this->_productRepositoryInterface->get($sku);
    }
    //Load Product by sku using ProductFactory
    public function getBySku($sku)
    {
        $product = $this->productFactory->create();
        return $product->load($product->getIdBySku($sku));
    }
}