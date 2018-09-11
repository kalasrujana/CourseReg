<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pages
 *
 * @author kalas
 */
class Pages extends CI_Controller {
    
    //put your code here
     public function test(){
            $this->load->view('welcome_message');
        }
}
