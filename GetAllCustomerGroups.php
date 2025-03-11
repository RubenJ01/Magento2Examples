<?php

use Magento\Customer\Model\ResourceModel\Group\Collection as CustomerGroupCollection;

class GetAllCustomerGroups
{
    private CustomerGroupCollection $customerGroup;

    public function __construct(CustomerGroupCollection $customerGroupCollection)
    {
        $this->customerGroup = $customerGroupCollection;
    }

    public function getCustomerGroups(): array
    {
        return $this->customerGroup->toOptionArray();
    }
}
