<?php
namespace OpenTechiz\Blog\Block\Adminhtml\Comment\Edit;

/**
 * Adminhtml blog post edit form
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{

    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Init form
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('post_form');
        $this->setTitle(__('Post Information'));
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        /** @var \OpenTechiz\Blog\Model\Post $model */
        $model = $this->_coreRegistry->registry('blog_comment');
        // var_dump($model->getData());
        // die('vao day roi');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']]
        );

        $form->setHtmlIdPrefix('post_');

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General Information'), 'class' => 'fieldset-wide']
        );

        if ($model->getCommentId()) {
            $fieldset->addField('comment_id', 'hidden', ['name' => 'comment_id']);
        }

        $fieldset->addField(
            'is_active',
            'select',
            [
                'name' => 'is_active', 
                'label' => __('Status'), 
                'title' => __('Status'),
                'required' => true,
                'value' => 1,
                'values' => array(
                    array(
                        'value' => 0,
                        'label' => 'Not Active'
                    ),
                    array(
                        'value' => 1,
                        'label' => 'Actived'
                    )
                )
            ]
        );

        $fieldset->addField(
            'content',
            'text',
            ['name' => 'content', 'label' => __('Comment Content'), 'title' => __('Comment'), 'required' => true]
        );

        $fieldset->addField(
            'email',    
            'text',
            [
                'name' => 'email',
                'label' => __('Email'),
                'title' => __('Email customer'),
                'required' => true,
            ]
        );

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
