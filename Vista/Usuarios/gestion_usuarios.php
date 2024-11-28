<?php 
include_once "../Estructura/header.php";

?>
<br><br>
<h1>Gesti&oacute;n de Usuarios</h1>

<div class="main-content">
    <!-- Tabla dinamica  -->
    <table id="tbl1"></table>

    <!-- Un div que contiene: -->
    <!-- Un selector desplegable (#cmb1) -->
    <div id="tool1">
        <input id="cmb1"  name="dept" style="width: 210px;" >
        <!-- Un botón para ver los detalles de la compra seleccionada, asociado a la función DetalleCompra() -->
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editar()" style="width:150px">Editar Usuario</a>
    </div>             
</div>

<!-- dlg1: Un cuadro de diálogo que se abre para mostrar los detalles de una compra seleccionada -->
<div id="dlg1" >
    <!-- Formulario oculto (frm1) que se usa para enviar datos mediante POST -->
    <form id="frm1" method="post" novalidate style="margin:0;padding:20px 50px">
            <h3>Informaciondel Usuario</h3>
            <div style="margin-bottom:10px">                               
                <input name="usnombre" id="usnombre"  class="easyui-textbox" required="true" label="Nombre:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input  name="usmail" id="usmail"  class="easyui-textbox" required="true" label="Mail:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
             
            </div>
              <div style="margin-bottom:10px">
            <input class="easyui-checkbox" name="usdeshabilitado" value="usdeshabilitado" label="Inactivo">
        </div>
    </form>
    <div id="tool2">
        <!-- Dos botones funcionales: 1) Cancelar Compra: Llama a cancelarCompra(). 2) Confirmar Compra: Llama a avanzarCompra() -->
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="cancelarCompra()" >Cancelar Compra</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" plain="true" onclick="avanzarCompra()">Confirmar</a>
    </div>
</div>

<!-- Botones del formulario -->
<!-- Botones de dialogo para: 1)Aceptar: Ejecuta saveCompra(), que envía el formulario frm1. 2)Cancelar: Cierra el cuadro de diálogo dlg1 -->
<div id="dlg-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveCompra()" style="width:90px">Aceptar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg1').dialog('close')" style="width:90px">Cancelar</a>
</div>

<script type="text/javascript">
    var url;

    //Configura dlg1 como un cuadro de diálogo modal con botones definidos en dlg-buttons
    $('#dlg1').dialog({
        title: 'Editar',
        width: 600,
        height: 300,
        closed: true,
        cache: false,
        modal: true,
        border:'thin',
        buttons:'#dlg-buttons',
//        href: 'get_content.php'
    });

    //cmb1 es un desplegable dinámico que carga sus opciones desde tipo_list.php.
    //Al seleccionar un estado, recarga la tabla tbl1 con datos filtrados según el estado seleccionado.
    $('#cmb1').combobox({
        panelWidth:150,
        value:'Seleccione Tipo de usuario',
        valueField:'idrol',
        textField:'rodescripcion',
        url:'accion/rol_list.php',
        onSelect: function(rec){
                var url = 'accion/listar_usuario.php?idrol='+rec.idrol;
                $('#tbl1').datagrid('reload', url);
        },
    });

    //Configura tbl1 como una tabla dinámica que muestra las compras en proceso.
    //Las columnas incluyen información básica: ID de compra, fecha, ID del usuario y nombre.
    $('#tbl1').datagrid({
        title: 'Usuarios',
        width: 605,
        heigth: 300,
       // fitColumns: true,
        singleSelect: true,
        striped: true,
        toolbar: '#tool1',
        url:'accion/listar_usuario.php',
        columns:[[
            {field:'idusuario',title:'Id Usuario', width:100, align:'center'},
            {field:'usnombre',title:'Nombre', width:250, align:'center', sortable:true, order:'asc'},
            {field:'usmail',title:'Email', width:250, align:'center'},
        ]]
    });

    //Muestra los detalles de la compra seleccionada al abrir dlg1 y recarga los ítems de la compra.
    function editar(){
        var row = $('#tbl1').datagrid('getSelected');
        var titulo = 'Editar Usuario';
        if (row){
           $('#dlg1').dialog('open').dialog('center').dialog('setTitle', titulo);
           $('#frm1').form('load', row);
           url = 'accion/editar_usuario.php?idusuario='+row.idusuario;    
        }
    }

    //Muestra un mensaje de confirmación y genera un enlace para avanzar el estado de una compra.
    function avanzarCompra(){
        var row = $('#tbl1').datagrid('getSelected');
        if (row){
            alert("Seguro de cambiar la compra N° " + row['idcompra']);
            url = 'accion/avanzar_compra.php?idcompra='+row.idcompra;   
        }
    }

    //Muestra un mensaje de confirmación para cancelar la compra seleccionada.
    function cancelarCompra(){
        var row = $('#tbl1').datagrid('getSelected');
        if (row){
            alert("Seguro de cancelar la compra N° " + row['idcompra']);
            url = 'accion/cancelar_compra.php?idcompra='+row.idcompra;   
        }
    }

    //Envia los datos del formulario oculto (frm1) al servidor.
    //Si tiene éxito, cierra el diálogo y recarga la tabla tbl1.
    function saveCompra(){
    	//alert(" Accion");
        $('#frm1').form('submit',{
            url: url,
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                var result = eval('('+result+')'); 
                 
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