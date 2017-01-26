<?php
$page_title = "Ethereum Faucet";
$page_description = "";

require_once('header.php');

if (isset($_SESSION["canClaim"]) && $_SESSION["canClaim"] != null && !$_SESSION["canClaim"]["processed"]) :
    $_SESSION["canClaim"]["processed"] = true;
?>
    <div id="rng" data-result="<?php echo $_SESSION["canClaim"]["random"]; ?>"></div>
    <br>
    <div id="rewardInfo">
        <h2>You can claim <?php $h->DisplayCurrency($_SESSION["canClaim"]["amount"]); ?>!</h2>
        <button class="btn btn-lg btn-success" onclick="javascript:window.location='<?php echo $h->conf->canonical_root; ?>';">Claim <?php $h->DisplayCurrency($_SESSION["canClaim"]["amount"]); ?></button>
        <br>
    </div>
    <br>
<?php else: ?>
    <h2>Claim free Ether every <?php echo round($h->conf->interval / 60); ?> minutes</h2>
    <?php if ($h->conf->referral_percentage > 0)
        echo "<h3><a href='#' data-toggle='modal' data-target='#referral'>Link to {$h->conf->short_title}</a> and get an additional {$h->conf->referral_percentage}% of claims made by referred users.</h3>";
    ?>
    <form method="post" action="<?php echo $h->conf->canonical_root; ?>" class="form-group">
        <?php $h->DisplayNotifications(); ?>
        <div id="timer-notification" class="alert alert-info">You can claim more ether in
            <div class="timer" data-seconds-left=<?php echo $h->cookieTimeRemaining; ?>></div>.
        </div>
        <div class="alert alert-success" id="timer-complete-notification">
            You can now claim more ether!
        </div>
        <label>Ethereum Address</label>
        <input type="text" class="form-control" name="ethaddress" value="<?php $h->DisplayKnownAddress(); ?>" placeholder="0x89954b0B7530B877643e4b084496c43cd26CEf7F">
        <br>
        <?php echo $h->conf->under_address_ad; ?>
        <p><?php $h->DisplayCaptcha(); ?></p>
        <?php echo $h->conf->above_claim_button_ad; ?>
        <br>
        <input type="submit" value="Claim ethereum" class="btn btn-success btn-lg">
    </form>
<?php endif; ?>

<?php $h->DisplayPayouts(); ?>

<?php require_once('footer.php'); ?>