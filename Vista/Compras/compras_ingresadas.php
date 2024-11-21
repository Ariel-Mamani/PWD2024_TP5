<?php 
include_once "../Estructura/header.php";
//$objControl = new AbmCompra();
//$List_Compra = $objControl->buscar(null);
?>


<br><br>
<h2>Compras Ingresadas</h2>

<!-- Tabla interactiva -->
<table id="dg" title="Administrador de item Compra" class="easyui-datagrid" style="width:900px;height:750px"
    url="accion/listar_compra.php" toolbar="#toolbar" pagination="true" rownumbers="true" fitColumns="true" singleSelect="true" striped="true" >

    <thead>
        <tr>
            <th field="idcompra" width="10">ID Compra</th>
            <th field="cofecha" width="20">Fecha</th>
            <th field="idusuario" width="10">ID Usuario</th>
            <th field="usnombre" width="20">Nombre Usuario</th>
            <th field="item cicantidad" width="20">cantidad</th>
        </tr>
    </thead>
</table>

<!-- Botones para interactuar con la tabla -->
<div id="toolbar">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newCompra()">Nuevo Compra </a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="DetalleCompra()">Detalle Compra</a>
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

<!-- Formulario de compra -->
<div id="dlg" class="easyui-dialog" style="width:600px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
    <form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
        <h3>Compra Informaci&oacute;n</h3>
        <div style="margin-bottom:10px">                    
            <input name="cofecha" id="cofecha"  class="easyui-textbox" required="true" label="Fecha:" style="width:100%" readonly>
        </div>
        <div style="margin-bottom:10px">
            <input  name="idusuario" id="idusuario"  class="easyui-textbox" required="true" label="Descripcion:" style="width:100%" readonly>
        </div>
    </form>
</div>

<!-- Botones del formulario -->
<div id="dlg-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveCompra()" style="width:90px">Aceptar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
</div>
<br><br>

<!-- Footer -->
<?php
    include_once '../Estructura/footer_tienda.php';
?>


<script type="text/javascript">
            var url;

            //Abre el cuadro de diálogo para crear una nueva compra. Limpia el formulario y establece la URL de destino a accion/alta_compra.php
            function newCompra(){
                $('#dlg').dialog('open').dialog('center').dialog('setTitle','Nuevo Compra');
                $('#fm').form('clear');
                url = 'accion/alta_compra.php';
            }

            //Muestra los detalles de una compra seleccionada. Obtiene la fila seleccionada de la tabla #dg, y carga esos datos en el formulario dentro del cuadro de diálogo.
            //Nota: Si no se selecciona una fila, el código no hace nada.
            //URL: Se establece para cargar los detalles de la compra mediante accion/detalle_compra.php.
            function DetalleCompra(){
                var row = $('#dg').datagrid('getSelected');
                if (row){
                    $('#dlg').dialog('open').dialog('center').dialog('setTitle','Detalle de la Compra');
                    $('#fm').form('load',row);
                    url = 'accion/detalle_compra.php?accion=mod&idcompra='+row.idCompra;
                }
            }

            //Envía el formulario de compra al servidor.
            //Usa Ajax para enviar los datos del formulario ($('#fm').form('submit')) a la URL especificada en la variable url.
            //Si la respuesta es exitosa, recarga la tabla de compras ($('#dg').datagrid('reload')) y cierra el cuadro de diálogo.
            //Validación: Se asegura de que el formulario sea válido antes de enviarlo
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

            //Elimina una compra seleccionada de la tabla.
            //Verifica si hay una fila seleccionada y muestra una confirmación antes de enviar la solicitud de eliminación a accion/eliminar_compra.php.
            //Si la eliminación es exitosa, recarga la tabla.
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