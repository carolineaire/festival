//Toutes les fonctionnalité JS de l'application dans ce fichier

//SIDENAV
  // Fonction pour ouvrir le menu latéral
  function openNav() {
      document.getElementById("sideNav").classList.add("open");
      document.body.classList.add('side-nav-open');
    
      // Ajouter un écouteur d'événement pour fermer quand on clique en dehors
      document.addEventListener('mousedown', outsideClickListener);
    }
    
    // Fonction pour fermer le menu latéral
    function closeNav() {
      document.getElementById("sideNav").classList.remove("open");
      document.body.classList.remove('side-nav-open');
    
      // Supprimer l'écouteur d'événement une fois que le menu est fermé
      document.removeEventListener('mousedown', outsideClickListener);
    }
    
    // Fonction pour détecter le clic en dehors du menu
    function outsideClickListener(event) {
      const sideNav = document.getElementById("sideNav");
      const hamburgerIcon = document.querySelector(".navbar-toggler");
    
      // Si le clic a lieu en dehors du menu et en dehors de l'icône hamburger, fermer le menu
      if (!sideNav.contains(event.target) && !hamburgerIcon.contains(event.target)) {
        closeNav();
      }
    }
    
    // Fermer la side-nav par défaut lorsque la page est chargée
    window.onload = function() {
      closeNav(); // Assurez-vous que la side-nav est fermée au chargement de la page
    };
    
  

//COUNTDOWN pour caroussel
  // Définir la date de fin du compte à rebours
  var countDownDate = new Date("May 9, 2025 18:00:00").getTime();
  
  // Mettre à jour le compte à rebours toutes les secondes
  var countdownfunction = setInterval(function() {
      // Obtenir la date et l'heure actuelles
      var now = new Date().getTime();
  
      // Calculer la différence entre la date actuelle et la date de fin
      var distance = countDownDate - now;
  
      // Calculer les jours, heures, minutes et secondes restants
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);
  
      // Afficher le résultat dans l'élément avec l'ID "countdown"
      document.getElementById("countdown").innerHTML = days + "j " + hours + "h "
      + minutes + "m " + seconds + "s ";
  
      // Si le compte à rebours est terminé, afficher un message
      if (distance < 0) {
          clearInterval(countdownfunction);
          document.getElementById("countdown").innerHTML = "Le festival a commencé!";
      }
  }, 1000);
  


//TOOLTIP : Message au survol pour programmation et boutiqu en ligne
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })


  
//Programmation affichage des descriptions
function setupArtistDescriptions() {
  const avatars = document.querySelectorAll('.artist-avatar');
  const allInfos = document.querySelectorAll('.artist-info');

  if (avatars.length === 0 || allInfos.length === 0) {
      console.error('Les éléments .artist-avatar ou .artist-info sont introuvables.');
      return;
  }

  avatars.forEach((avatar, index) => {
      avatar.addEventListener('click', function() {
          const info = allInfos[index];

          // Masquer toutes les descriptions sauf celle cliquée
          allInfos.forEach((info, i) => {
              if (i !== index) {
                  info.classList.remove('active');
              }
          });

          // Afficher ou masquer la description cliquée
          info.classList.toggle('active');
      });
  });
}

function initializeArtistDescriptions() {
  document.addEventListener('DOMContentLoaded', setupArtistDescriptions);
  document.addEventListener('turbolinks:load', setupArtistDescriptions);
  setupArtistDescriptions(); // Appel immédiat pour s'assurer que les descriptions sont configurées sans rechargement
}

initializeArtistDescriptions();


//JavaScript pour l'affichage des commentaires
  // Commentaires : affichage du formulaire de commentaire
  document.getElementById('toggle-comment-form').addEventListener('click', function() {
    var formContainer = document.getElementById('comment-form-container');
    formContainer.style.display = formContainer.style.display === 'none' || formContainer.style.display === '' ? 'block' : 'none';
  });

  // Commentaires : affichage des commentaires déjà postés
  document.getElementById('toggle-comment').addEventListener('click', function() {
    var commentsContainer = document.getElementById('comments-container');
    commentsContainer.style.display = commentsContainer.style.display === 'none' || commentsContainer.style.display === '' ? 'block' : 'none';
  });