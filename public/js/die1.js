var modified;
$(document).ready(function ()
{
  $("input, select, textarea,combobox, checkbox").change(function () {
    modified = true;
  });
});

$(".pagination").on('click','li',function(){
  if (modified)  {
   return confirm('Los cambios implementados no fueron guardados ¿Desea cambiar de página todas formas?');
   }

});

/// Verificar cambios si cierra
$(window).on('mouseover', (function () {
  window.onbeforeunload = null;
}));
$(window).on('mouseout', (function () {
  window.onbeforeunload = ConfirmLeave;
}));
function ConfirmLeave() {
  return "";
}

/// Fin verificar cambios
function inhabilitar_cuadro(cuadro){  //&& !$(this).is('[readonly]')
table ="#tabla"+cuadro;
nombre='['+cuadro+']';
 if ($("input[name='cuadros"+nombre+"']").is(':checked')) {
  $(table).each(function(tr_idx, tr_elem) {
    $tr = $(tr_elem);
    $tr.find('input, select, textarea, checkbox, radio').each(function(nColumnas, i_elem) {

    if (($(this).attr('type')=='radio' && ($(this).prop('checked')==true))
     || ($(this).attr('type')!=='radio'&& ($(this).val().length!==0))  )
      {
        // console.log('entro '+$(this).attr('type')+' '+$(this).prop('checked')+ ' '+ $(this).val().length);
      $(table).find("input,button,textarea,select, checkbox, radio").removeAttr('disabled');
      $(this).attr('class', 'habilitada');
      $("input[name='cuadros"+nombre+"']").prop('checked', false);


      $('#agregar_fila'+cuadro).attr("disabled", false);
      $('#agregar0'+cuadro).attr("disabled", false);
      $('#quitar0'+cuadro).attr("disabled", false);
      $('#limpiar_todo'+cuadro).attr("disabled", false);

      $tr.find('td').each(function(nColumnas, i_elem) {
        if ($(this).attr('class')=='error' || $(this).attr('class')=='deshabilitada'  ){
           $(this).attr('class', 'habilitada');
        }
      });

      var html="<div class='alert alert-info'><button type='button' class='close' data-dismiss='alert'>&times;</button>  <strong><i class='fa fa-info-circle fa-2x'> </i> El cuadro debe estar vacío para poder marcarlo sin información</strong></div>";
      $(".sucessMessages").html(html);
       return false;
    }
    else {
          $(table).find("input,button,textarea,select, checkbox, radio").attr("disabled", "disabled");
          $('#'+'agregar'+cuadro).attr("disabled", "disabled");
          $tr.find('td').each(function(nColumnas, i_elem) {
        if ($(this).attr('class')=='error' || $(this).attr('class')=='habilitada'  ){
           $(this).attr('class', 'deshabilitada');
        }
        });
      $(".sucessMessages").html(html).empty();
      $('#agregar_fila'+cuadro).attr("disabled", true);
      $('#agregar0'+cuadro).attr("disabled", true);
      $('#quitar0'+cuadro).attr("disabled", true);
      $('#limpiar_todo'+cuadro).attr("disabled", true);
    }  //else
   }); //tr.find
  });  //$(table)
}
else {  // si no esta chequeado

    $("input[name='cuadros"+nombre+"']").attr('checked', false);
    $(table).find("input,button,textarea,select, checkbox, radio").removeAttr('disabled');
    $('#'+'agregar'+cuadro).removeAttr('disabled');
      $tr.find('td').each(function(nColumnas, i_elem) {
      if ($(this).attr('class')=='deshabilitada') {
           $(this).attr('class', 'habilitada');
      }
     });
  $('#agregar_fila'+cuadro).attr("disabled", false);
  $('#agregar0'+cuadro).attr("disabled", false);
  $('#quitar0'+cuadro).attr("disabled", false);
  $('#limpiar_todo'+cuadro).attr("disabled", false);
}
}


function inhabilitar_cuadro_tipo4(cuadro){  //&& !$(this).is('[readonly]')
table ="#tabla"+cuadro;
nombre='['+cuadro+']';
 if ($("input[name='cuadros"+nombre+"']").is(':checked')) {
  $(table).each(function(tr_idx, tr_elem) {
    $tr = $(tr_elem);
    $tr.find('input, select, textarea, checkbox').each(function(nColumnas, i_elem) {
    if ($(this).val().length!==0 && $(this).prop('checked')!== false)  {
      $(table).find("input,button,textarea,select, checkbox").removeAttr('disabled');
      $(this).attr('class', 'habilitada');
      $("input[name='cuadros"+nombre+"']").prop('checked', false);
      $('#'+'agregar'+cuadro).removeAttr('disabled');
      $('#limpiar_todo'+cuadro).attr("disabled", false);
      var html="<div class='alert alert-info'><button type='button' class='close' data-dismiss='alert'>&times;</button>  <strong><i class='fa fa-info-circle fa-2x'> </i> El cuadro debe estar vacío para poder marcarlo sin información</strong></div>";
      $(".sucessMessages").html(html);
      return false;
    }
    else {
          $(table).find("input,button,textarea,select, checkbox").attr("disabled", "disabled");
          $('#'+'agregar'+cuadro).attr("disabled", "disabled");
          $tr.find('td').each(function(nColumnas, i_elem) {
        if ($(this).attr('class')=='error' || $(this).attr('class')=='habilitada'  ){
           $(this).attr('class', 'deshabilitada');
        }
        });
      $(".sucessMessages").html(html).empty();
      $('#agregar_fila'+cuadro).attr("disabled", true);
      $('#agregar0'+cuadro).attr("disabled", true);
      $('#quitar0'+cuadro).attr("disabled", true);
      $('#limpiar_todo'+cuadro).attr("disabled", true);
    }  //else
   }); //tr.find
  });  //$(table)
}
else {  // si no esta chequeado
    $("input[name='cuadros"+nombre+"']").attr('checked', false);
    $(table).find("input,button,textarea,select, checkbox").removeAttr('disabled');
    $('#'+'agregar'+cuadro).removeAttr('disabled');
      $tr.find('td').each(function(nColumnas, i_elem) {
      if ($(this).attr('class')=='deshabilitada') {
           $(this).attr('class', 'habilitada');
      }
     });
  $('#agregar_fila'+cuadro).attr("disabled", false);
  $('#agregar0'+cuadro).attr("disabled", false);
  $('#quitar0'+cuadro).attr("disabled", false);
  $('#limpiar_todo'+cuadro).attr("disabled", false);
}
}

function eliminar_fila(cuadro, fila){
  modified = true;
  table ="#tabla"+cuadro;
  inputs='cuadros['+cuadro+']';
  fila=parseInt(fila)-1;

  $(table + ' tr:eq('+fila+')').remove();

  name_atri=$('input:visible:enabled:first').attr("name");
    // Recorro todo los tr y le cambio el nombre y el id
   nfila=0;

   $(table + ' tr').each(function(tr_idx, tr_elem) {
    $tr = $(tr_elem);
    nfila=nfila+1;
    $(this).attr('name', inputs+'['+nfila+']');
    $(this).attr('id', inputs+'['+nfila+']');

    $tr.find('button').each(function() {
       $(this).attr('onclick', 'eliminar_fila('+cuadro+','+nfila+')');
    });
    

    $tr('input, select, textarea,combobox').each(function(nColumnas, i_elem) {
     nColumnas=parseInt(nColumnas)+1;       
     if ($(this).attr("name") != name_atri){     
        $(this).attr('name', inputs+'['+nfila+']'+'['+nColumnas+']');              
        name_anterior=$(this).attr('name');        
      }
     else{
       $(this).attr('name', name_anterior);         
     }         
      name_atri=$(this).attr("name");
    });

  });

  $tr.find('input, select, textarea,combobox').each(function(nColumnas) {
    nColumnas=parseInt(nColumnas)+1;         
    $(this).attr('name', inputs+'['+nfila+']'+'['+nColumnas+']');  
   });  
   
  nFilas = $(table+" tr").length;  // Total de filas de la tabla
  ultima_fila=parseInt(nFilas-1);
  fila=nFilas+1;
  nindex=1;  
  $(table + ' tr:last ').each(function(tr_idx, tr_elem) {
      $tr = $(tr_elem);
      $tr.find("input, select,textarea, combobox").each(function(nColumnas, i_elem) {
      nindex++;
        $(this).attr('name', inputs+'['+nfila+']'+'['+nindex+']');
    });
  });

  id=0;
  $('input, select, textarea,combobox').each(function(nColumnas, i_elem) {
    if($(this).attr("readonly")) {
    }
    else
    { id=id+1;
      $(this).attr('id', id);
      $(this).attr('tabindex', id);
    }
   });

  name_atri=$('input:visible:enabled:first').attr("name");
  id=0;
 
  $('input, select, textarea,combobox').each(function(nColumnas, i_elem) {
    if($(this).attr("readonly")) {
    }
    else { 
      id=id+1;
      if ($(this).attr("name") != name_atri){          
        $(this).attr('id', id);
        $(this).attr('tabindex', id);         
        id_anterior=$(this).attr('id'); 
        name_anterior=$(this).attr('name'); 

      }
     else{
       $(this).attr('id', id_anterior);
       $(this).attr('name', name_anterior); 
       $(this).attr('tabindex', id);  
      
     }         
      name_atri=$(this).attr("name");
    }
   });
};

function agregar_fila(cuadro, c_tipo_cuadro) {
  inputs='cuadros['+cuadro+']';  // que cuadro voy a clonar
  tr_id='cuadros['+cuadro+']';

  table ="#tabla"+cuadro;
  nFilas = $(table+" tr").length;  // Total de filas de la tabla

  if (c_tipo_cuadro==2) {
   primera_fila_editable=parseInt($(table + ' tr th:first').attr('rowspan'));  //Primer fila editable
   nColumnas_editables = $(table +' tr:eq('+primera_fila_editable +') td').length; // Cantidad de columnas de la primer fila editable
   ultima_fila=parseInt(nFilas-1);
   nColumnas_total_ult_fila = $(table +' tr:eq('+ultima_fila+') td ').length; // Total de columnas editables  de la ultima fila
   cant_columnas=nColumnas_editables-nColumnas_total_ult_fila; // Total Columnas editables ultima fila

   $(table + ' tr:eq('+primera_fila_editable+')').clone().each(function(tr_idx, tr_elem) {
    $tr = $(tr_elem);
      $(this).attr('name', tr_id+'['+nFilas+']');
      // $(this).attr('id', tr_id+'['+nFilas+']');

      $tr.find('button').each(function(nColumnas, i_elem) {
        $(this).attr('onclick', 'eliminar_fila('+cuadro+','+nFilas+')');
      });

     $tr.find('td').each(function(nColumnas, i_elem) {
      $(this).removeAttr('style');
      if ($(this).attr('class')=='error') {
        $(this).attr('class', 'habilitada');
      }
     });

     $tr.find("input, select, textarea").each(function(nColumnas, i_elem) {
        $(this).attr('name', inputs+'['+nFilas+']['+nColumnas+']');
        $(this).attr('title', '');
        $(this).attr('value', '');
       });
     }).insertBefore(table + ' tr:last', table ).find("select, input, textarea").val(""); // inserto antes de la última

    $(table + ' tr:eq('+ultima_fila+') ').each(function(tr_idx, tr_elem) {
      $tr = $(tr_elem);
      $(this).attr('id', tr_id+'['+nFilas+']');
      $(this).attr('name', tr_id+'['+nFilas+']'); // cambio valor a la fila agregada

      $tr.find("input, select,textarea, combobox").each(function(nColumnas, i_elem) {
       nColumnas=parseInt(nColumnas)+1;
      $(this).attr('name', inputs+'['+nFilas+']['+nColumnas+']');
     });
   }); // le cambio el numero de fila a la fila insertada

   fila=nFilas+1;
 // en la ultima fila solo cambiar el numero de columna
   $(table + ' tr:last ').each(function(tr_idx, tr_elem) {
      $tr = $(tr_elem);
      $(this).attr('id', tr_id+'['+fila+']');
      $(this).attr('name', tr_id+'['+fila+']');
      $tr.find("input, select,textarea, combobox").each(function(nColumnas, i_elem) {
      sc = $(this).attr('name');
       nindex=sc.substring(sc.lastIndexOf("["));
      $(this).attr('name', inputs+'['+fila+']'+nindex);
     });
   });

  // ----------------------------- radio
  uno=0;
  value_checked=0
  $(table + ' tr:eq('+ultima_fila+') ').each(function(tr_idx, tr_elem) {
    $tr = $(tr_elem);
    $tr.find("input").each(function(nColumnas, i_elem) {
     if (($(this).attr('type')=='radio') && uno==0){
        uno++;
        tomar_nombre=$(this).attr('name');
        value_checked++
     }
    else if (($(this).attr('type')=='radio') && uno==1) {
      $(this).attr('name',tomar_nombre);
      value_checked++
    }
    $(this).attr('checked',false);
    $(this).attr('value',value_checked);

  });
  });

    // ----------------------------
  }

    if (c_tipo_cuadro==3) {

        tr = $('tr:last', tabla);
        nuevaFila=nFilas+1;
        $(table + ' tr:last').clone().each(function(tr_idx, tr_elem) {
         $tr = $(tr_elem);
        $(this).attr('id', inputs+'['+nFilas+']');
        $(this).attr('name', tr_id+'['+nFilas+']');

        $tr.find('button').each(function(nColumnas, i_elem) {
           $(this).attr('onclick', 'eliminar_fila('+cuadro+','+nFilas+')');
         });

        $tr.find('td').each(function(nColumnas, i_elem) {
         $(this).removeAttr('style');
         if ($(this).attr('class')=='error') {
           $(this).attr('class', 'habilitada');
         }
       });

         $tr.find("input, select,textarea,combobox").each(function(nColumnas, i_elem) {
         nColumnas2 = $(table2 +' tr:last td').length-1; // Cantidad de columnas del ultimo tr
         id_viejo=$(this).attr('id'); // primero obtengo el id
         id_nuevo=parseInt(id_viejo)+parseInt(nColumnas2);
         id_focus=id_nuevo+1;
         nColumnas=parseInt(nColumnas)+1;
          $(this).attr('id', id_nuevo);
          $(this).attr('name', inputs+'['+nuevaFila+']['+nColumnas+']');
       });
       }).appendTo(table).find("input, select, textarea ").val('');
    }


    
    name_atri=$('input:visible:enabled:first').attr("name");
    id=0;
    $('input, select, textarea,combobox').each(function(nColumnas, i_elem) {
      if($(this).attr("readonly")) {
      }
      else { 
        id=id+1;
        if ($(this).attr("name") != name_atri){          
          $(this).attr('id', id);
          $(this).attr('tabindex', id);         
          id_anterior=$(this).attr('id'); 
          name_anterior=$(this).attr('name'); 

        }
       else{
         $(this).attr('id', id_anterior);
         $(this).attr('tabindex', id);  
         $(this).attr('name', name_anterior); 
       }         
        name_atri=$(this).attr("name");
      }

     });

} // agregar_fila

// Agregar y quitar 0
  function agregar_ceros(cuadro)
  {
    modified = true;
    nombre='['+cuadro+']';
   if (!$("input[name='cuadros"+nombre+"']").is(':checked')) {
    inputs ='cuadros['+cuadro+']';
    $("input[name*='"+inputs+"" ).each(function(){
     if($(this).val()=='') {
       if ($(this).attr('type')=='number' && !$(this).is('[readonly]')) {
         $(this).val("0");
       }
       }
     }); //each
    }
  }

  function quitar_ceros(cuadro)
  {
   modified = true;
   inputs ='cuadros['+cuadro+']';
   $("input[name*='"+inputs+"" ).each(function(){
     if ($(this).attr('type')=='number') {
       if ($(this).val()==0){ $(this).val(""); }
     }
   });
  }


 function vaciar_cuadro(cuadro)
  {
    var check = confirm("Va a eliminar todos los datos del cuadro. Esta seguro?");
    if (check){
       modified = true;
       inputs ='cuadros['+cuadro+']';
       $("input[name*='"+inputs+"" ).each(function(){
         if ($(this).attr('type')=='number' ||  $(this).attr('type')=='textarea' || $(this).attr('type')=='text' ){
          $(this).val("");
         }
         else if ($(this).attr('type')=='checkbox'){
            $(this).prop('checked', false);
         }
         else if ($(this).attr('type')=='radio'){
           $(this).prop('checked', false);
       }
       });

      $("select[name*='"+inputs+"" ).each(function(){
          $(this).val("");
       });
      return true;
      }
    else {return false; }
}



 function habilitar_check(cuadro)
  {
   modified = true;
   inputs ='cuadros['+cuadro+']';
   $("input[name*='"+inputs+"" ).each(function(){
     if ($(this).attr('type')=='checkbox'){
        $(this).attr('checked', true);
     }
   });
  }