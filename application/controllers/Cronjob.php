<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cronjob extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function daily() {
        //$this->payment_link();
        $this->start_trip_notification();
    }

    public function start_trip_notification() {
        $filter["today"]    = true;
        $booking_data       = $this->booking_model->get_booking_data($filter);
        if (!empty($booking_data)) {
            foreach ($booking_data as $row) {
                if( isset($row->email) && (!filter_var($row->email, FILTER_VALIDATE_EMAIL) === false)){
//                    $to_email   = "inquiry@saarthicab.com";
                    $to_email   = "ca.kishanchavda78@gmail.com";
                    $subject    = 'Trip is today - Saarthicab.com';
                    $headers    = 'MIME-Version: 1.0' . "\r\n";
                    $headers    .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";//        
                    $headers    .= 'From:noreply@saarthicab.com';
//                            $message  = 'This mail is sent using the PHP mail function';
                    $viewData['trip_details']   = $row;
                    $message                    = $this->load->view('front/email/trip_start_nofity', $viewData, true);
                    mail($to_email,$subject,$message,$headers);
                }
            }
        }
    }

}