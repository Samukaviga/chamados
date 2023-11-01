
function checkboxConcluido(checkbox, $id_usuario, $titulo) 
{
   if (checkbox.checked) {
         console.log('Checkbox marcado', $id_usuario, $titulo);

         // Fazer uma solicitação AJAX para atualizar o banco de dados
         var xhttp = new XMLHttpRequest();
         xhttp.onreadystatechange = function() {
             if (this.readyState == 4 && this.status == 200) {
                 console.log(this.responseText);
             }
         };
         xhttp.open("POST", "./js/concluido_checkbox_if.php?id_usuario=" + $id_usuario + "&titulo=" + $titulo, true);
         xhttp.send();

         checkbox.setAttribute('checked', 'checked');
     } else {
       console.log('Checkbox desmarcado', $id_usuario, $titulo);

       // Fazer uma nova solicitação AJAX para atualizar o banco de dados com os mesmos dados
       var xhttp = new XMLHttpRequest();
       xhttp.onreadystatechange = function() {
           if (this.readyState == 4 && this.status == 200) {
               console.log(this.responseText);
           }
       };
       xhttp.open("POST", "./js/concluido_checkbox_else.php?id_usuario=" + $id_usuario + "&titulo=" + $titulo, true);
       xhttp.send();

       checkbox.removeAttribute('checked');
     }
}

 // Script Prioridade checkbox  


 function checkboxPrioridade(checkbox, $id_chamado, $titulo) 
{
   if (checkbox.checked) {
         console.log('Checkbox marcado', $id_chamado, $titulo);

         // Fazer uma solicitação AJAX para atualizar o banco de dados
         var xhttp = new XMLHttpRequest();
         xhttp.onreadystatechange = function() {
             if (this.readyState == 4 && this.status == 200) {
                 console.log(this.responseText);
             }
         };
         xhttp.open("POST", "./js/prioridade_checkbox_if.php?id_usuario=" + $id_chamado + "&titulo=" + $titulo, true);
         xhttp.send();

         checkbox.setAttribute('checked', 'checked');
     } else {
       console.log('Checkbox desmarcado', $id_chamado, $titulo);

       // Fazer uma nova solicitação AJAX para atualizar o banco de dados com os mesmos dados
       var xhttp = new XMLHttpRequest();
       xhttp.onreadystatechange = function() {
           if (this.readyState == 4 && this.status == 200) {
               console.log(this.responseText);
           }
       };
       xhttp.open("POST", "./js/prioridade_checkbox_else.php?id_usuario=" + $id_chamado + "&titulo=" + $titulo, true);
       xhttp.send();

       checkbox.removeAttribute('checked');
     }
 }