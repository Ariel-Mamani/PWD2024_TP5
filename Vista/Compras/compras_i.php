
<?php 
include_once "../Estructura/header.php";

?>
<br><br>
<h2>Compras Ingresadas</h2>

<div class="main-content">

    <table id="tabla1" toolbar="#toolbar"></table>
</div>

<div id="toolbar">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="DetalleCompra()">Detalle de la Compra</a>
</div>   

<div id="div_tabla2" hidden>
    <table id="tabla2"></table>
</div>

<script type="text/javascript">

    var url;

    $('#tabla1').datagrid({
        width: 710,
        heigth: 300,
        fitColumns: true,
        singleSelect: true,
        striped: true,
        toolbar: '#toolbar',
        
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
            {field:'item',title:'Nombre', width:150, align:'center'},
        ]]
    });

/*
    $('#dialogo1').dialog({

        title: 'Detalle de la compra',
        width: 800,
        height: 600,
        closed: false,
        cache: false,
       // href: 'compra_item.php?accion=mod&idcompra='+$('#tabla1').datagrid('getSelected').idCompra,
        modal: true
    });
    $('#dialogo1').dialog('refresh', 'new_content.php');

*/
    
    function DetalleCompra(){
        
        var row = $('#tabla1').datagrid('getSelected');
            if (row){
                
          //  $('#dialogo1').dialog('open').dialog('center').dialog('setTitle','Detalle de la Compra');
          //  $('#tabla2').datagrid('load',row);
          alert("Enviando");  
            url = 'compra_item.php?accion=mod&idcompra='+row.idcompra;
        }
    }

</script>