<?php

class Customer {
    protected $customer_id;
    protected $firstname;
    protected $lastname;
    protected $email;
    protected $address;
    protected $city;
    protected $country;
    protected $zip;
    protected $db;
    protected $logo;
    protected $company;
    protected $last4;
    protected $cardBrand;
    protected $cardName;
    protected $stripeId;
    protected $plan;
    protected $favicon;
    
    function __construct($customer_id, $db){
        if(isset($customer_id)){
            $this->customer_id = $customer_id;
            $this->db = $db;
            $this->getCustomer();
        }
    }
    
    private function getCustomer() {
        $sql = file_get_contents(__DIR__.'\sql\getCustomer.sql');
        $params = array(
            'customerid' => $this->customer_id
        );
        $statement = $this->db->prepare($sql);
        $statement->execute($params);
        $customers = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        $customer = $customers[0];
        $this->firstname = $customer['firstname'];
        $this->lastname = $customer['lastname'];
        $this->email = $customer['username'];
        $this->address = $customer['address'];
        $this->city = $customer['city'];
        $this->country = $customer['country'];
        $this->zip = $customer['zip'];
        $this->logo = $customer['logo'];
        $this->company = $customer['company'];
        $this->last4 = $customer['lastfour'];
        $this->cardBrand = $customer['card_brand'];
        $this->cardName = $customer['card_name'];
        $this->stripeId = $customer['stripeid'];
        $this->plan = "Basic";
        $this->favicon = $customer['favicon'];
    }

    function getName() {
        return $this->firstname.' '.$this->lastname;
    }

    function getFirstName() {
        return $this->firstname;
    }

    function getLastName() {
        return $this->lastname;
    }

    function getEmail() {
        return $this->email;
    }

    function getAddress() {
        return $this->address;
    }

    function getCity() {
        return $this->city;
    }

    function getCountry() {
        return $this->country;
    }

    function getZip() {
        return $this->zip;
    }

    function getLogo() {
        return $this->logo;
    }

    function getCompany() {
        return $this->company;
    }

    function getLastFour() {
        return $this->last4;
    }

    function getCardBrand() {
        return $this->cardBrand;
    }

    function getCardName() {
        return $this->cardName;
    }

    function getStripeId() {
        return $this->stripeId;
    }

    function getPlan() {
        return $this->plan;
    }

    function getFavIcon(){
        return $this->favicon;
    }

    function getId() {
        return $this->customer_id;
    }
}