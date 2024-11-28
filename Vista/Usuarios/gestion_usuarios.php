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
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editarRol()" style="width:150px">Cambiar Rol</a>
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
</div>

<!-- Botones del formulario -->
<!-- Botones de dialogo para: 1)Aceptar: Ejecuta saveUsuario(), que envía el formulario frm1. 2)Cancelar: Cierra el cuadro de diálogo dlg1 -->
<div id="dlg-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUsuario()" style="width:90px">Aceptar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg1').dialog('close')" style="width:90px">Cancelar</a>
</div>

<!-- dlg1: Un cuadro de diálogo que se abre para mostrar los detalles de una compra seleccionada -->
<div id="dlg2" >
    <!-- Formulario oculto (frm1) que se usa para enviar datos mediante POST -->
    <form id="frm2" method="post" novalidate style="margin:0;padding:20px 50px">
        <h3>Informaciondel Usuario</h3>
        <div style="margin-bottom:10px">                               
            <input name="usnombre" id="usnombre"  class="easyui-textbox" required="true" label="Nombre:" style="width:100%" readonly>
        </div>
        <div style="margin-bottom:10px"></div>
        <div style="margin-bottom:10px">
            <input id="cmb2"  name="dept" style="width: 210px;" >
        </div>
    </form>
</div>

<div id="dlg-buttons2">
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUsuarioRol()" style="width:90px">Aceptar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg2').dialog('close')" style="width:90px">Cancelar</a>
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

    $('#dlg2').dialog({
        title: 'Cambiar Rol',
        width: 600,
        height: 300,
        closed: true,
        cache: false,
        modal: true,
        border:'thin',
        buttons:'#dlg-buttons2',
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

    $('#cmb2').combobox({
        panelWidth:150,
        value:'Seleccione Tipo de usuario',
        valueField:'idrol',
        textField:'rodescripcion',
        url:'accion/rol_list.php',
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

    function editarRol(){
        var row = $('#tbl1').datagrid('getSelected');
        var titulo = 'Cambiar Rol del Usuario';
        if (row){
           $('#dlg2').dialog('open').dialog('center').dialog('setTitle', titulo);
           $('#frm2').form('load', row);
           url = 'accion/cambiar_rol.php?idusuario='+row.idusuario+'&idrol='+row.idrol;    
        }
    }

    //Envia los datos del formulario oculto (frm1) al servidor.
    //Si tiene éxito, cierra el diálogo y recarga la tabla tbl1.
    function saveUsuario(){
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

    function saveUsuarioRol(){
    	//alert(" Accion");
        $('#frm2').form('submit',{
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
                    $('#dlg2').dialog('close');        // close the dialog
                    $('#tbl1').datagrid('reload');    // reload 
                }
            }
        });
    }
</script>