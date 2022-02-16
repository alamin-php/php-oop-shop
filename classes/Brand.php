<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath."/../lib/Database.php");
include_once ($filepath."/../helpers/Format.php");

    class Brand{
        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function addBrand($brandName){
            $brandName = $this->fm->validation($brandName);
            $brandName = mysqli_real_escape_string($this->db->link, $brandName);
            $brandName = ucfirst($brandName);

            $nameChk = $this->checkName($brandName);

            if(empty($brandName)){
                $msg = "<span class='error'>Brand name must not be empty!</span>";
                return $msg;
            }elseif($nameChk != false){
                $msg = "<span class='error'>$catName Already Exits !</span>";
                return $msg;
            }else{
                $query = "INSERT INTO tbl_brand(brandName) VALUES ('$brandName')";
                $insert_row = $this->db->insert($query);
                if($insert_row){
                    $msg = "<span class='success'>Brand added successfully</span>";
                    return $msg;
                }else{
                    $msg = "<span class='error'>Brand added fail!</span>";
                    return $msg;
                }
            }

        }
        
        public function checkName($brandName){
            $query = "SELECT * FROM tbl_brand WHERE brandName = '$brandName'";
            $result = $this->db->select($query);
            if($result){
                return true;
            }else{
                return false;
            }
        }

        public function readAllBrand(){
            $query = "SELECT * FROM tbl_brand ORDER BY brandId DESC";
            $result = $this->db->select($query);
            if($result){
                return $result;
            }else{
                return false;
            }
        }

        public function getBrandById($id){
            $query = "SELECT * FROM tbl_brand WHERE brandId = '$id'";
            $result = $this->db->select($query);
            if($result){
                return $result;
            }else{
                return false;
            }
        }

        public function updateBrand($brandName, $id){
            $brandName = $this->fm->validation($brandName);
            $brandName = mysqli_real_escape_string($this->db->link, $brandName);
            $id = mysqli_real_escape_string($this->db->link, $id);

            
            if(empty($brandName)){
                $msg = "<span class='error'>Brand must not be empty !</span>";
                return $msg;
            }else{
                $query = "UPDATE tbl_brand SET brandName = '$brandName' WHERE brandId='$id'";
                $update_row = $this->db->update($query);
                if($update_row){
                    $msg = "<span class='success'>Brand updated successfully</span>";
                    return $msg;
                }else{
                    $msg = "<span class='error'>Brand update fail !</span>";
                    return $msg;
                }
            }
        }

        
        public function delBrandById($id){
            $query = "DELETE FROM tbl_brand WHERE brandId = '$id'";
            $delBrand = $this->db->delete($query);
            if($delBrand){
                $msg = "<span class='success'>Brand deleted successfully</span>";
                    return $msg;
                }else{
                    $msg = "<span class='error'>Brand delete fail !</span>";
                    return $msg;
                }
        }
    }
?>