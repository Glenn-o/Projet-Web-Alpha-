<?php
$title = "Liste Factures";
$css = "adminSpace.css";
ob_start() 
?>
<section id="main">
<?php
while ($bill = $reqBills->fetch(PDO::FETCH_ASSOC))
{
?>
    <div class="div_bill">
        <div id="div_info_bill">
            <p class="lastName_bill"><?= $bill["bill_date"] ?></p>
            <p class="firstName_bill"><?= $bill["prod_name"] ?></p>
            <p class="billname_bill"><?= $bill["prod_price"] ?> </p>
            <p class="lastName_bill"><?= $bill["buy_lastname"] ?></p>
            <p class="firstName_bill"><?= $bill["buy_firstname"] ?></p>
            <p class="billname_bill"><?= $bill["buy_adress"] ?> </p>
            <p class="lastName_bill"><?= $bill["sell_lastname"] ?></p>
            <p class="firstName_bill"><?= $bill["sell_firstname"] ?></p>
            <p class="billname_bill"><?= $bill["sell_adress"] ?> </p>
        </div>
    </div>
<?php
}
$reqBills->closeCursor();
?>
</section>
<?php 
$content = ob_get_clean();
require "template.php";
?>
