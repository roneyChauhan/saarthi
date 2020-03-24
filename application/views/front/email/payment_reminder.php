
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
                                        <td height="25" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;">Hello ,</td>
                                    </tr>
                                    <tr>
                                        <td height="25">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td height="25" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;">Payment reminder for your trip form saarthicab.com.</td>
                                    </tr>
                                    <tr>
                                        <td height="25">&nbsp;</td>
                                    </tr>
                                    <?php if(isset($message) && ($message != "") ) { ?>
                                        <tr>
                                            <td height="25" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;"><?php echo $message; ?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td height="25">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <table width="100%" cellspacing="0" cellpadding="0" style="max-width: 560px; margin: auto; border: 1px solid #CACACA;">
                                            <tr>
                                                <th height="25" style="border: 1px solid #CACACA; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;">Journey Type</th>
                                                <td height="25" style="border: 1px solid #CACACA; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;"><?php echo (isset($trip_details->service_type) && ($trip_details->service_type == 1) ) ? "Two Way" : 'One Way' ?></td>
                                            </tr>
                                            <tr>
                                                <th height="25" style="border: 1px solid #CACACA; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;">From location </th>
                                                <td height="25" style="border: 1px solid #CACACA; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;"><?php echo ( isset($trip_details->pick_city) && isset($trip_details->pick_state)) ? $trip_details->pick_city . '-' . $trip_details->pick_state : '' ?></td>
                                            </tr>
                                            <tr>
                                                <th height="25" style="border: 1px solid #CACACA; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;">To Location</th>
                                                <td height="25" style="border: 1px solid #CACACA; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;"><?php echo ( isset($trip_details->drop_city) && isset($trip_details->drop_state)) ? $trip_details->drop_city . '-' . $trip_details->drop_state : '' ?></td>
                                            </tr>
                                            <tr>
                                                <th height="25" style="border: 1px solid #CACACA; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;">Pick date</th>
                                                <td height="25" style="border: 1px solid #CACACA; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;"><?php echo isset($trip_details->pickup_date) ? date("d F, Y", strtotime($trip_details->pickup_date)) : '' ?></td>
                                            </tr>
                                            <tr>
                                                <th height="25" style="border: 1px solid #CACACA; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;">Pick time</th>
                                                <td height="25" style="border: 1px solid #CACACA; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;"><?php echo isset($trip_details->pickup_time) ? date("h:i A", strtotime($trip_details->pickup_time)) : '' ?></td>
                                            </tr>
                                            <tr>
                                                <th height="25" style="border: 1px solid #CACACA; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;">Total Amount</th>
                                                <td height="25" style="border: 1px solid #CACACA; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;"><?php echo isset($trip_details->total_amount) ? showPrice($trip_details->total_amount) : '' ?></td>
                                            </tr>
                                            <tr>
                                                <th height="25" style="border: 1px solid #CACACA; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;">Payment Status</th>
                                                <td height="25" style="border: 1px solid #CACACA; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;"><?php echo (isset($trip_details->method) && ($trip_details->method == 1)) ? "Partially Paid" : 'Paid' ?></td>
                                            </tr>
                                            <?php if(isset($trip_details->method) && ($trip_details->method == 1) ) { ?>
                                                <tr>
                                                    <th height="25" style="border: 1px solid #CACACA; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;">Pending Amount</th>
                                                    <td height="25" style="border: 1px solid #CACACA; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;"><?php echo showPrice($trip_details->total_amount - ($trip_details->total_amount / 2)); ?></td>
                                                </tr>
                                            <?php } ?>
                                        </table>
                                    </tr>
                                    <tr>
                                        <td height="25">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td height="25" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; padding-left:10px;">Please click below link to payment.</td>
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