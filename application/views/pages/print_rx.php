<div style="width:400px;">
    <table width="100%">
        <tr>
            <td align="center"><b style="font-size:18px;">Kidapawan Medical Specialists Center, Inc.</b><br>Brgy. Sudapin, Kidapawan City</td>
        </tr>
    </table>
    <br>
    <table width="100%" style="font-size:16px;" cellpadding="1">
        <tr>
            <td><b>Name:</b> <u><?=$item['firstname'];?> <?=$item['lastname'];?> <?=$item['suffix'];?></u></td>
            <td align="right"><b>Date:</b> <u><?=date('m/d/Y');?></u></td>
        </tr>
        <tr>
            <td colspan="2"><b>Address:</b> <u><?=$item['address'];?></u></td>                        
        </tr>
    </table>
    <hr>
    <h1>Rx</h1>
    <table width="100%" style="font-size:16px;" cellpadding="1">
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
    </table>
    <br>
    <br>
    <hr>
    <br>
    <br>
    <table width="100%" style="font-size:16px;" cellpadding="1">
        <tr>
            <td width="40%">&nbsp;</td>
            <td style="border-bottom:1px solid;" align="center"><?=$item['name'];?>, MD</td>
        </tr>
        <tr>
            <td width="40%">&nbsp;</td>
            <td><b>PTR No.</b> <u><?=$item['ptrno'];?></u></td>
        </tr>
        <tr>
            <td width="40%">&nbsp;</td>
            <td><b>S2 No.</b> <u><?=$item['s2no'];?></u></td>
        </tr>
    </table>
</div>