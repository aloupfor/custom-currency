<?php
namespace EcommPro\CustomCurrency\Plugin;

class ConfigPlugin
{
    private $config;

    public function __construct(\EcommPro\CustomCurrency\Model\Config $config)
    {
        $this->config = $config;
    }

    public function afterGetValue(\Magento\Framework\App\Config\ScopeConfigInterface $subject,
        $result,
        $path = null,
        $scope = \Magento\Framework\App\Config\ScopeConfigInterface::SCOPE_TYPE_DEFAULT,
        $scopeCode = null
    )
    {
        if ($path === 'system/currency/installed') {
            return $result . ',' . implode(',', array_values(array_map(function($el) {
                return $el['code'];
            }, $this->config->getCurrencies())));
        }
        return $result;
    }
}
