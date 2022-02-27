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

        public function customerRegister($data){
            $name = $data["name"];
            $city = $data["city"];
            $zipcode = $data["zipcode"];
            $address = $data["address"];
            $country = $data["country"];
            $phone = $data["phone"];
            $email = $data["email"];
            $password = md5($data["password"]);
            $chkEmail = $this->emailCheck($email);

            if($name == "" || $city == "" || $zipcode == "" || $address == "" || $country == "" || $phone == "" || $email == "" || $password == ""  ){
                $msg = "<span class='error'>Fiend name must not be empty!</span>";
                return $msg;
            }elseif($chkEmail !=false){
                $msg = "<span class='error'>This Email Already Exits!</span>";
                return $msg;
            }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $msg = "<span class='error'>This Email Not Valid!</span>";
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
        public function customerLogin($data){
            $email    = mysqli_real_escape_string($this->db->link, $data['email']);
            $password = mysqli_real_escape_string($this->db->link, md5($data['password']));

            if(empty($email) || empty($password)){
                $msg = "<span class='error'>Email and Password must not be empty!</span>";
                return $msg;
            }else{
                $query = "SELECT * FROM tbl_customer WHERE email = '$email' AND password = '$password'";
                $result = $this->db->select($query);
                if($result != false){
                    $value = $result->fetch_assoc();
                    Session::set('cusLogin', true);
                    Session::set('cusId', $value['id']);
                    Session::set('cusName', $value['name']);
                    Session::set('cusEmail', $value['email']);
                    header("Location:order.php");
                }else{
                    $msg = "<span class='error'>Email or Password not found!</span>";
                    return $msg;
                }
            }
        }

        public function emailCheck($email){
            $query = "SELECT * FROM tbl_customer WHERE email = '$email'";
            $result = $this->db->select($query);
            if($result){
                return true;
            }else{
                return false;
            }
        }

        public function getCustomerData($id){
            $query = "SELECT * FROM tbl_customer WHERE id = '$id'";
            $result = $this->db->select($query);
            if($result){
                return $result;
            }else{
                return false;
            }
        }

    }
?>