
<?php 
include_once "../Estructura/header.php";
//$objControl = new AbmCompra();
//$List_Compra = $objControl->buscar(null);

?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Basic CRUD Application - jQuery EasyUI CRUD Demo</title>
<link rel="stylesheet" type="text/css" href="../js/jquery-easyui-1.6.6/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="../js/jquery-easyui-1.6.6/themes/icon.css">
<link rel="stylesheet" type="text/css" href="../js/jquery-easyui-1.6.6/themes/color.css">
<link rel="stylesheet" type="text/css" href="../js/jquery-easyui-1.6.6/demo/demo.css">
<script type="text/javascript" src="../js/jquery-easyui-1.6.6/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery-easyui-1.6.6/jquery.easyui.min.js"></script>
</head>
<body>
<h2>Compras Ingresadas</h2>
<p>Seleccione la acci&oacute;n que desea realizar.</p>

<table id="dg" title="Administrador de item Compra" class="easyui-datagrid" style="width:900px;height:750px"
    url="accion/listar_compra.php" toolbar="#toolbar" pagination="true" rownumbers="true" fitColumns="true" singleSelect="true" striped="true" data="1">

    <thead>
        <tr>
            <th field="idcompra" width="10">ID Compra</th>
            <th field="cofecha" width="20">Fecha</th>
            <th field="idusuario" width="10">ID Usuario</th>
            <th field="usnombre" width="20">Nombre Usuario</th>
        </tr>
    </thead>
</table>

<div id="toolbar">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newCompra()">Nuevo Compra </a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editCompra()">Editar Compra</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyCompra()">Baja Compra</a>

   <!-- <select id="cc" class="easyui-combogrid" name="dept" style="width:220px;"
        data-options="
            panelWidth:220,
            value:'Estado de la compra',
            idField:'idcompraestadotipo',
            textField:'cetdescripcion',
            url:'accion/tipo_list.php',
            columns:[[
                {field:'idcompraestadotipo',title:'Id',width:40},
                {field:'cetdescripcion',title:'Descripci&oacute;',width:180},
            ]]
        "></select> -->

</div>
            
<div id="dlg" class="easyui-dialog" style="width:600px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
    <form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
        <h3>Compra Informacion</h3>
        <div style="margin-bottom:10px">                    
            <input name="cofecha" id="cofecha"  class="easyui-textbox" required="true" label="Fecha:" style="width:100%">
        </div>
        <div style="margin-bottom:10px">
            <input  name="idusuario" id="idusuario"  class="easyui-textbox" required="true" label="Descripcion:" style="width:100%">
        </div>
    </form>
</div>

<div id="dlg-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveCompra()" style="width:90px">Aceptar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
</div>



<script type="text/javascript">
            var url;
            function newCompra(){
                $('#dlg').dialog('open').dialog('center').dialog('setTitle','Nuevo Compra');
                $('#fm').form('clear');
                url = 'accion/alta_compra.php';
            }

            function editCompra(){
                var row = $('#dg').datagrid('getSelected');
                if (row){
                    $('#dlg').dialog('open').dialog('center').dialog('setTitle','Editar Compra');
                    $('#fm').form('load',row);
                    url = 'accion/edit_compra.php?accion=mod&idcompra='+row.idCompra;
                }
            }

            function saveCompra(){
            	//alert(" Accion");
                $('#fm').form('submit',{
                    url: url,
                    onSubmit: function(){
                        return $(this).form('validate');
                    },
                    success: function(result){
                        var result = eval('('+result+')');

                        alert("Volvio Serviodr");   
                        if (!result.respuesta){
                            $.messager.show({
                                title: 'Error',
                                msg: result.errorMsg
                            });
                        } else {
                           
                            $('#dlg').dialog('close');        // close the dialog
                            $('#dg').datagrid('reload');    // reload 
                        }
                    }
                });
            }

            function destroyCompra(){
                var row = $('#dg').datagrid('getSelected');
                if (row){
                    $.messager.confirm('Confirm','Seguro que desea eliminar el Compra?', function(r){
                        if (r){
                            $.post('accion/eliminar_compra.php?idcompra='+row.idCompra,{idCompra:row.id},
                               function(result){
                               	 alert("Volvio Serviodr");   
                                 if (result.respuesta){
                                   	 
                                    $('#dg').datagrid('reload');    // reload the  data
                                } else {
                                    $.messager.show({    // show error message
                                        title: 'Error',
                                        msg: result.errorMsg
                                  });
                                }
                            },'json');
                        }
                    });
                }
            }



</script>
         