# Phones #

## /api/phones ##

### `GET` /api/phones ###

_Consulter la liste des mobiles._


## /api/phones/{id} ##

### `GET` /api/phones/{id} ###

_Consulter le détail d’un mobile._

#### Requirements ####

**id**

  - Type: integer
  - Description: Identifiant unique du mobile.



# Users #

## /api/users ##

### `GET` /api/users ###

_Consulter la liste des utilisateurs inscrits liés à un client._


### `POST` /api/users ###

_Création d’un utilisateur lié à un client._


## /api/users/{id} ##

### `DELETE` /api/users/{id} ###

_Supprimer un utilisateur inscrit lié à un client._

#### Requirements ####

**id**

  - Type: integer
  - Description: Identifiant unique de l'utilisateur.


### `GET` /api/users/{id} ###

_Consulter le détail d’un utilisateur inscrit lié à un client._

#### Requirements ####

**id**

  - Type: integer
  - Description: Identifiant unique de l'utilisateur.
