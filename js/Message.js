    
    (function() {
        'use strict';
        window.addEventListener('load', function() {
          // Get the forms we want to add validation styles to
          var forms = document.getElementsByClassName('needs-validation');
          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
  
  /**
     * Codons un chat en HTML/CSS/Javascript avec nos amis PHP et MySQL
     */
  
    /**
     * Il nous faut une fonction pour récupérer le JSON des
     * messages et les afficher correctement
     */
     function doGetMessages(){
      // 1. Elle doit créer une requête AJAX pour se connecter au serveur, et notamment au fichier handler.php
      const requeteAjax = new XMLHttpRequest();
      requeteAjax.open("GET", "server/handler.php");
  
      // 2. Quand elle reçoit les données, il faut qu'elle les traite (en exploitant le JSON) et il faut qu'elle affiche ces données au format HTML
      requeteAjax.onload = function(){
        const resultat = JSON.parse(requeteAjax.responseText);
        const html = resultat.reverse().map(function(message){
          
            
            
          return `<div class="card p-3 mt-2">
              <div class="d-flex justify-content-between align-items-center">
                  <div class="user d-flex flex-row align-items-center"> <img src="images/Avatar_masculin_3.png" width="30" class="user-img rounded-circle mr-2"> <span><small class="font-weight-bold text-primary">${message.author}</small> <small class="font-weight-bold">${message.created_at.substring(11, 16)} </small></span> </div> <small> ${message.content} </small>
              </div>
            </div>
          `
        }).join('');
        const messages = document.querySelector('.messages');
  
        messages.innerHTML = html;
        messages.scrollTop = messages.scrollHeight;
      }
  
      // 3. On envoie la requête
      requeteAjax.send();
    }
  
    /**
     * Il nous faut une fonction pour envoyer le nouveau
     * message au serveur et rafraichir les messages
     */
  
    function doPostMessage(event, user){
      // 1. Elle doit stoper le submit du formulaire
      event.preventDefault();
  
      // 2. Elle doit récupérer les données du formulaire
      const author = document.querySelector('#author');
      if (user == "") {
        my_author = author.value;
      }else {
        my_author = user;
      }
      const content = document.querySelector('#content');
      // 3. Elle doit conditionner les données
      const data = new FormData();
      data.append('author', my_author);
      //data.append('config', config.value);
      data.append('content', content.value);
  
      // 4. Elle doit configurer une requête ajax en POST et envoyer les données
      const requeteAjax = new XMLHttpRequest();
      requeteAjax.open('POST', 'server/handler.php?task=write');
      
      requeteAjax.onload = function(){
        content.value = '';
        content.focus();
        doGetMessages();
      }
  
      requeteAjax.send(data);
  
      requeteAjax.onload = function () {
        const result = requeteAjax.responseText;
        const M = document.querySelector('#result');
  
        M.innerHTML += result;
      }
    }
  
  
  
    console.log("fuck javascript mother fucker")
    let USER = document.getElementById('content').getAttribute('data-user');
    document.querySelector('#from-comment').addEventListener('submit', doPostMessage(USER));
  
    /**
     * Il nous faut une intervale qui demande le rafraichissement
     * des messages toutes les 3 secondes et qui donne 
     * l'illusion du temps réel.
     */
    const interval = window.setInterval(getMessages, 3000);
    doGetMessages();  
  