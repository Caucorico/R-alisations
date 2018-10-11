#include <stddef.h>
#include <stdlib.h>
#include <stdio.h>
#include "data.h"
#include "gest_struct.h"

struct liste_usine * creer_liste_usine ( struct usine * usine )
{
  struct liste_usine * liste;
  liste = malloc( sizeof( struct liste_usine ) );
  liste->usine = usine;
  liste->next = NULL;
  return liste;
}

struct liste_usine * ajouter_usine ( struct liste_usine * liste , struct usine * usine )
{
  struct liste_usine * first = liste;

  if ( liste == NULL )
  {
    liste = creer_liste_usine( usine );
    return liste;
  }

  while ( liste->next != NULL ) liste = liste->next;
  liste->next = malloc( sizeof( struct liste_usine ) );
  liste->next->usine = usine;
  liste->next->next = NULL;
  return first;
}

void supprimer_liste_usine ( struct liste_usine * liste )
{
  struct liste_usine * buffer;
  while ( liste->next != NULL )
  {
    buffer = liste;
    liste = liste->next;
    free(buffer);
  }
  free(liste);
}

void afficher_liste_usine ( struct liste_usine * liste )
{
  while ( liste->next != NULL )
  {
    printf("Usine : \n");
    afficher_liste_machine( liste->usine->liste_machine );
    liste = liste->next;
  }
  printf("Usine : \n");
  afficher_liste_machine( liste->usine->liste_machine );
}

struct liste_machine * creer_liste_machine ( struct machine * machine )
{
  struct liste_machine * liste;
  liste = malloc( sizeof( struct liste_machine ) );
  liste->machine = machine;
  liste->next = NULL;
  return liste;
}

struct liste_machine * ajouter_machine ( struct liste_machine * liste, struct machine * machine )
{
  struct liste_machine * first = liste;

  if ( liste == NULL )
  {
    liste = creer_liste_machine( machine );
    return liste;
  }

  while ( liste->next != NULL ) liste = liste->next;
  liste->next = malloc ( sizeof( struct liste_machine ) );
  liste->next->machine = machine;
  liste->next->next = NULL;
  return first;

}

void supprimer_liste_machine ( struct liste_machine * liste )
{
  struct liste_machine * buffer;

  while ( liste->next != NULL )
  {
    buffer = liste;
    liste = liste->next;
    free( buffer );
  }
  free ( liste );
}

void afficher_liste_machine ( struct liste_machine * liste )
{
  while ( liste->next != NULL )
  {
    printf("Machine ( type: %c )\n",liste->machine->type );
    printf("Opérateur : %ld sur %ld \n", liste->machine->nb_operateur_1x8h, liste->machine->nb_operateur_n_1x8h );
    printf("Opérateur temps plein : %ld sur %ld \n", liste->machine->nb_operateur_temps_plein, liste->machine->nb_operateur_n_temps_plein );
    printf("Opérateur temps partiel : %ld sur %ld \n", liste->machine->nb_operateur_temps_partiel, liste->machine->nb_operateur_n_temps_partiel );
    printf("Polyvalent : %ld sur %ld \n", liste->machine->nb_polyvalent_1x8h, liste->machine->nb_polyvalent_n_1x8h );
    printf("Polyvalent temps plein : %ld sur %ld \n", liste->machine->nb_polyvalent_temps_plein, liste->machine->nb_polyvalent_n_temps_plein );
    printf("Polyvalent temps partiel : %ld sur %ld \n", liste->machine->nb_polyvalent_temps_partiel, liste->machine->nb_polyvalent_n_temps_partiel );
    afficher_liste_employe( liste->machine->liste_employe );
    liste = liste->next;
  }
  printf("Machine ( type: %c )\n",liste->machine->type );
  printf("Opérateur : %ld sur %ld \n", liste->machine->nb_operateur_1x8h, liste->machine->nb_operateur_n_1x8h );
  printf("Opérateur temps plein : %ld sur %ld \n", liste->machine->nb_operateur_temps_plein, liste->machine->nb_operateur_n_temps_plein );
  printf("Opérateur temps partiel : %ld sur %ld \n", liste->machine->nb_operateur_temps_partiel, liste->machine->nb_operateur_n_temps_partiel );
  printf("Polyvalent : %ld sur %ld \n", liste->machine->nb_polyvalent_1x8h, liste->machine->nb_polyvalent_n_1x8h );
  printf("Polyvalent temps plein : %ld sur %ld \n", liste->machine->nb_polyvalent_temps_plein, liste->machine->nb_polyvalent_n_temps_plein );
  printf("Polyvalent temps partiel : %ld sur %ld \n", liste->machine->nb_polyvalent_temps_partiel, liste->machine->nb_polyvalent_n_temps_partiel );
  afficher_liste_employe( liste->machine->liste_employe );
}

struct liste_employe * creer_liste_employe( struct employe * employe )
{
  struct liste_employe * liste;
  liste = malloc( sizeof( struct liste_employe ) );
  liste->employe = employe;
  liste->next = NULL;
  return liste;
}

struct liste_employe * ajouter_employe ( struct liste_employe * liste, struct employe * employe )
{
  struct liste_employe * first = liste;
  if ( liste == NULL )
  {
    liste = creer_liste_employe( employe );
    return liste;
  }

  while( liste->next != NULL ) liste = liste->next;
  liste->next = malloc( sizeof( struct liste_employe ) );
  liste->next->employe = employe;
  liste->next->next = NULL;
  return first;
}

void supprimer_liste_employe ( struct liste_employe * liste )
{
  struct liste_employe * buffer;

  while ( liste->next != NULL )
  {
    buffer = liste;
    liste = liste->next;
    free(buffer);
  }
  free(liste);
}

void afficher_liste_employe ( struct liste_employe * liste )
{
  while ( liste->next != NULL )
  {
    printf("Employé( type : %c )\n", liste->employe->type);
    liste = liste->next;
  }
  printf("Employé( type : %c )\n", liste->employe->type);
}

struct liste_pdv * creer_liste_pdv ( struct point_de_vente * point_de_vente )
{
  struct liste_pdv * liste;

  liste = malloc( sizeof( struct liste_pdv ) );
  liste->point_de_vente = point_de_vente;
  liste->next = NULL;

  return liste;
}

struct liste_pdv * ajouter_pdv ( struct liste_pdv * liste, struct point_de_vente * point_de_vente )
{
  struct liste_pdv * first = liste;

  if ( liste == NULL )
  {
    liste = creer_liste_pdv( point_de_vente );
    return liste;
  }

  while ( liste->next != NULL ) liste = liste->next;
  liste->next = malloc( sizeof( struct liste_pdv ) );
  liste->next->point_de_vente = point_de_vente;
  liste->next->next = NULL;
  return first;
}

void supprimer_liste_pdv( struct liste_pdv * liste )
{
  struct liste_pdv * buffer;

  while ( liste->next != NULL )
  {
    buffer = liste;
    liste = liste->next;
    free(buffer);
  }

  free(liste);
}