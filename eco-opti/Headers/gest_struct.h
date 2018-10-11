#ifndef GEST_STRUCT
#define GEST_STRUCT

/* Créer une liste d'usine */
struct liste_usine * creer_liste_usine ( struct usine * usine );

/* Ajoute une usine à la liste ou créer la liste si elle  est vide. */
struct liste_usine * ajouter_usine ( struct liste_usine * liste , struct usine * usine );

/* Supprime la liste */
void supprimer_liste_usine ( struct liste_usine * liste );

/* Affiche la liste des usines. */
void afficher_liste_usine ( struct liste_usine * liste );

/* Créer une liste de machine */
struct liste_machine * creer_liste_machine ( struct machine * machine );

/* Ajoute une machine a la liste ou creer la liste si elle est vide. */
struct liste_machine * ajouter_machine ( struct liste_machine * liste, struct machine * machine );

/* Supprime la liste */
void supprimer_liste_machine ( struct liste_machine * liste );

/* Affiche la liste des machines */
void afficher_liste_machine ( struct liste_machine * liste );

/* Créer une liste d'employe */
struct liste_employe * creer_liste_employe( struct employe * employe );

/* Ajoute un employe a la liste oui creer la liste si elle est vide. */
struct liste_employe * ajouter_employe ( struct liste_employe * liste, struct employe * employe );

/* Supprime la liste */
void supprimer_liste_employe ( struct liste_employe * liste );

/* Affiche la liste des employés. */
void afficher_liste_employe ( struct liste_employe * liste );

/* Créer une liste de point de vente */
struct liste_pdv * creer_liste_pdv ( struct point_de_vente * point_de_vente );

/* Ajoute un point de vente a la liste ou la créer si elle est vide. */
struct liste_pdv * ajouter_pdv ( struct liste_pdv * liste, struct point_de_vente * point_de_vente );

/* Supprime la liste */
void supprimer_liste_pdv( struct liste_pdv * liste );

#endif