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

class Paytm_lib{

    var $CI;
    var $paytm_merchant_key;
    var $paytm_environment;
    var $paytm_merchant_mid;
    var $paytm_merchant_websit;
    var $paytm_channel_id;
    var $paytm_status_query_new_url;
    var $paytm_status_query_url;
    var $paytm_txn_url;
    var $paytm_industry_type_id;
    var $paytm_callback_url;
    var $version;
    var $last_error;   // holds the last error encountered
    var $ipn_log;    // bool: log IPN results to text file?
    var $ipn_log_file;   // filename of the IPN log
    var $ipn_response;   // holds the IPN response from paypal	
    var $ipn_data = array(); // array contains the POST values for IPN
    var $fields = array();  // array holds the fields to submit to paypal
    var $submit_btn = '';  // Image/Form button
    var $button_path = 'assets/images/';  // The path of the buttons
    
    
    public function __construct($config = array()) {
        $this->CI =& get_instance();
        $this->CI->load->helper('url');
        $this->CI->load->helper('form');
        $this->CI->load->helper('paytm_helper');

        /*
        - Use PAYTM_ENVIRONMENT as 'PROD' if you wanted to do transaction in production environment else 'TEST' for doing transaction in testing environment.
        - Change the value of PAYTM_MERCHANT_KEY constant with details received from Paytm.
        - Change the value of PAYTM_MERCHANT_MID constant with details received from Paytm.
        - Change the value of PAYTM_MERCHANT_WEBSITE constant with details received from Paytm.
        - Above details will be different for testing and production environment.
        */

        // define('PAYTM_ENVIRONMENT', 'TEST'); // PROD
        // define('PAYTM_MERCHANT_KEY', 'O0zUdI1&G%OQViK_'); //Change this constant's value with Merchant key received from Paytm.
        // define('PAYTM_MERCHANT_MID', 'dZlzzF17647713571019'); //Change this constant's value with MID (Merchant ID) received from Paytm.
        // define('PAYTM_MERCHANT_WEBSITE', 'WEBSTAGING'); //Change this constant's value with Website name received from Paytm.


        //=================================================
        //	For PayTM Settings::
        //=================================================

        //$this->paytm_environment = "PROD";	// For Production /LIVE
        $this->paytm_environment = "TEST";	// For Staging / TEST

        // For LIVE
        if ($this->paytm_environment == 'PROD') {
                //===================================================
                //	For Production or LIVE Credentials
                //===================================================
                $this->paytm_status_query_new_url = 'https://securegw.paytm.in/merchant-status/getTxnStatus';
                $this->paytm_txn_url              = 'https://securegw.paytm.in/theia/processTransaction';


        } else {
                //===================================================
                //	For Staging or TEST Credentials
                //===================================================
                $this->paytm_status_query_new_url = 'https://securegw-stage.paytm.in/merchant-status/getTxnStatus';
                $this->paytm_txn_url              = 'https://securegw-stage.paytm.in/theia/processTransaction';

                //Change this constant's value with Merchant key received from Paytm.
                $this->paytm_merchant_mid     = "jiNFMW09727230311918";
                $this->paytm_merchant_key     = "vQNZxRaA76nYPGLA";
                $this->paytm_channel_id       = "WEB";
                $this->paytm_industry_type_id = "Retail";
                $this->paytm_merchant_websit  = "WEBSTAGING";
                $this->paytm_callback_url     = "http://127.0.0.1/paytmpayment/paytm_response";	
        }
        $this->version     = "v1";
        $this->add_field('MID', $this->paytm_merchant_mid);
        $this->add_field('CHANNEL_ID', $this->paytm_channel_id);     // Return method = POST
        $this->add_field('WEBSITE', $this->paytm_merchant_websit);

        $this->add_field('INDUSTRY_TYPE_ID', 'Retail');
        $this->add_field('VERIFIED_BY', 'EMAIL');
        $this->add_field('IS_USER_VERIFIED', 'YES');
        $this->button('Pay Now!');
    }

    function button($value) {
        // changes the default caption of the submit button
        $this->submit_btn = form_submit('pp_submit', $value);
    }

    function image($file) {
        $this->submit_btn = '<input type="image" name="add" src="' . base_url($this->button_path . '/' . $file) . '" border="0" />';
    }

    function add_field($field, $value) {
        // adds a key=>value pair to the fields array, which is what will be 
        // sent to paypal as POST variables.  If the value is already in the 
        // array, it will be overwritten.
        $this->fields[$field] = $value;
    }

    function paytm_auto_form() {
        // this function actually generates an entire HTML page consisting of
        // a form with hidden elements which is submitted to paypal via the 
        // BODY element's onLoad attribute.  We do this so that you can validate
        // any POST vars from you custom form before submitting to paypal.  So 
        // basically, you'll have your own form which is submitted to your script
        // to validate the data, which in turn calls this function to create
        // another hidden form and submit to paypal.

        $this->button('Click here if you\'re not automatically redirected...');

        echo '<html>' . "\n";
        echo '<head><title>Processing Payment...</title></head>' . "\n";
        echo '<body style="text-align:center;" onLoad="document.forms[\'paytm_auto_form\'].submit();">' . "\n";
        echo '<p style="text-align:center;">Please wait, your order is being processed and you will be redirected to the paytm website.</p>' . "\n";
        echo $this->paytm_form('paytm_auto_form');
        echo '</body></html>';
    }

    function paytm_form($form_name = 'paytm_form') {
        $checkSum   = getChecksumFromArray($this->fields,$this->paytm_merchant_key);
        $str        = '';
        $str        .= '<form method="post" action="' . $this->paytm_txn_url . '" name="' . $form_name . '"/>' . "\n";
        foreach ($this->fields as $name => $value) {
            $str .= form_hidden($name, $value) . "\n";
        }
        $str .= form_hidden('CHECKSUMHASH', $checkSum) . "\n";
        $str .= '<p>' . $this->submit_btn . '</p>';
        $str .= form_close() . "\n";
        return $str;
    }
}

/* End of file Curl.php */
/* Location: ./application/libraries/Curl.php */