<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/Database.php");
include_once ($filepath."/../helpers/Format.php");

    class Customer{
        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function register($data){
            $name = $data["name"];
            $city = $data["city"];
            $zipcode = $data["zipcode"];
            $address = $data["address"];
            $country = $data["country"];
            $phone = $data["phone"];
            $email = $data["email"];
            $password = $data["password"];

            if($name == "" || $city == "" || $zipcode == "" || $address == "" || $country == "" || $phone == "" || $email == "" || $password == ""  ){
                $msg = "<span class='error'>Fiend name must not be empty!</span>";
                return $msg;
            }else{
                $query = "INSERT INTO `tbl_customer`(`name`, `address`, `city`, `country`, `zipcode`, `phone`, `email`, `password`) VALUES ('$name','$address','$city','$country','$zipcode','$phone','$email','$password')";

                $regiseter = $this->db->insert($query);
                if($regiseter){
                    $msg = "<span class='success'>Register Successfully!</span>";
                    return $msg;
                }
            }
        }
        public function login(){
            
        }

    }
?>