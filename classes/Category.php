<?php 
    include_once "../lib/Database.php";
    include_once "../helpers/Format.php";

    class Category{
        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function addCategory($catName){
            $catName = $this->fm->validation($catName);
            $catName = mysqli_real_escape_string($this->db->link, ucfirst($catName));

            $nameChk = $this->checkName($catName);

            if(empty($catName)){
                $msg = "<span class='error'>Category must not be empty !</span>";
                return $msg;
            }elseif($nameChk != false){
                $msg = "<span class='error'>$catName Already Exits !</span>";
                return $msg;
            }else{
                $query = "INSERT INTO tbl_category (catName) VALUES ('$catName')";
                $insert_row = $this->db->insert($query);
                if($insert_row){
                    $msg = "<span class='success'>Category added successfully</span>";
                    return $msg;
                }else{
                    $msg = "<span class='error'>Category add fail !</span>";
                    return $msg;
                }
            }
        }

        public function checkName($catName){
            $query = "SELECT * FROM tbl_category WHERE catName = '$catName'";
            $result = $this->db->select($query);
            if($result){
                return true;
            }else{
                return false;
            }
        }
        public function readAllCat(){
            $query = "SELECT * FROM tbl_category ORDER BY catId DESC";
            $result = $this->db->select($query);
            if($result){
                return $result;
            }else{
                return false;
            }
        }
        public function getCatById($id){
            $query = "SELECT * FROM tbl_category WHERE catId = '$id'";
            $result = $this->db->select($query);
            if($result){
                return $result;
            }else{
                return false;
            }
        }

        public function updateCategory($catName, $id){
            $catName = $this->fm->validation($catName);
            $catName = mysqli_real_escape_string($this->db->link, $catName);
            $id = mysqli_real_escape_string($this->db->link, $id);

            
            if(empty($catName)){
                $msg = "<span class='error'>Category must not be empty !</span>";
                return $msg;
            }else{
                $query = "UPDATE tbl_category SET catName = '$catName' WHERE catId='$id'";
                $update_row = $this->db->update($query);
                if($update_row){
                    $msg = "<span class='success'>Category updated successfully</span>";
                    return $msg;
                }else{
                    $msg = "<span class='error'>Category update fail !</span>";
                    return $msg;
                }
            }
        }

        public function delCatById($id){
            $query = "DELETE FROM tbl_category WHERE catId = '$id'";
            $delCat = $this->db->delete($query);
            if($delCat){
                $msg = "<span class='success'>Category deleted successfully</span>";
                    return $msg;
                }else{
                    $msg = "<span class='error'>Category delete fail !</span>";
                    return $msg;
                }
        }
    }
?>