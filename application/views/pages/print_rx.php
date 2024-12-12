<html>
    <head>
        <title>Print Rx</title>
    </head>
<body>        
<?php
$name="";
$address="";
$ap="";
$ptrno="";
$s2no="";
foreach($items as $item){
    $name=$item['lastname'].", ".$item['firstname']." ".$item['middlename']." ".$item['suffix'];
    $address=$item['address'];
    $ap=$item['name'];
    $ptrno=$item['ptrno'];
    $s2no=$item['s2no'];
}
?>
<div style="width:400px;">
    <table width="100%">
        <tr>
            <td align="center"><b style="font-size:18px;">Kidapawan Medical Specialists Center, Inc.</b><br>Brgy. Sudapin, Kidapawan City</td>
        </tr>
    </table>
    <br>
    <table width="100%" style="font-size:16px;" cellpadding="1">
        <tr>
            <td><b>Name:</b> <u><?=$name;?></u></td>
            <td align="right"><b>Date:</b> <u><?=date('m/d/Y');?></u></td>
        </tr>
        <tr>
            <td colspan="2"><b>Address:</b> <u><?=$address;?></u></td>                        
        </tr>
    </table>
    <hr>
    <h1>Rx</h1>
    <table width="100%" style="font-size:16px;" cellpadding="1">
        <?php
            foreach($items as $item){
                ?>
        <tr>
            <td width="10">&nbsp;</td>
            <td colspan="2"><?=$item['description'];?><td>
            <td align="right">#<?=$item['quantity'];?></td>
        </tr>
        <tr>
            <td width="10">&nbsp;</td>
            <td width="10">&nbsp;</td>
            <td colspan="2"><?=$item['remarks'];?><td>            
        </tr>
        <tr><td colspan="3">&nbsp;</td></tr>
        <?php
            }
            ?>
    </table>
    <br>
    <br>
    <hr>
    <br>
    <br>
    <table width="100%" style="font-size:16px;" cellpadding="1">
        <tr>
            <td width="40%">&nbsp;</td>
            <td style="border-bottom:1px solid;" align="center"><?=$name;?>, MD</td>
        </tr>
        <tr>
            <td width="40%">&nbsp;</td>
            <td><b>PTR No.</b> <u><?=$ptrno;?></u></td>
        </tr>
        <tr>
            <td width="40%">&nbsp;</td>
            <td><b>S2 No.</b> <u><?=$s2no;?></u></td>
        </tr>
    </table>
</div>
        </body>
        </html>