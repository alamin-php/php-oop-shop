<?php 
    include_once "../lib/Database.php";
    include_once "../helpers/Format.php";
    include_once "../classes/Category.php";
    include_once "../classes/Brand.php";

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
    }