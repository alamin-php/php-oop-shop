<?php
$filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../lib/Database.php");
    include_once ($filepath."/../helpers/Format.php");
    include_once ($filepath."/../classes/Category.php");
    include_once ($filepath."/../classes/Brand.php");

    class Product{
        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function insertProduct($data, $file){
            $productName = mysqli_real_escape_string($this->db->link, $data["productName"]);
            $catId = mysqli_real_escape_string($this->db->link, $data["catId"]);
            $brandId = mysqli_real_escape_string($this->db->link, $data["brandId"]);
            $body = mysqli_real_escape_string($this->db->link, $data["body"]);
            $price = mysqli_real_escape_string($this->db->link, $data["price"]);
            $type = mysqli_real_escape_string($this->db->link, $data["type"]);

            $permited = array("jpg", "jpeg", "png");
            $file_name = $file["image"]["name"];
            $file_size = $file["image"]["size"];
            $file_tmp_name = $file["image"]["tmp_name"];

            $divi = explode(".", $file_name);
            $file_extn = strtolower(end($divi));
            $unique_file_name = substr(md5(time()), 0, 10).'.'.$file_extn;
            $uploaded_file = "upload/".$unique_file_name;

            if($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == ""){
                $msg = "<span class='error'>Field must not be empty !</span>";
                return $msg;
            }elseif($file_size > 1048576){
                $msg = "<span class='error'>Image size must be less then 1 MB !</span>";
                return $msg;
            }elseif(in_array($file_extn, $permited) == false){
                $msg = "<span class='error'>You can upload only:-".implode(", ", $permited)." files !</span>";
                return $msg;
            }else{
                move_uploaded_file($file_tmp_name, $uploaded_file);
                $query = "INSERT INTO tbl_product(
                    productName,
                    catId,
                    brandId,
                    body,
                    price,
                    image,
                    type
                )
                VALUES(
                    '$productName',
                    '$catId',
                    '$brandId',
                    '$body',
                    '$price',
                    '$uploaded_file',
                    '$type'
                )";
                $insert_row = $this->db->insert($query);
                if($insert_row){
                    $msg = "<span class='success'>Product Added Successfylly !</span>";
                    return $msg;
                }else{
                    $msg = "<span class='error'>Product Not Added !</span>";
                    return $msg;
                }
            }
        }

        public function updateProduct($data, $file, $id){
            $productName = mysqli_real_escape_string($this->db->link, $data["productName"]);
            $catId = mysqli_real_escape_string($this->db->link, $data["catId"]);
            $brandId = mysqli_real_escape_string($this->db->link, $data["brandId"]);
            $body = mysqli_real_escape_string($this->db->link, $data["body"]);
            $price = mysqli_real_escape_string($this->db->link, $data["price"]);
            $type = mysqli_real_escape_string($this->db->link, $data["type"]);
            $id = mysqli_real_escape_string($this->db->link, $id);

            $permited = array("jpg", "jpeg", "png");
            $file_name = $file["image"]["name"];
            $file_size = $file["image"]["size"];
            $file_tmp_name = $file["image"]["tmp_name"];

            $divi = explode(".", $file_name);
            $file_extn = strtolower(end($divi));
            $unique_file_name = substr(md5(time()), 0, 10).'.'.$file_extn;
            $uploaded_file = "upload/".$unique_file_name;

            if($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == ""){
                $msg = "<span class='error'>Field must not be empty !</span>";
                return $msg;
            }

            if(!empty($file_name)){
                if($file_size > 1048576){
                    $msg = "<span class='error'>Image size must be less then 1 MB !</span>";
                    return $msg;
                }elseif(in_array($file_extn, $permited) == false){
                    $msg = "<span class='error'>You can upload only:-".implode(", ", $permited)." files !</span>";
                    return $msg;
                }else{
                    move_uploaded_file($file_tmp_name, $uploaded_file);
                    $this->deleteProductImage($id);
                    $query = "UPDATE tbl_product SET
                        productName = '$productName',
                        catId = '$catId',
                        brandId = '$brandId',
                        body = '$body',
                        price = '$price',
                        image = '$uploaded_file',
                        type = '$type'

                    WHERE productId = '$id'";

                    $update_row = $this->db->update($query);
                    if($update_row){
                        $msg = "<span class='success'>Product Updated Successfylly !</span>";
                        return $msg;
                    }else{
                        $msg = "<span class='error'>Product Not Updated !</span>";
                        return $msg;
                    }
                }
            }else{
                $query = "UPDATE tbl_product SET
                    productName = '$productName',
                    catId = '$catId',
                    brandId = '$brandId',
                    body = '$body',
                    price = '$price',
                    type = '$type'

                WHERE productId = '$id'";

                $update_row = $this->db->update($query);
                if($update_row){
                    $msg = "<span class='success'>Product Updated Successfylly !</span>";
                    return $msg;
                }else{
                    $msg = "<span class='error'>Product Not Updated !</span>";
                    return $msg;
                }
            }
        }

        public function getAllProduct(){
            $query = "SELECT
                        tbl_product.*,
                        tbl_category.catName,
                        tbl_brand.brandName
                    FROM
                        tbl_product
                    INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
                    INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
                    ORDER BY
                        tbl_product.productId
                    DESC";
            $result = $this->db->select($query);
            if($result){
                return $result;
            }else{
                return false;
            }
        }

        public function getProductById($id){
            $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
            $result = $this->db->select($query);
            if($result){
                return $result;
            }else{
                return false;
            }
        }

        public function deleteProductById($id){
            $delPdImage = $this->deleteProductImage($id);
            $query = "DELETE FROM tbl_product WHERE productId = '$id'";
            $result = $this->db->delete($query);
            if($result AND $delPdImage){
                return true;
            }else{
                return false;
            }
        }

        public function deleteProductImage($id){
            $query = "SELECT image FROM tbl_product WHERE productId = '$id'";
            $result = $this->db->select($query);
            if($result){
               while($getImage = $result->fetch_assoc()){
                   $delImage = $getImage['image'];
                   if($delImage){
                       unlink($delImage);
                   }
               }
            }else{
                return false;
            }
        }


        // Front view option 
        public function getFeaturedProduct(){
            $query = "SELECT * FROM tbl_product WHERE type = '0' ORDER BY productId DESC LIMIT 4";
            $result = $this->db->select($query);
            if($result){
                return $result;
            }else{
                return false;
            }
        }        
        
        public function getNewProduct(){
            $query = "SELECT * FROM tbl_product WHERE type = '1' ORDER BY productId DESC LIMIT 4";
            $result = $this->db->select($query);
            if($result){
                return $result;
            }else{
                return false;
            }
        }        
        public function getSingleProduct($id){
                    $query = "SELECT p.*, c.catName, b.brandName FROM
                    tbl_product as p, tbl_category as c, tbl_brand as b
                    WHERE p.catId = c.catId AND p.brandId = b.brandId AND p.productId = '$id'";
                $result = $this->db->select($query);
                if($result){
                    return $result;
                }else{
                    return false;
                }
        }

                
        public function latestFromIphone(){
            $query = "SELECT * FROM tbl_product WHERE brandId = '2' ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            if($result){
                return $result;
            }else{
                return false;
            }
        }                   
        public function latestFromISamsung(){
            $query = "SELECT * FROM tbl_product WHERE brandId = '3' ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            if($result){
                return $result;
            }else{
                return false;
            }
        }                   
        public function latestFromAsus(){
            $query = "SELECT * FROM tbl_product WHERE brandId = '6' ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            if($result){
                return $result;
            }else{
                return false;
            }
        }                     
        public function latestFromCannon(){
            $query = "SELECT * FROM tbl_product WHERE brandId = '7' ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            if($result){
                return $result;
            }else{
                return false;
            }
        }                        
        public function getProductByCat($id){
            $query = "SELECT * FROM tbl_product WHERE catId = '$id'";
            $result = $this->db->select($query);
            if($result){
                return $result;
            }else{
                return false;
            }
        }   
    }