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
            $catName = mysqli_real_escape_string($this->db->link, $catName);

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
    }
?>