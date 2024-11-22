
<?php 
include_once "../Estructura/header.php";
$datos = data_submitted();
$objAbmCompraItem = new AbmCompraItem();
$listaCompraItem = $objAbmCompraItem->buscar($datos);

?>
<br><br>
<h2>Compras Ingresadas</h2>

<table id="tabla1"></table>

<script type="text/javascript">

    //Configuracion de la tabla de detalle. Carga datos desde detalle_compra.php
    $('#tabla1').datagrid({
        width: 610,
        heigth: 300,
        fitColumns: true,
        singleSelect: true,
        striped: true,
        
        toolbar: [{
            iconCls: 'icon-edit',
            handler: function(){alert('edit')}
        },'-',{
            iconCls: 'icon-help',
            handler: function(){alert('help')}
        }],

        url:'accion/detalle_compra.php',
        columns:[[
            {field:'idcompra',title:'Id Compra', width:100, align:'center'},
            {field:'idcompraitem',title:'ID', width:100, align:'center'},
            {field:'idproducto',title:'Id Producto', width:150, align:'center'},
            {field:'cicantidad',title:'Cantidad', width:150, align:'center'},
        ]]
    });

    //Configuracion del dialogo
    $('#dialogo1').dialog({

        title: 'Detalle de la compra',
        width: 800,
        height: 600,
        closed: false,
        cache: false,
        href: 'detalle_compra.php?accion=mod&idcompra='+$('#tabla1').datagrid('getSelected').idCompra,
        modal: true
    });
    $('#dialogo1').dialog('refresh', 'new_content.php');


    
    function DetalleCompra(){
        //Obtiene la fila seleccionada de tabla1. Si no hay selección, devuelve null
        var row = $('#tabla1').datagrid('getSelected');
          //  if (row){
            //Abre el cuadro de diálogo y le asigna el título Detalle de la Compra.
            $('#dialogo1').dialog('open').dialog('center').dialog('setTitle','Detalle de la Compra');
          // $('#fm').form('load',row);
            //Establece una URL dinámica (detalle_compra.php) que incluye el idcompra de la fila seleccionada.
            url = 'accion/detalle_compra.php?accion=mod&idcompra='+row.id;
        //}
    }

</script>