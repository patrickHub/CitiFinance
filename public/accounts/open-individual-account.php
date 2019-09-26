<?php require_once('../../private/initialize.php'); ?>

<?php
    $step = $_GET['step'] ?? 1;
?>


<!-- header -->
<?php echo $step;  include_once(SHARED_PATH . '/public_header.php');?>
<main>

    <!-- Title -->
    <section class="open-account-title">
        <h1>Openning Individual account</h1>
        <div class="step">
            <a href="#" style="<?php echo in_array($step, [1,2,3,4]) ? 'border-bottom-color: #eb1f1b;' : ''; ?>"><p>1 - Introduction</p> <span>1</span></a>
            <a href="#" style="<?php echo in_array($step, [2,3,4]) ? 'border-bottom-color: #eb1f1b;' : ''; ?>"><p>2 - Personal details</p><span>2</span></a>
            <a href="#" style="<?php echo in_array($step, [3,4]) ? 'border-bottom-color: #eb1f1b;' : ''; ?>"><p>3 - security details</p><span>3</span></a>
            <a href="#" style="<?php echo in_array($step, [4]) ? 'border-bottom-color: #eb1f1b;' : ''; ?>"><p>4 - summary</p><span>4</span></a>

        </div>
    </section>
    
    <?php
        if ($step == 1) {
            include_once('open-individual-account-step-1.php');
        } elseif ($step == 2) {
            include_once('open-individual-account-step-2.php');
        }
    ?>
</main>




<!-- footer -->
<?php include_once(SHARED_PATH . '/public_footer.php');?>


