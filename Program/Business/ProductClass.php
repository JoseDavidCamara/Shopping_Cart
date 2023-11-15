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

        public function getDescription()
        {
            return $this->description;
        }

        public function getPrice()
        {
            return $this->price;
        }

    //setters

        public function setProductName($productName)
        {
            $this->product_name=$productName;
        }

        public function setDescription($description)
        {
            $this->description =$description;
        }

        public function setPrice($price)
        {
            $this->price=$price;
        }

    //methods
}

?>