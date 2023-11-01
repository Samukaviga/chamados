  // Seleciona o elemento com o ID "aberto"
  var elementoAberto = document.getElementById("aberto");

  // Adiciona o evento de clique ao elemento
  elementoAberto.addEventListener("click", handleClick);

  function handleClick(id_chamado, $tipo) {

   if($tipo != 9){
     // Fazer uma solicitação AJAX para atualizar o banco de dados
     var xhttp = new XMLHttpRequest();
     xhttp.onreadystatechange = function() {
         if (this.readyState == 4 && this.status == 200) {
             console.log(this.responseText);
         }
     };
     xhttp.open("POST", "./js/adicionandoEmAberto.php?id_chamado=" + id_chamado, true);
     xhttp.send();
 
     // Exemplo: exibir o ID do chamado no console
     console.log('ID do chamado:', id_chamado);
   }
   
}