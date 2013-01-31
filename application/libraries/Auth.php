<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/**
 * CodeIgniter Auth Class
 *
 * This class is meant to be a lean but secure authentication
 * component for Code Igniter.
 *
 * @package		CodeIgniter
 * @author		Corey Burmeister
 * @subpackage	Libraries
 * @category	Libraries
 * @link		http://www.coreyburmeister.com/ci/auth
 * @copyright  Copyright (c) 2012, Corey Burmeister.
 * @version 0.1.0
 * 
 */
class CI_Auth {
     
  var $CI;   
  private $siteKey;
     
  // constructor
  function CI_Auth() {
    
    session_start();
    
    // copy an instance of CI so we can use the entire framework.
    $this->CI =& get_instance();
  
    // load database class
    $this->CI->load->database();
  
    // set site-wite encryption key
    $this->CI->load->Config('config');
    $this->siteKey = $this->CI->config->item('encryption_key');
    
  }
  
  // generate random string
  private function randomString($length = 50) {
       
    $chars = '0123456789abcdefghijklmnopqrstuvwxyz';
    $string = '';
    $maxrnd = strlen($chars)-1;
    // get random chars
    for($p = 0; $p < $length; $p++) {
      $string .= $chars[mt_rand(0, $maxrnd)];
    }
       
    return $string;
       
  }
  
  // hash value
  protected function hashData($data) {
    return hash_hmac('sha512', $data, $this->siteKey);
  }
  
  // check if user is admin
  public function isAdmin() {
    
    $query = $this->CI->db->get_where('user', array('id' => $_SESSION['user_id']), 1, NULL);
    $row = $query->row_array();
    if($row) {
      return $row['is_admin'];
    }
    
  }
  
  // create a user account
  public function createUser($email, $password, $is_verified = 0, $is_active = 1, $is_admin = 0) {
      
    // check if email already exists in system
    $query = $this->CI->db->get_where('user', array('email' => $email), 1, NULL);
    $row = $query->row_array();
    if(!$row) {
        
      // generate users salt
      $user_salt = $this->randomString();
        
      // salt and hash password
      $password = $user_salt . $password;
      $password = $this->hashData($password);
        
      // create verification code
      $code = $this->randomString();
        
      // get current date and time
      $current_date = date('Y-m-d H:i:s');
         
      // insert new user into database  
      $data = array(
        'email' => $email,
        'password' => $password,
        'user_salt' => $user_salt,
        'is_verified' => $is_verified,
        'is_active' => $is_active,
        'is_admin' => $is_admin,
        'verification_code' => $code,
        'created' => $current_date
      );
      if($this->CI->db->insert('user', $data)) {
        return true;
      }
       
    }
    else {   
      return false;
    }
      
  }
  
  // login user
  public function loginUser($email, $password) {
      
    // select user from database
    $query = $this->CI->db->get_where('user', array('email' => $email), 1, NULL);
    $row = $query->row_array();
    
    if($row) {
      
      // salt and hash password for checking
      $password = $row['user_salt'] . $password;
      $password = $this->hashData($password);
      
      // check if password matches database record
      if($row['password'] == $password) { 
        $match = true; 
      } else {
        $match = false;
      }
  
      // convert to bools
      $is_active = (boolean) $row['is_active'];
      $verified = (boolean) $row['is_verified'];
      
      if($match == true) {
        if($is_active == true) {
          if($verified == true) {
            
            // create token
            $random = $this->randomString();
            $token = $_SERVER['HTTP_USER_AGENT'].$random;
            $token = $this->hashData($token);
              
            // set session
            $_SESSION['token'] = $token;
            $_SESSION['user_id'] = $row['id'];
            
            // delete old logged in record
            $this->CI->db->delete('logged_in_user', array('user_id' => $row['id'])); 
              
            $user_ip = $this->getClientIP();
              
            // insert new logged in record
            $data = array(
              'session_id' => session_id(),
              'user_id' => $row['id'],
              'token' => $token,
              'user_ip' => $user_ip
            );
            
            // successful login          
            if($this->CI->db->insert('logged_in_user', $data)) {
              return 0;
            }
            
            return 3; // something happened
            
          } else return 1; // not verified
        } else return 2; // not active
      } else return 4; // no match
      
    } else return 5; // no user exists
  }

  // get the client ip address
  function getClientIP() {
    
    $ip = '';
      
    if (getenv('HTTP_CLIENT_IP'))
      $ip = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
      $ip = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
      $ip = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
      $ip = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
      $ip = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
      $ip = getenv('REMOTE_ADDR');
    else
      $ip = 'UNKNOWN';
   
    return $ip;
      
  }
  
  // check if session is legit
  public function checkSession() {
    
    if( isset($_SESSION['user_id']) & isset($_SESSION['token']) ) {
      
      // get row from logged in user
      $query = $this->CI->db->get_where('logged_in_user', array('user_id' => $_SESSION['user_id']), 1, NULL);
      $row = $query->row_array();
        
      if($row) {
        
        // check id and token
        if(session_id() == $row['session_id'] && $_SESSION['token'] == $row['token']) {
            
          // id and token both match, nice
          $this->refreshSession();
          return 1; // session valid
            
        }
          
      } 
    }
     
    return 0; // session invalid
      
  }
        
  // refresh session for user
  private function refreshSession() {
      
      // regen session id
      session_regenerate_id();
      
      //Build the token
      $random = $this->randomString();
      $token = $_SERVER['HTTP_USER_AGENT'] . $random;
      $token = $this->hashData($token); 
		
      // store in session
      $_SESSION['token'] = $token;
                                        
      $user_ip = $this->getClientIP();
                                        
      $data = array(
        'session_id' => session_id(),
        'token' => $token,
        'user_ip' => $user_ip
      );

      $this->CI->db->where('user_id', $_SESSION['user_id']);
      $this->CI->db->update('logged_in_user', $data); 
      
    }
    
  // logout user
  public function revokeSession($user_id) {
  
    // delete logged in record
    $this->CI->db->delete('logged_in_user', array('user_id' => $user_id));
    
    // destroy session
    session_destroy();
    
  }      

}

/* End of file Auth.php */