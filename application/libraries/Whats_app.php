<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * @package		Payment Gateway PayTM 
 * @author		Chandan Sharma
 * @copyright	Copyright (c) 2008 - 2011, StackOfCodes.in.
 * @link		http://www.chandansharma.co.in/
 * @since		Version 1.0.0
 * @filesource
 */

// ------------------------------------------------------------------------

class Whats_app {

    var $CI;
    var $authKey        = '64927408354508930501';// TODO: Replace it with your gateway instance ID here
    var $route          = "91";// TODO: Replace it with your Forever Green client ID here
    var $url            = "";// TODO: Replace it with your Forever Green client secret here    

    public function __construct() {
        $this->CI   = &get_instance();
        $this->url  = 'http://justtrp.com/rudra/wsubmitapi.php';
    }

    function sendSMS($postData = array()) {
            $messages = array(
                // Put parameters here such as force or test
//                'test' => true,
                'send_channel' => 'whatsapp',
                'messages' => array(
                    array(
                        'number' => 918866699038,
                        'template' => array(
                            'id' => '475823',
                            'merge_fields' => array(
                                'FirstName' => 'Kishan',
                                'LastName' => 'chavda',
                                'Custom1' => 'abc',
                                'Custom2' => 'abc',
                                'Custom3' => 'abc',
                            )
                        )
                    )
                )
            );
//        $numbers = array(918866699038);
//	$sender = urlencode('TXTLCL');
//	$message = rawurlencode('This is your message');
// 
//	$numbers = implode(',', $numbers);
// 
//        $data = array('apikey' => 'gxyP3oLWiYo-Ncobypry0FYHFL7leEVMuiUCaa1bZK', 'numbers' => $numbers, "sender" => $sender, "message" => $message, "test" => '1');
//    
        // Prepare data for POST request
        $data = array(
            'apikey' => 'gxyP3oLWiYo-Ncobypry0FYHFL7leEVMuiUCaa1bZK',
            'data' => json_encode($messages)
        );
//        p($data);
        // Send the POST request with cURL
        $ch = curl_init('https://api.textlocal.in/bulk_json');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    
        $response = curl_exec($ch);
        curl_close($ch);

        echo $response;
        die;
    }

    function sendSMS2($postData = array()) {
        $return = array();
        if (! empty($postData)) {
            $ch = curl_init();

            curl_setopt_array($ch, array(
                CURLOPT_URL             => $this->url,
                CURLOPT_RETURNTRANSFER  => true,
                CURLOPT_POST            => true,
                CURLOPT_POSTFIELDS      => $postData
                //,CURLOPT_FOLLOWLOCATION => true
            ));

            //Ignore SSL certificate verification
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            //get response

            $output = curl_exec($ch);
            if(curl_errno($ch)) {
                $return["status"] = false;
                $return["error"] = curl_error($ch);
            } else {
                if($output == "Invalid API") {
                    $return["status"]   = false;
                    $return["error"]    = "Invalid API";
                } else {
                    $return["status"] = true;
                }
            }
            curl_close($ch);
        }

        return $return;
    }
}

/* End of file Curl.php */
/* Location: ./application/libraries/Curl.php */