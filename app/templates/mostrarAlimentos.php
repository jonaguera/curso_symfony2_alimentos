<?php ob_start() ?>

<?php include 'dibujarTabla.php' ?>
<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>