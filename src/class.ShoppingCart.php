<?php 
    class ShoppingCart implements iterator {

        protected $items = array();

        public function __construct() {
           
        }

        public function addToCart($id, $qty) {
            $this->items[$id] = $qty;
        }

        public function getItemCount() {
            return count($this->items);
        }

        /*Iterator methods*/
        public function rewind() {
            reset($this->items);
        }

        public function current() {
            return current($this->items);
        }

        public function key() {
            return key($this->items);
        }

        public function next() {
            return next($this->items);
        }

        public function valid() {
            $key = key($this->items);
            $var = ($key !== NULL && $key !== FALSE);
            return $var;
        }
    }

?>