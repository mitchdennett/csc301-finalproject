<?php 

require_once('../assets/vendor/stripe-php/init.php');

class API extends BaseAPI
{
    protected $User;
    protected $database;

    public function __construct($request, $origin, $database) {
        parent::__construct($request);

        $this->database = $database;

        if (isset($_SESSION["customerID"])) {
            $this->User = new Customer($_SESSION["customerID"], $database);
        } else {
            throw new Exception('Invalid User Token');
        }
    }

    /**
     * Example of an Endpoint
     */
     protected function clients() {
        switch ($this->method) {
            case 'GET':
                $columns = array(
                    array( 'db' => 'name', 'dt' => 0 ),
                    array( 'db' => 'email',  'dt' => 1 ),
                    array( 'db' => 'phone',   'dt' => 2 ),
                    array( 'db' => 'address',     'dt' => 3 ),
                    array( 'db' => 'city',     'dt' => 4 ),
                    array( 'db' => 'clientid',     'dt' => 5 )
                );


                /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
                * If you just want to use the basic configuration for DataTables with PHP
                * server-side, there is no need to edit below this line.
                */
            
                return SSP::simple( $_GET, $this->database, 'clients', 'clientid', $columns );
                break;
            case 'POST':
                return 'SUCCESS';
            case 'PUT':
                return "PUT";
                break;
            case 'DELETE':
                return "DELETE";
                break;
            default:
                throw new Exception('Invalid Method');
        }
     }

     protected function galleries() {
        switch ($this->method) {
            case 'GET':
                return "GET";
                break;
            case 'POST':
                $data = json_decode($_POST['data'], true);
                $params = array(
                    'data' => $data['feature_url'],
                    'gallery' => $data['galleryid']
                );
                $sql = "UPDATE galleries SET feature_url = :data WHERE galleryid = :gallery"; 
                $statement = $this->database->prepare($sql);
                $statement->execute($params);
                return 'SUCCESS';
            case 'PUT':
                return "PUT";
                break;
            case 'DELETE':
                return "DELETE";
                break;
            default:
                throw new Exception('Invalid Method');
        }
     }

     protected function customers() {
        switch ($this->method) {
            case 'GET':
                return "GET";
                break;
            case 'POST':
                $data = json_decode($_POST['data'], true);
                $params = array(
                    'firstname' => $data['firstname'],
                    'lastname' => $data['lastname'],
                    'address' => $data['address'],
                    'city' => $data['city'],
                    'country' => $data['country'],
                    'zip' => $data['zip'],
                    'company' => $data['company'],
                    'customerid' => $this->User->getId()
                );
                $sql = file_get_contents('sql/updateCustomer.sql');
                $statement = $this->database->prepare($sql);
                $statement->execute($params);
                return 'SUCCESS';
            case 'PUT':
                return "PUT";
                break;
            case 'DELETE':
                return "DELETE";
                break;
            default:
                throw new Exception('Invalid Method');
        }
     }

     protected function products() {
        switch ($this->method) {
            case 'GET':
                $sql = file_get_contents('./sql/getProducts.sql');
                $statement = $this->database->prepare($sql);
                $statement->execute();
                $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            
                $products = array();
                $categories = array();
            
                $product_categories = array();
            
                foreach($results as $product){
                    $categories[$product['categoryid']] = $product['description'];
            
                    if(!isset($product_categories[$product['categoryid']])){
            
                        $product_categories[$product['categoryid']] = array(
                            'description' => $product['description'],
                            'categoryid' => $product['categoryid'],
                            'products' => array(
                                $product['productid'] => array(
                                    'productid' => $product['productid'],
                                    'name' => $product['product_description'],
                                    'details' => array(
                                        $product['detailid'] => array(
                                            'description' => $product['detail_description'],
                                            'price' => $product['suggested_price'],
                                            'detailid' => $product['detailid']
                                        )
                                    )
                                )
                            )
                        );
            
                    } else {
            
                        if(!isset($product_categories[$product['categoryid']]['products'][$product['productid']])) {
                            $product_categories[$product['categoryid']]['products'][$product['productid']] = array (
                                'productid' => $product['productid'],
                                'name' => $product['product_description'],
                                'details' => array(
                                    $product['detailid'] => array(
                                        'description' => $product['detail_description'],
                                        'price' => $product['suggested_price'],
                                        'detailid' => $product['detailid']
                                    )
                                )
                            );
                        } else {
                            $product_categories[$product['categoryid']]['products'][$product['productid']]['details'][$product['detailid']] = array(
                                'description' => $product['detail_description'],
                                'price' => $product['suggested_price'],
                                'detailid' => $product['detailid']
                            );
                        }
                    }
                }
                return $product_categories;
                break;
            case 'POST':
                break;
            case 'PUT':
                return "PUT";
                break;
            case 'DELETE':
                return "DELETE";
                break;
            default:
                throw new Exception('Invalid Method');
        }
     }

     protected function productDetails() {
        switch ($this->method) {
            case 'GET':
                $params = array(
                    'productid' => $_GET['productid']
                );
                $sql = file_get_contents('sql/getProductDetail.sql');
                $statement = $this->database->prepare($sql);
                $statement->execute($params);
                return $statement->fetchAll(PDO::FETCH_ASSOC);
            return 'SUCCESS';
                break;
            case 'POST':
                break;
            case 'PUT':
                return "PUT";
                break;
            case 'DELETE':
                return "DELETE";
                break;
            default:
                throw new Exception('Invalid Method');
        }
     }

     protected function cart() {
        switch ($this->method) {
            case 'GET':
                return 'SUCCESS';
                break;
            case 'POST':
                $data = json_decode($_POST['data'], true);
                $cart = &$_SESSION['cart'];

                $cart->addToCart($data['detailid'].'-'.$data['gallery_item'], $data['qty']);
                $response = array(
                    'count' => $cart->getItemCount()
                );
                return $response;
                break;
            case 'PUT':
                return "PUT";
                break;
            case 'DELETE':
                return "DELETE";
                break;
            default:
                throw new Exception('Invalid Method');
        }
     }

     protected function card() {
        switch ($this->method) {
            case 'POST':
                $data = json_decode($_POST['data'], true);
                \Stripe\Stripe::setApiKey("sk_test_4WN9ewgww7Zyw1RXcQAXNK2Y");


                if(!empty($this->User->getStripeId())){
                    $customer = \Stripe\Customer::update($this->User->getStripeId(), [
                        'source' => $data['stripeToken']
                    ]);
                }else{
                    // Create a Customer:
                    $customer = \Stripe\Customer::create([
                        'source' => $data['stripeToken'],
                        'email' => $this->User->getEmail(),
                    ]);
                }

                $lastfour = $customer->sources->data[0]->last4;
                $name = $customer->sources->data[0]->name;
                $brand = $customer->sources->data[0]->brand;

                $params = array(
                    'stripeid' => $customer->id,
                    'lastfour' => $lastfour,
                    'cardbrand' => $brand,
                    'cardname' => $name,
                    'customerid' => $this->User->getId()
                );
                $sql = file_get_contents('sql/updateCustomerStripeId.sql');
                $statement = $this->database->prepare($sql);
                $statement->execute($params);

                

                return array(
                    'lastfour' => $lastfour,
                    'cardbrand' => $brand,
                    'cardname' => $name
                );
            case 'DELETE':
                return "DELETE";
                break;
            default:
                throw new Exception('Invalid Method');
        }
     }
 }

 ?>