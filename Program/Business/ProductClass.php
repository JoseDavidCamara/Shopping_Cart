<?php
class Product {
    
    public function __construct(
        protected int $id,
        protected string $product_name,
        protected string $description,
        protected float $price,
    ){}


    //getters
        public function getID()
        {
            return $this->id;
        }

        public function getName()
        {
            return $this->product_name;
        }

        public 

    //setters

    //methods
}

?>