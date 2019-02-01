<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <body bgcolor="#CCCCCC">
      <table width="600" cellpadding="0" cellspacing="0" border="0" style="margin:0 auto;padding:20px;" bgcolor="#ffffff">
         <tbody>
            <tr>
               <td>
                  <table width="100%" cellpadding="0" cellspacing="0" style="font-family:Arial, Helvetica, sans-serif;font-size:15px;">
                     <tbody>
                        <tr>
                           <td>
                              <?php
                              if($service_logo_url)
                              {
                              ?>
                              <img src="<?=$service_logo_url;?>" alt="" />
                              <?php
                              }
                              ?>
                           </td>
                           <td>
                              <h1 style="font-family:Arial, Helvetica, sans-serif;font-size:24px;font-weight:normal;text-align: right;float:right;">INVOICE</h1>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </td>
            </tr>
            <tr>
               <td>
                  <table width="100%" cellpadding="0" cellspacing="0" style="font-family:Arial, Helvetica, sans-serif;font-size:15px;">
                     <tbody>
                        <tr>
                           <td width="50%">
                              <h4 style="margin:0 0 7px;font-size:16px;"><?=$service_provider_name?></h4>
                              <?php
                              if($service_provider_address)
                              {
                              ?>
                              <p style="margin:0 0 7px;"><?=$service_provider_address;?></p>
                              <?php
                              }
                              ?>
                              <p style="margin:0 0 7px;">Phone : <?=$service_provider_email;?></p>
                              <p style="margin:0 0 7px;">Email : <?=$service_provider_phone;?></p>
                           </td>
                           <td width="50%">
                              <table width="100%" cellpadding="0" cellspacing="0" style="float:right;margin:0 0 20px;">
                                 <tbody>
                                    <tr>
                                       <th style="border: 1px solid #ebebeb;padding:10px;text-align:left;">Invoice No.</th>
                                       <td style="border: 1px solid #ebebeb;padding:10px;"><?=$order_id;?></td>
                                    </tr>
                                    <tr>
                                       <th style="border: 1px solid #ebebeb;padding:10px;text-align:left;">Invoice Date</th>
                                       <td style="border: 1px solid #ebebeb;padding:10px;"><?=$invoice_date;?></td>
                                    </tr>
                                    <tr>
                                       <th style="border: 1px solid #ebebeb;padding:10px;text-align:left;">Payment Terms</th>
                                       <td style="border: 1px solid #ebebeb;padding:10px;"><?=$payment_terms;?></td>
                                    </tr>
                                    <tr>
                                       <th style="border: 1px solid #ebebeb;padding:10px;text-align:left;">Due Date</th>
                                       <td style="border: 1px solid #ebebeb;padding:10px;"><?=$due_date;?></td>
                                    </tr>
                                 </tbody>
                              </table>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </td>
            </tr>
            <tr>
               <td>
                  <table width="100%" cellpadding="0" cellspacing="0" style="font-family:Arial, Helvetica, sans-serif;font-size:15px;">
                     <tbody>
                        <tr>
                           <p style="font-size:20px;">Bill To<br />
                              <?=$client_email;?>
                           </p>
                        </tr>
                        <tr style="background: #ebebeb;padding: 10px 15px;font-weight: 400;">
                           <th width="55%" style="text-align: left;background: #ebebeb;padding: 10px 15px;font-weight: 400;">Description</th>
                           <th width="15%" style="text-align: center;padding: 10px 15px;font-weight: 400;">Quantity</th>
                           <th width="15%" style="text-align: center;padding: 10px 15px;font-weight: 400;">Unit Price</th>
                           <th width="15%" style="text-align: right;padding: 10px 15px;font-weight: 400;">Amount</th>
                        </tr>
                        <tr>
                           <td style="padding: 10px 15px;text-align: left;border-bottom:1px solid #ccc;"><?=$service_name;?></td>
                           <td style="text-align: center;padding: 10px 15px;border-bottom:1px solid #ccc;"><?=$appointemnt_qty;?></td>
                           <td style="text-align: center;padding: 10px 15px;border-bottom:1px solid #ccc;"><?=$currency;?> <?=$unit_price;?></td>
                           <td style="text-align: right;padding: 10px 15px;border-bottom:1px solid #ccc;"><?=$currency;?> <?=$total_price;?></td>
                        </tr>
                     </tbody>
                  </table>
               </td>
            </tr>
            <tr>
               <td>
                  <table width="100%" cellpadding="0" cellspacing="0" style="font-family:Arial, Helvetica, sans-serif;font-size:15px;">
                     <tbody>
                        <tr>
                           <td width="55%" style="text-align: left;padding: 10px 15px;font-weight: 400;"><strong>Note to Receipient(s)</strong><br> <?=$note_to_recepent;?></td>
                           <td width="15%" style="text-align: center;padding: 10px 15px;font-weight: 400;"><strong>Subtotal</strong> <br> Tax (<?=$tax;?>%)</td>
                           <td width="15%" style="text-align: center;padding: 10px 15px;font-weight: 400;"></td>
                           <td width="15%" style="text-align: right;padding: 10px 15px;font-weight: 400;"><?=$currency;?> <?=$total_price;?> <br> <?=$currency;?> <?=$subtotal_tax;?></td>
                        </tr>
                        <tr style="text-align: center;padding: 10px 15px;font-weight: 400;background: #ebebeb;">
                           <th width="55%"></th>
                           <th width="15%" style="text-align: center;padding: 10px 15px;"><strong>Total</strong></th>
                           <th width="15%" style="text-align: right"></th>
                           <th width="15%" style="text-align: right;padding: 10px 15px;"><strong><?=$currency;?> <?=$total_amount;?></strong></th>
                        </tr>
                     </tbody>
                  </table>
               </td>
            </tr>
         </tbody>
      </table>
   </body>
</html>