
<?php 
include_once "../Estructura/header.php";

?>
<br><br>
<h1>Gesti&oacute;n de Compras</h1>

<div class="main-content">
    <table id="tbl1"></table>  
    <div id="tool1">
        <input id="cmb1"  name="dept" style="width: 210px;" >
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="DetalleCompra()" style="width:150px">Ver Detalle</a>
    </div>             
</div>
<div id="dlg1" >
    <table id="tbl2"></table>
    <form id="frm1" method="post" novalidate hidden ></form>
    <div id="tool2">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="cancelarCompra()" >Cancelar Compra</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" plain="true" onclick="seguirCompra()" >Confirmar</a>
    </div>  
</div>
<!-- Botones del formulario -->
<div id="dlg-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveCompra()" style="width:90px">Aceptar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg1').dialog('close')" style="width:90px">Cancelar</a>
</div>

<script type="text/javascript">
    var url;

    $('#dlg1').dialog({
        title: 'Detalle de la Compra',
        width: 600,
        height: 300,
        closed: true,
        cache: false,
        modal: true,
        border:'thin',
        buttons:'#dlg-buttons',
//        href: 'get_content.php'
    });

    $('#cmb1').combobox({
        panelWidth:150,
        value:'Seleccione Estado compra',
        valueField:'idcompraestadotipo',
        textField:'cetdescripcion',
        url:'accion/tipo_list.php',
        onSelect: function(rec){
                var url = 'accion/listar_compra.php?idcompraestadotipo='+rec.idcompraestadotipo;
                $('#tbl1').datagrid('reload', url);
                //alert("Valor:   " + rec['idcompraestadotipo'] );
        },
    });

    $('#tbl1').datagrid({
        title: 'Compras en proceso',
        width: 710,
        heigth: 300,
        fitColumns: true,
        singleSelect: true,
        striped: true,
        toolbar: '#tool1',
        url:'accion/listar_compra.php',
        columns:[[
            {field:'idcompra',title:'Id Compra', width:100, align:'center'},
            {field:'cofecha',title:'Fecha', width:150, align:'center'},
            {field:'idusuario',title:'ID Usuario', width:100, align:'center'},
            {field:'usnombre',title:'Nombre', width:150, align:'center'},
        ]]
    });

    $('#tbl2').datagrid({
        width: 592,
        heigth: 250,
        fitColumns: false,
        singleSelect: true,
        striped: true,
        toolbar: '#tool2',
      //  url:'accion/detalle_compra.php',
        columns:[[
            {field:'idcompraitem',title:'ID Item', width:70, align:'center'},
            {field:'idproducto',title:'ID Pr', width:70, align:'center'},
            {field:'pronombre',title:'Producto', width:380, align:'center'},
            {field:'cicantidad',title:'Cantidad', width:70, align:'center'},
        ]]
    });

    function DetalleCompra(){
        var row = $('#tbl1').datagrid('getSelected');
        if (row){
           // alert("Enviando: " + row['idcompra']);  
            url = 'accion/detalle_compra.php?idcompra='+row.idcompra;    
            $('#dlg1').dialog('open').dialog('center').dialog('setTitle','Detalle de la Compra');
            $('#tbl2').datagrid('reload', url);
        }
    }

    function cancelarCompra(){
        var row = $('#tbl1').datagrid('getSelected');
        if (row){
            alert("Seguro de cancelar la compra N° " + row['idcompra']);
            url = 'accion/cancelar_compra.php?idcompra='+row.idcompra;   
        }
    }
    function seguirCompra(){
        var row = $('#tbl1').datagrid('getSelected');
        if (row){
            url = 'accion/avanzar_compra.php?idcompra='+row.idcompra;            
        }
    }

    function saveCompra(){
            	//alert(" Accion");
                $('#frm1').form('submit',{
                    url: url,
                    onSubmit: function(){
                        return $(this).form('validate');
                    },
                    success: function(result){
                        var result = eval('('+result+')');

                        alert("Hecho ");   
                        if (!result.respuesta){
                            $.messager.show({
                                title: 'Error',
                                msg: result.errorMsg
                            });
                        } else {
                            $('#dlg1').dialog('close');        // close the dialog
                            $('#tbl1').datagrid('reload');    // reload 
                        }
                    }
                });
            }

</script>


     <!--   <input id="cmb1" class="easyui-combogrid" name="dept" style="width:220px;"
        data-options="
        panelWidth:220,
        value:'Seleccione Estado compra',
        idField:'idcompraestadotipo',
        textField:'cetdescripcion',
        url:'accion/tipo_list.php',
        columns:[[
            {field:'idcompraestadotipo',title:'Id',width:40},
            {field:'cetdescripcion',title:'Descripci&oacute;',width:180},
            ]],
            onSelect: function(rec){
                rec ++;
                var url = 'accion/listar_compra.php?idcompraestadotipo='+rec;
                $('#tbl1').datagrid('reload', url);
                }


                    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveCompra()" style="width:90px">Aceptar</a>
                "> -->