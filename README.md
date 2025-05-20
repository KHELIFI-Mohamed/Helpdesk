# Projet Helpdesk 

## Description du projet

Le projet consiste à développer un logiciel de demande d’assistance (Helpdesk) en PHP, destiné à un usage interne . Ce logiciel vise à faciliter la gestion des demandes d’assistance des utilisateurs tout en fournissant à l’équipe technique un outil clair, structuré et efficace pour le traitement des tickets.

---

## Fonctionnalités principales

- **Interface utilisateur**  
  Permet la création de tickets d’assistance via un formulaire dédié.

- **Interface technicien**  
  Accessible uniquement à l’équipe support via authentification sécurisée, elle permet de consulter, suivre et gérer les tickets.

- **Cycle de vie des tickets**  
  - **Ouvert** : ticket créé par un utilisateur.  
  - **En cours** : ticket pris en charge par un technicien.  
  - **Fermé** : ticket résolu.

Lors de la soumission, l’utilisateur devra renseigner les informations nécessaires à la bonne gestion de l’incident (à définir selon les besoins). Un numéro de ticket unique sera automatiquement attribué à chaque demande.

L’accès à l’interface de gestion des tickets est sécurisé : les techniciens devront obligatoirement s’identifier via un système htaccess/htpasswd, afin de garantir la confidentialité et la sécurité des données.

Le logiciel intégre les fonctionnalités suivantes :

- Une page d’accueil claire et intuitive.[page d'accueil](https://github.com/KHELIFI-Mohamed/Helpdesk/blob/main/index.php)

- Une page de demande d’assistance permettant aux utilisateurs de soumettre un ticket.[page d'assistance](https://github.com/KHELIFI-Mohamed/Helpdesk/blob/main/assistance.php)

- Un panneau de gestion des tickets, listant l’ensemble des demandes avec leur statut visuellement identifiable par couleur (ouvert, en cours, fermé).[ticket](https://github.com/KHELIFI-Mohamed/Helpdesk/blob/main/techn.php)

- Une page de consultation de ticket, permettant d’accéder aux détails d’un ticket et de le modifier.[ticket](https://github.com/KHELIFI-Mohamed/Helpdesk/blob/main/techn.php)

- Une mise en page soignée utilisant CSS pour un rendu propre et professionnel.

- La mise en place d’un système de log, permettant d’enregistrer les actions importantes (création, modification de tickets, etc.).

- Un système de connexion via htaccess/htpasswd

- Un système de log 





