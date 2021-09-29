<?php
    $filepath = realpath(dirname(__FILE__));
    include_once($filepath.'../../lib/database.php');
    include_once($filepath.'../../helper/formats.php');
    include_once($filepath.'../../lib/session.php');
    Session ::init();
?>
<?php

    class user {
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database;
            $this->fm = new Format;
        }
        public function insert_user($data){

            $cus_name = mysqli_real_escape_string($this->db->link,$data['cus_name']);
            $cus_email = mysqli_real_escape_string($this->db->link,$data['cus_email']); 
            $cus_pass = mysqli_real_escape_string($this->db->link,md5($data['cus_pass']));
            $cus_phone = mysqli_real_escape_string($this->db->link,$data['cus_phone']);
            $cus_address = mysqli_real_escape_string($this->db->link,$data['cus_address']);
            
            $cus_phone = mysqli_real_escape_string($this->db->link,$data['cus_phone']);
            if($cus_name == "" || $cus_email == "" || $cus_pass == "" || $cus_phone == "" || $cus_address == ""){
                $alert = "<span class = 'error'>Bạn phải điền đủ thông tin</span>";
                return $alert;
            }else{
                $check_email = "SELECT * FROM tbl_custumer WHERE cus_email = '$cus_email' LIMIT 1";
                $result_check = $this->db->select($check_email);
                if($result_check){
                    $alert = "<span class = 'error'>Email đã tồn tại</span>";
                    return $alert;
                }else{
                    $query = "INSERT INTO tbl_custumer(cus_name,cus_email,cus_pass,cus_phone,cus_address) VALUES('$cus_name','$cus_email','$cus_pass','$cus_phone','$cus_address') LIMIT 1";
                    $result = $this->db->insert($query);
                    if($result){
                        $alert = "<span class = 'success'>Đăng ký thành công </span>";
                        return $alert;
                    }else{
                        $alert = "<span class = 'success'>Đăng ký thất bại</span>";
                        return $alert;
                    }
                }
            }

        }
        public function login_user($data){
            $cus_email = mysqli_real_escape_string($this->db->link,$data['cus_email']);
            $cus_pass = mysqli_real_escape_string($this->db->link,md5($data['cus_pass']));
            if($cus_email == "" || $cus_pass == ""){
                $alert = "<span class = 'error'>Mời nhập thông tin đăng nhập</span>";
                return $alert;
            }else{
                $check = "SELECT * FROM tbl_custumer WHERE cus_email = '$cus_email' AND cus_pass = '$cus_pass' LIMIT 1";
                $check_result = $this->db->select($check);
                if($check_result!=false){
                    $value= $check_result->fetch_assoc();
                    Session :: set('user_login',true);
                    Session :: set('id',$value['id']);
                    Session :: set('cus_email',$value['cus_email']);
                    Session :: set('cus_pass',$value['cus_pass']);
                    header('Location:checkout.php');
                }else{
                    $alert = "<span class = 'error'>Sai email hoặc password</span>";
                    return $alert;
                }
            }
        }
        public function show_user(){
            $query = "SELECT * FROM tbl_custumer ORDER BY id DESC";
            $result = $this->db->select($query);
            return $result;
        }
        public function get_user($id){
            $query = "SELECT * FROM tbl_custumer WHERE id = $id";
            $result = $this->db->select($query);
            return $result;
        }
        public function update_user($data,$id_user){
            $cus_name = mysqli_real_escape_string($this->db->link,$data['cus_name']);
            $cus_email = mysqli_real_escape_string($this->db->link,$data['cus_email']);
            $cus_address = mysqli_real_escape_string($this->db->link,$data['cus_address']);
            $cus_phone = mysqli_real_escape_string($this->db->link,$data['cus_phone']);
            $id = mysqli_real_escape_string($this->db->link,$id_user);

            if( $cus_name == "" || $cus_email == "" || $cus_address == "" || $cus_phone == ""){
                $alert = "<span class = 'error'>Bạn phải điền đủ các thông tin </span>";
                return $alert;
            }else{
                $query = " UPDATE tbl_custumer SET cus_name = '$cus_name', cus_email = '$cus_email', cus_address = '$cus_address', cus_phone = '$cus_phone' WHERE id = '$id'";
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class = 'success'>Sửa thành công </span>";
                    return $alert;
                }else{
                    $alert = "<span class = 'success'>Sửa thất bại</span>";
                    return $alert;
                }

            }
        }
        public function delete_user($id){
            $query = "DELETE FROM tbl_custumer WHERE id = $id";
            $result = $this->db->DELETE($query);
            if($result){
                $alert = "<span class = 'success'>Xóa thành công </span>";
                return $alert;
            }else{
                $alert = "<span class = 'unsuccess'>Xóa thất bại</span>";
                return $alert;
            }

        }
        public function custommer(){
            
        }
    } 
?>