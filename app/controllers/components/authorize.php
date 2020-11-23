<?php 
class AuthorizeComponent extends Object{
	var $AuthorizeNetCIM;
	var $AuthorizeNetCustomer;
	
	function __construct() {
		App::import('Vendor', 'authorize/AuthorizeNet', array('file' => 'AuthorizeNet.php'));
		$this->AuthorizeNetCIM = new AuthorizeNetCIM;
		$this->AuthorizeNetCustomer= new AuthorizeNetCustomer;
	}
	
	function createCustomerProfile($customerProfile, $validationMode = "none"){
       return $this->AuthorizeNetCIM->createCustomerProfile($customerProfile, $validationMode);
    }
	function getCustomerProfile($customerProfileId){
		return $this->AuthorizeNetCIM->getCustomerProfile($customerProfileId);
	}
	function updateCustomerProfile($customerProfileId, $customerProfile)
    {
        return $this->AuthorizeNetCIM->updateCustomerProfile($customerProfileId, $customerProfile);
    }
	function deleteCustomerProfile($customerProfileId)
    {
        return $this->AuthorizeNetCIM->deleteCustomerProfile($customerProfileId);
    }
	
	function createCustomerPaymentProfile($customerProfileId, $paymentProfile, $validationMode = "none")
    {
	    return $this->AuthorizeNetCIM->createCustomerPaymentProfile($customerProfileId, $paymentProfile, $validationMode);
    }
	public function getCustomerPaymentProfile($customerProfileId, $customerPaymentProfileId)
    {
        return $this->AuthorizeNetCIM->getCustomerPaymentProfile($customerProfileId, $customerPaymentProfileId);
    }
	function updateCustomerPaymentProfile($customerProfileId, $customerPaymentProfileId, $paymentProfile, $validationMode = "none")
    {
        return $this->AuthorizeNetCIM->updateCustomerPaymentProfile($customerProfileId, $customerPaymentProfileId, $paymentProfile, $validationMode);
    }
	 function deleteCustomerPaymentProfile($customerProfileId, $customerPaymentProfileId)
    {
        return $this->AuthorizeNetCIM->deleteCustomerPaymentProfile($customerProfileId, $customerPaymentProfileId);
    }
	
	
	function createCustomerShippingAddress($customerProfileId, $shippingAddress)
    {
        return $this->AuthorizeNetCIM->createCustomerShippingAddress($customerProfileId, $shippingAddress);
    }
	function getCustomerShippingAddress($customerProfileId, $customerAddressId)
    {
        return $this->AuthorizeNetCIM->getCustomerShippingAddress($customerProfileId, $customerAddressId);
    }
	function updateCustomerShippingAddress($customerProfileId, $customerShippingAddressId, $shippingAddress)
    {
        return $this->AuthorizeNetCIM->updateCustomerShippingAddress($customerProfileId, $customerShippingAddressId, $shippingAddress);
    }
	 function deleteCustomerShippingAddress($customerProfileId, $customerAddressId)
    {
      	return $this->AuthorizeNetCIM->deleteCustomerShippingAddress($customerProfileId, $customerAddressId);  
    }
	
	
	
    function createCustomerProfileTransaction($transactionType, $transaction, $extraOptionsString = "") {
		return $this->AuthorizeNetCIM->createCustomerProfileTransaction($transactionType, $transaction, $extraOptionsString);
    }
	
	
}
?>