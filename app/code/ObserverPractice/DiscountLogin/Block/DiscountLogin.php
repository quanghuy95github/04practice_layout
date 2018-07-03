<?php
namespace ObserverPractice\DiscountLogin\Block;
//use OpenCert\Hello\Controller\Index\Index;
class DiscountLogin extends \Magento\Framework\View\Element\Template
{
	protected $productFactory;
	protected $productRepository;

	public function __construct(
	    \Magento\Catalog\Model\ProductFactory $productFactory,
	    \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
		) 
	{
	    $this->productFactory = $productFactory;
	    $this->productRepository = $productRepository;
	}
    public function getHelloWorldTxt()
    {
        return 'Hello world!';

    }

    public function getPriceById($id)
	{
	    //$id = '21'; //Product ID
	    $product = $this->productFactory->create();
	    $productPriceById = $product->load($id)->getPrice();
	    return $productPriceById;
	}

	public function getPriceBySku($sku)
	{   
	    //$sku = 'testing'; //Product sku
	    $product = $this->productFactory->create();
	    $productPriceBySku = $product->loadByAttribute('sku', $sku)->getPrice();
	    return $productPriceBySku;
	}

	public function loadMyProduct($sku)
	{
	    return $this->productRepository->get($sku);
	}

}