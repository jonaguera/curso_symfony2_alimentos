<?php ob_start() ?>

<form name="formBusqueda" action="index.php?ctl=buscar" method="POST">

  <table>
      <tr>
          <td>nombre alimento:</td>
          <td><input type="text" name="nombre" value="<?php echo $params['nombre']?>">(puedes utilizar '%' como comodín)</td>

          <td><input type="submit" value="buscar"></td>
      </tr>
  </table>

  </table>

</form>

<?php if (count($params['resultado'])>0): ?>
<?php include 'dibujarTabla.php' ?>
<?php endif; ?>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>