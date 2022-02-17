<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/Database.php");
include_once ($filepath."/../helpers/Format.php");

    class Cart{
        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function addToCart($quantity, $id){
            $quantity = $this->fm->validation($quantity);
            $quantity = mysqli_real_escape_string($this->db->link, $quantity);
            $productId       = mysqli_real_escape_string($this->db->link, $id);
            $sId      = session_id();

            $squery  = "SELECT * FROM tbl_product WHERE productId = '$id'";
            $result = $this->db->select($squery)->fetch_assoc();

            $productName = $result["productName"];
            $price       = $result["price"];
            $image       = $result["image"];

            $chquery  = "SELECT * FROM tbl_cart WHERE productId = '$productId' AND sId ='$sId'";
            $getPro = $this->db->select($chquery);
            if($getPro){
                $msg = "<span class='error'>Product Already Added !</span>";
                return $msg;
            }else{
                $query = "INSERT INTO tbl_cart(
                    sId,
                    productId,
                    productName,
                    price,
                    image,
                    quantity
                )
                VALUES(
                    '$sId',
                    '$productId',
                    '$productName',
                    '$price',
                    '$image',
                    '$quantity'
                )";
                $insert_row = $this->db->insert($query);
                if($insert_row){
                   header("Location:cart.php");
                }else{
                    $msg = "<span class='error'>Product not added into the cart !</span>";
                    return $msg;
                }
            }

        }

        public function getCartProduct(){
            $sId      = session_id();

            $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
            $result = $this->db->select($query);
            if($result){
                return $result;
            }else{
                return false;
            }
        }

        public function updateCart($quantity, $cartId){
            $cartId       = mysqli_real_escape_string($this->db->link, $cartId);
            $quantity     = mysqli_real_escape_string($this->db->link, $quantity);
            $query = "update tbl_cart set quantity='$quantity' where cartId='$cartId'";
            $update_row = $this->db->update($query);
            if($update_row){
                header("Location:cart.php");
            }else{
                $msg = "<span class='error'>Quantity not updated.</span>";
                return $msg;
            }
        }

        public function delProductByCart($delId){
            $delId       = mysqli_real_escape_string($this->db->link, $delId);
            $query = "DELETE FROM tbl_cart WHERE cartId='$delId'";
            $delData = $this->db->delete($query);
            if($delData){
                echo "<script>window.location= 'cart.php' </script>";
            }else{
                $msg = "<span class='error'>Product Not delete !</span>";
                return $msg;
            }

        }

        public function checkCartTable(){
            $sId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sId='$sId'";
            $result = $this->db->select($query);
            return $result;
        }


    }
?>