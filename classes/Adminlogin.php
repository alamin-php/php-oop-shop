<?php
    include "../lib/Session.php";
    Session::init();
    Session::checkLogin();
    include_once "../lib/Database.php";
    include_once "../helpers/Format.php";

    class Adminlogin{
        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function adminLogin($adminUser, $adminPass){
            $adminUser = $this->fm->validation($adminUser);
            $adminPass = $this->fm->validation($adminPass);

            $userChk = $this->checkUser($adminUser);
            $passChk = $this->checkPass($adminUser, $adminPass);

            $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
            $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

            if(empty($adminUser) || empty($adminPass)){
                $msg = "Username or Password must not be empty !";
                return $msg;               
            }elseif($userChk == false){
                $msg = "Username not Match !";
                return $msg;
            }elseif($passChk == false){
                $msg = "Password not Match !";
                return $msg;
            }else{
                $query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass' LIMIT 1";
                $result = $this->db->select($query);
                if($result !=false){
                    $value = $result->fetch_assoc();
                    Session::set("adminlogin", true);
                    Session::set("adminId",    $value['adminId']);
                    Session::set("adminUser",  $value['adminUser']);
                    Session::set("adminName",  $value['adminName']);
                    Session::set("adminEmail", $value['adminEmail']);
                    header("Location: dashboard.php");
                }
            }
        }

        public function checkUser($adminUser){
            $query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser'";
            $result = $this->db->select($query);
            if($result){
                return true;
            }else{
                return false;
            }
        }
        public function checkPass($adminUser, $adminPass){
            $query = "SELECT adminPass FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass'";
            $result = $this->db->select($query);
            if($result){
                return true;
            }else{
                return false;
            }
        }


    }
?>