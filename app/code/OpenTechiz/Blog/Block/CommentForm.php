<?php
namespace OpenTechiz\Blog\Block;

class CommentForm extends \Magento\Framework\View\Element\Template
{

    protected $_request;
	/**
     * Construct
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\App\RequestInterface $request,
        array $data = []
    )
    {
        parent::__construct($context, $data);
       }

    public function getPostID()
    {
        return $this->_request->getParam('post_id', false);
    }

    /**
     * Get form action URL for POST booking request
     *
     * @return string
     */
    public function getFormAction()
    {
            // companymodule is given in routes.xml
            // controller_name is folder name inside controller folder
            // action is php file name inside above controller_name folder

        return '/magento2_data/blog/save/index';
        // here controller_name is index, action is booking
    }

    public function getCommentAjaxAction()
    {
        return '/magento2_data/blog/comment/save';
    }

    public function getAjaxUrl()
    {
        return '/magento2_data/blog/comment/load';
    }
}