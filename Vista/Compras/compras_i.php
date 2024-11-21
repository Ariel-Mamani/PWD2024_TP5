
<?php 
include_once "../Estructura/header.php";

?>
<br><br>
<h2>Compras Ingresadas</h2>

<table id="tabla1"></table>

<div id="dialogo1">
    <table id="tabla2"></table>
</div>

<script type="text/javascript">

    $('#tabla1').datagrid({
        width: 710,
        heigth: 300,
        fitColumns: true,
        singleSelect: true,
        striped: true,
        
        toolbar: [{
            iconCls: 'icon-edit',
            handler: function(){DetalleCompra()}
        },'-',{
            iconCls: 'icon-help',
            handler: function(){alert('help')}
        }],

        url:'accion/listar_compra.php',
        columns:[[
            {field:'idcompra',title:'Id Compra', width:100, align:'center'},
            {field:'cofecha',title:'Fecha', width:150, align:'center'},
            {field:'idusuario',title:'ID Usuario', width:100, align:'center'},
            {field:'usnombre',title:'Nombre', width:150, align:'center'},
        ]]
    });
    $('#tabla2').datagrid({
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
                var row = $('#tabla1').datagrid('getSelected');
              //  if (row){
                    $('#dialogo1').dialog('open').dialog('center').dialog('setTitle','Detalle de la Compra');
                   // $('#fm').form('load',row);
                    url = 'accion/detalle_compra.php?accion=mod&idcompra='+row.id;
                //}
            }

</script>