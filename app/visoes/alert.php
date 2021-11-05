<?php if($_GET['mensagem']) { ?>
    <div id="alert" role="alert" style="text-align: center;">
     <p><?= $_GET['mensagem'] ?></p>
    </div>
<?php } ?>
<script>
    setTimeout(() => { document.getElementById('alert').remove(); }, 5000);
</script>