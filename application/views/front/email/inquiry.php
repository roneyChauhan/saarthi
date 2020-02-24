
<html xmlns="http://www.w3.org/1999/xhtml">
    <body>
        <table width="100%" align="center" cellpadding="0" cellspacing="0" style="max-width: 560px; margin: auto; border: 1px solid #CACACA;">
            <tr>
                <td bgcolor="" style="">
                    <table width="100%" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                            <td height="10" bgcolor="#CACACA"></td>
                        </tr>
                        <tr>
                            <td valign="top" bgcolor="" style="padding:20px; ">
                                <table width="100%" cellspacing="0" cellpadding="0" style="">
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td height="25" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;">Hello Admin,</td>
                                    </tr>
                                    <tr>
                                        <td height="25">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td height="25" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;">There is one Booking inquiry form saarthicab.com, Here detail is given below.</td>
                                    </tr>
                                    <tr>
                                        <td height="25">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <table width="100%" cellspacing="0" cellpadding="0" style="max-width: 560px; margin: auto; border: 1px solid #CACACA;">
                                            <tr>
                                                <th height="25" style="border: 1px solid #CACACA; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;">Name</th>
                                                <td height="25" style="border: 1px solid #CACACA; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;"><?php echo isset($username) ? $username : 'abc' ?></td>
                                            </tr>
                                            <tr>
                                                <th height="25" style="border: 1px solid #CACACA; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;">Email</th>
                                                <td height="25" style="border: 1px solid #CACACA; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;"><?php echo isset($email) ? $email : 'abc@gmail.com' ?></td>
                                            </tr>
                                            <tr>
                                                <th height="25" style="border: 1px solid #CACACA; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;">Phone</th>
                                                <td height="25" style="border: 1px solid #CACACA; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;"><?php echo isset($phone) ? $phone : '-' ?></td>
                                            </tr>
                                            <tr>
                                                <th height="25" style="border: 1px solid #CACACA; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;">Subject</th>
                                                <td height="25" style="border: 1px solid #CACACA; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;"><?php echo 'Booking Inquiry' ?></td>
                                            </tr>
                                            <tr>
                                                <th height="25" style="border: 1px solid #CACACA; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;">Message</th>
                                                <td height="25" style="border: 1px solid #CACACA; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;"><?php echo isset($message) ? $message : 'Message' ?></td>
                                            </tr>
                                            <tr>
                                                <th height="25" style="border: 1px solid #CACACA; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;">Journey Type</th>
                                                <td height="25" style="border: 1px solid #CACACA; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;"><?php echo isset($trip_details["journey_type"]) ? $trip_details["journey_type"] : '' ?></td>
                                            </tr>
                                            <tr>
                                                <th height="25" style="border: 1px solid #CACACA; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;">From location </th>
                                                <td height="25" style="border: 1px solid #CACACA; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;"><?php echo isset($trip_details["trip_location_name"]) ? $trip_details["trip_location_name"] : '' ?></td>
                                            </tr>
                                            <tr>
                                                <th height="25" style="border: 1px solid #CACACA; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;">To Location</th>
                                                <td height="25" style="border: 1px solid #CACACA; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;"><?php echo isset($trip_details["drop_location_name"]) ? $trip_details["drop_location_name"] : '' ?></td>
                                            </tr>
                                            <tr>
                                                <th height="25" style="border: 1px solid #CACACA; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;">Pick date</th>
                                                <td height="25" style="border: 1px solid #CACACA; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;"><?php echo isset($trip_details["pick_date"]) ? date("d F, Y", strtotime($trip_details["pick_date"])) : '' ?></td>
                                            </tr>
                                            <tr>
                                                <th height="25" style="border: 1px solid #CACACA; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;">Pick time</th>
                                                <td height="25" style="border: 1px solid #CACACA; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;"><?php echo isset($trip_details["pick_time"]) ? date("h:i A", strtotime($trip_details["pick_time"])) : '' ?></td>
                                            </tr>
                                        </table>
                                    </tr>
                                    <tr>
                                        <td height="25">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td height="25">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td height="25" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;">Thank you,</td>
                                    </tr>
                                    <tr>
                                        <td height="25" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;">Saarthicab</td>
                                    </tr>
                                    <tr>
                                        <td height="25" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;">Website: <a href="<?php echo base_url(); ?>" target="_blank">www.saarthicab.com</a></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td height="10" bgcolor="#CACACA"></td>
                        </tr>
                        <tr>
                            <td height="10"></td>
                        </tr>
                        <tr>
                            <td align="center" bgcolor="" background="" style="padding:10px 0px;">
                                <a href="<?php echo base_url(); ?>" target="_blank">
                                    
                                </a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>