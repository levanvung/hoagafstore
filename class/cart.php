<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'../../lib/database.php');
    include_once ($filepath.'../../helper/formats.php');
?>
<?php

    class cart {
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database;
            $this->fm = new Format;
        }
        public function add_to_cart($quantity, $id){
            $quantity = $this->fm->validation($quantity);
            $quantity = mysqli_real_escape_string($this->db->link,$quantity);
            $id = mysqli_real_escape_string($this->db->link,$id);
            $session_id = session_id();

            $query = "SELECT * FROM tbl_product WHERE product_id = '$id'";
            $result = $this->db->select($query)->fetch_assoc();
            $pr_name = $result['product_name'];
            $pr_id = $result['product_id'];
            $pr_price = $result['product_sale'];
            $pr_image = $result['product_image'];

            $query_cart = "INSERT INTO tbl_cart(product_name,product_price,product_id,product_image,ses_id,quantity) VALUES('$pr_name','$pr_price','$pr_id','$pr_image','$session_id','$quantity') LIMIT 1";
            $result_cart = $this->db->insert($query_cart);
            if($result_cart){
                header("Location:checkout.php");
            }else{
                header("Location:404.php");
            }
        }
        public function get_pr_cart(){
            $session_id = session_id();
            $query = "SELECT * FROM tbl_cart WHERE ses_id = '$session_id'";
            $result = $this->db->select($query);
            return $result;
        }
    }
?>