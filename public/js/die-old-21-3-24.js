// Funcion que toma los datos del primer input


// function actualizar_datos(){

//   var tabla = document.getElementById("tabla3");

//   // Obtener todos los elementos de entrada con el atributo de datos personalizado "data-id-1"
//   var inputs = tabla.querySelectorAll('input[name$="[1]"]');
  
//   // Recorrer todos los elementos de entrada y obtener su contenido
//   for (var i = 0; i < inputs.length; i++) {
//     var input = inputs[i];
//     var content = input.value;
//     console.log("Contenido del input " + (i+1) + ": " + content);
//   }
  
// }





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



function eliminar_fila(cuadro, fila) {
  var table = "#tabla" + cuadro;
  var inputs = 'cuadros[' + cuadro + ']';
  var filaIndex = parseInt(fila) - 1;

  // Eliminar la fila especificada
  $(table + ' tr:eq(' + filaIndex + ')').remove();

  // Recorrer todas las filas restantes y actualizar sus nombres y IDs
  $(table + ' tr').each(function(index) {
      var nfila = index + 1;
      $(this).attr('name', inputs + '[' + nfila + ']');
      $(this).attr('id', inputs + '[' + nfila + ']');

      // Actualizar el evento onclick de los botones en cada fila
      $(this).find('button').attr('onclick', 'eliminar_fila(' + cuadro + ',' + nfila + ')');

      // Recorrer cada elemento de entrada, select y textarea en la fila y actualizar sus nombres
      $(this).find('input, select, textarea').each(function(nColumnas) {
          nColumnas = nColumnas + 1;
          var newName = inputs + '[' + nfila + '][' + nColumnas + ']';
          $(this).attr('name', newName);
      });
  });
}


// function agregar_fila(cuadro, c_tipo_cuadro) {
//   inputs='cuadros['+cuadro+']';  // que cuadro voy a clonar
//   tr_id='cuadros['+cuadro+']';

//   table ="#tabla"+cuadro;
//   nFilas = $(table+" tr").length;  // Total de filas de la tabla

//   if (c_tipo_cuadro==2) {
//    primera_fila_editable=parseInt($(table + ' tr th:first').attr('rowspan'));  //Primer fila editable
//    nColumnas_editables = $(table +' tr:eq('+primera_fila_editable +') td').length; // Cantidad de columnas de la primer fila editable
//    ultima_fila=parseInt(nFilas-1);
//    nColumnas_total_ult_fila = $(table +' tr:eq('+ultima_fila+') td ').length; // Total de columnas editables  de la ultima fila
//    cant_columnas=nColumnas_editables-nColumnas_total_ult_fila; // Total Columnas editables ultima fila

//    $(table + ' tr:eq('+primera_fila_editable+')').clone().each(function(tr_idx, tr_elem) {
//     $tr = $(tr_elem);
//       $(this).attr('name', tr_id+'['+nFilas+']');
//       // $(this).attr('id', tr_id+'['+nFilas+']');

//       $tr.find('button').each(function(nColumnas, i_elem) {
//         $(this).attr('onclick', 'eliminar_fila('+cuadro+','+nFilas+')');
//       });

//      $tr.find('td').each(function(nColumnas, i_elem) {
//       $(this).removeAttr('style');
//       if ($(this).attr('class')=='error') {
//         $(this).attr('class', 'habilitada');
//       }
//      });

//      $tr.find("input, select, textarea").each(function(nColumnas, i_elem) {
//         $(this).attr('name', inputs+'['+nFilas+']['+nColumnas+']');
//         $(this).attr('title', '');
//         $(this).attr('value', '');
//        });
//      }).insertBefore(table + ' tr:last', table ).find("select, input, textarea").val(""); // inserto antes de la última

//     // propuesta

//     $(table + ' tr:eq('+ultima_fila+') ').each(function(tr_idx, tr_elem) {
//       $tr = $(tr_elem);
//       $(this).attr('id', tr_id+'['+nFilas+']');
//       $(this).attr('name', tr_id+'['+nFilas+']'); // cambio valor a la fila agregada
//       $tr.find("input, select,textarea, combobox").each(function(nColumnas, i_elem) {
//        nColumnas=parseInt(nColumnas)+1;
//       $(this).attr('name', inputs+'['+nFilas+']['+nColumnas+']');
//      });
//    }); // le cambio el numero de fila a la fila insertada

//    fila=nFilas+1;
//  // en la ultima fila solo cambiar el numero de columna
//    $(table + ' tr:last ').each(function(tr_idx, tr_elem) {
//       $tr = $(tr_elem);
//       $(this).attr('id', tr_id+'['+fila+']');
//       $(this).attr('name', tr_id+'['+fila+']');
//       $tr.find("input, select,textarea, combobox").each(function(nColumnas, i_elem) {
//       sc = $(this).attr('name');
//        nindex=sc.substring(sc.lastIndexOf("["));
//       $(this).attr('name', inputs+'['+fila+']'+nindex);
//      });
//    });

//   // ----------------------------- radio
//   uno=0;
//   value_checked=0
//   $(table + ' tr:eq('+ultima_fila+') ').each(function(tr_idx, tr_elem) {
//     $tr = $(tr_elem);
//     $tr.find("input").each(function(nColumnas, i_elem) {
//      if (($(this).attr('type')=='radio') && uno==0){
//         uno++;
//         tomar_nombre=$(this).attr('name');
//         value_checked++
//      }
//     else if (($(this).attr('type')=='radio') && uno==1) {
//       $(this).attr('name',tomar_nombre);
//       value_checked++
//     }
//     $(this).attr('checked',false);
//     $(this).attr('value',value_checked);

//   });
//   });

//     // ----------------------------
//   }

//     if (c_tipo_cuadro==3) {

//         tr = $('tr:last', tabla);
//         nuevaFila=nFilas+1;
//         $(table + ' tr:last').clone().each(function(tr_idx, tr_elem) {
//          $tr = $(tr_elem);
//         $(this).attr('id', inputs+'['+nFilas+']');
//         $(this).attr('name', tr_id+'['+nFilas+']');

//         $tr.find('button').each(function(nColumnas, i_elem) {
//            $(this).attr('onclick', 'eliminar_fila('+cuadro+','+nFilas+')');
//          });

//         $tr.find('td').each(function(nColumnas, i_elem) {
//          $(this).removeAttr('style');
//          if ($(this).attr('class')=='error') {
//            $(this).attr('class', 'habilitada');
//          }
//        });

//          $tr.find("input, select,textarea,combobox").each(function(nColumnas, i_elem) {
//          nColumnas2 = $(table2 +' tr:last td').length-1; // Cantidad de columnas del ultimo tr
//          id_viejo=$(this).attr('id'); // primero obtengo el id
//          id_nuevo=parseInt(id_viejo)+parseInt(nColumnas2);
//          id_focus=id_nuevo+1;
//          nColumnas=parseInt(nColumnas)+1;
//           $(this).attr('id', id_nuevo);
//           $(this).attr('name', inputs+'['+nuevaFila+']['+nColumnas+']');
//        });
//        }).appendTo(table).find("input, select, textarea ").val('');
//     }


    
//     name_atri=$('input:visible:enabled:first').attr("name");
//     id=0;
//     $('input, select, textarea,combobox').each(function(nColumnas, i_elem) {
//       if($(this).attr("readonly")) {
//       }
//       else { 
//         id=id+1;
//         if ($(this).attr("name") != name_atri){          
//           $(this).attr('id', id);
//           $(this).attr('tabindex', id);         
//           id_anterior=$(this).attr('id'); 
//           name_anterior=$(this).attr('name'); 

//         }
//        else{
//          $(this).attr('id', id_anterior);
//          $(this).attr('tabindex', id);  
//          $(this).attr('name', name_anterior); 
//        }         
//         name_atri=$(this).attr("name");
//       }

//      });

// } // agregar_fila

// Agregar y quitar 0
  
function agregar_fila(cuadro, c_tipo_cuadro) {
  inputs = 'cuadros[' + cuadro + ']';
  tr_id = 'cuadros[' + cuadro + ']';
  

  let table = document.getElementById("tabla" + cuadro);
  let nFilas = table.rows.length;

  if (c_tipo_cuadro == 2) {
    let primera_fila_editable = parseInt(table.rows[0].firstElementChild.getAttribute('rowspan'));
    let nColumnas_editables = table.rows[primera_fila_editable].cells.length;
    let ultima_fila = parseInt(nFilas - 1);
    let nColumnas_total_ult_fila = table.rows[ultima_fila].cells.length;
    let cant_columnas = nColumnas_editables - nColumnas_total_ult_fila;

      // Destruye las instancias de Select2 en la fila antes de clonarla
  table.rows[primera_fila_editable].querySelectorAll('select').forEach(select => {
    $(select).select2('destroy');
  });


    let newRow = table.rows[primera_fila_editable].cloneNode(true);
    newRow.setAttribute('name', tr_id + '[' + nFilas + ']');

    newRow.querySelectorAll('button').forEach((button, nColumnas) => {
      button.setAttribute('onclick', 'eliminar_fila(' + cuadro + ',' + nFilas + ')');
    });

    newRow.querySelectorAll('td').forEach((td) => {
      td.removeAttribute('style');
      if (td.getAttribute('class') == 'error') {
        td.setAttribute('class', 'habilitada');
      }
    });

    newRow.querySelectorAll("input, select, textarea").forEach((elem, nColumnas) => {
      elem.setAttribute('name', inputs + '[' + nFilas + '][' + nColumnas + ']');
      elem.setAttribute('title', '');
      elem.value = '';
    });

    table.querySelector('tr:last-child').insertAdjacentElement('beforebegin', newRow);

    let ultimaFila = table.rows[ultima_fila];
    ultimaFila.setAttribute('id', tr_id + '[' + nFilas + ']');
    ultimaFila.setAttribute('name', tr_id + '[' + nFilas + ']');

    ultimaFila.querySelectorAll("input, select, textarea, combobox").forEach((elem, nColumnas) => {
      nColumnas = parseInt(nColumnas) + 1;
      elem.setAttribute('name', inputs + '[' + nFilas + '][' + nColumnas + ']');
    });

    let fila = nFilas + 1;
    let lastRow = table.rows[table.rows.length - 1];
    lastRow.setAttribute('id', tr_id + '[' + fila + ']');
    lastRow.setAttribute('name', tr_id + '[' + fila + ']');

    lastRow.querySelectorAll("input, select, textarea, combobox").forEach((elem, nColumnas) => {
      let sc = elem.getAttribute('name');
      let nindex = sc.substring(sc.lastIndexOf("["));
      elem.setAttribute('name', inputs + '[' + fila + ']' + nindex);
    });

    let uno = 0;
    let value_checked = 0;
   
    newRow.querySelectorAll('select').forEach(select => {
      $(select).select2();
    });
   
   
   
    ultimaFila.querySelectorAll("input[type='radio']").forEach((input, nColumnas) => {
      if (uno == 0) {
        uno++;
        tomar_nombre = input.getAttribute('name');
        value_checked++;
      } else if (uno == 1) {
        input.setAttribute('name', tomar_nombre);
        value_checked++;
      }
      input.checked = false;
      input.value = value_checked;
    });
  }

  if (c_tipo_cuadro == 3) {
    let tr = table.rows[table.rows.length - 1];
    let nuevaFila = nFilas + 1;

    table.rows[table.rows.length - 1].querySelectorAll('select').forEach(select => {
      $(select).select2('destroy');
    });


    let newRow = tr.cloneNode(true);
    newRow.setAttribute('id', inputs + '[' + nFilas + ']');
    newRow.setAttribute('name', tr_id + '[' + nFilas + ']');

    newRow.querySelectorAll('button').forEach((button, nColumnas) => {
      button.setAttribute('onclick', 'eliminar_fila(' + cuadro + ',' + nFilas + ')');
    });
    
    newRow.querySelectorAll('td').forEach((td) => {
      td.removeAttribute('style');
      if (td.getAttribute('class') == 'error') {
        td.setAttribute('class', 'habilitada');
      }
    });
    
    newRow.querySelectorAll("input, select, textarea, combobox").forEach((elem, nColumnas) => {
      let nColumnas2 = table.rows[table.rows.length - 1].cells.length - 1;
      let id_viejo = parseInt(elem.getAttribute('id'));
      let id_nuevo = id_viejo + nColumnas2;
      let id_focus = id_nuevo + 1;
      nColumnas = parseInt(nColumnas) + 1;
      elem.setAttribute('id', id_nuevo);
      elem.setAttribute('name', inputs + '[' + nuevaFila + '][' + nColumnas + ']');
    });
    
    table.appendChild(newRow);
    newRow.querySelectorAll("input, select, textarea").forEach(elem => elem.value = '');
    
    let name_atri = document.querySelector('input:enabled:not([readonly]):first-child').getAttribute("name");
    let id = 0;
    
    table.querySelectorAll('input, select, textarea, combobox').forEach((elem, nColumnas) => {
      if (!elem.hasAttribute("readonly")) {
        id = id + 1;
        if (elem.getAttribute("name") != name_atri) {
          elem.setAttribute('id', id);
          elem.setAttribute('tabindex', id);
          id_anterior = elem.getAttribute('id');
          name_anterior = elem.getAttribute('name');
        } else {
          elem.setAttribute('id', id_anterior);
          elem.setAttribute('tabindex', id);
          elem.setAttribute('name', name_anterior);
        }
        name_atri = elem.getAttribute("name");
      }
    });

      // Inicializa Select2 en los elementos select de la fila clonada
  newRow.querySelectorAll('select').forEach(select => {
    $(select).select2();
  });
  }

  let inputsFocus = document.querySelectorAll("input, select, textarea");
  let ultimoInput = inputsFocus[inputsFocus.length -14];
  ultimoInput.focus();

}

document.addEventListener("keydown", function(event) {
  let letrasSalto = []; // Letras para saltar al siguiente input
  if (letrasSalto.includes(event.key.toLowerCase()) || event.keyCode === 9 || event.keyCode === 13) {
    event.preventDefault();
    let inputsFocus = document.querySelectorAll("input.focusNext:not(:disabled):not([readonly])" + ", input[type=radio][tabindex='" + (document.activeElement.tabIndex + 1) + "']:not(:checked)");
    let inputActual = document.activeElement;
    let indexActual = Array.from(inputsFocus).indexOf(inputActual);
    let indexSiguiente = (indexActual + 1) % inputsFocus.length;
    let inputSiguiente = inputsFocus[indexSiguiente];
    inputSiguiente.focus();
  }
});









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