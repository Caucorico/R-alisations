#include <stdio.h>
#include <stdlib.h>
#include <stddef.h>
#include "data.h"
#include "calc.h"
#include "gest_struct.h"

int main(void)
{
  struct entreprise entreprise;
  struct point_de_vente pdv_gms;
  struct point_de_vente pdv_excentre;
  struct point_de_vente pdv_centre_ville;
  struct usine usine;
  struct machine machine2;
  long total_production;
  long total_depenses;
  long ca;

  entreprise.tresorerie = 300000000;
  entreprise.liste_pdv = NULL;
  entreprise.liste_usine = NULL;

  init_pdv_gms( &pdv_gms );
  /* acheter_pdv( &entreprise, &pdv_gms ); */

  init_pdv_centre_ville( &pdv_centre_ville );
  acheter_pdv(&entreprise, &pdv_centre_ville);

  init_pdv_centre_ville( &pdv_excentre );
  acheter_pdv(&entreprise, &pdv_excentre);

  init_usine( &usine, 0 );
  acheter_usine( &entreprise, &usine );
  init_machine2( &machine2 );
  acheter_machine( &entreprise, &usine, &machine2 );
  recruter_necessaire_machine( &machine2 );

  afficher_liste_usine( entreprise.liste_usine );

  total_production = obtenir_total_production_semestre( &entreprise );
  printf ( "Total production : %ld gâteaux \n", total_production );

  total_depenses = obtenir_total_depense_semestre( &entreprise );
  printf ( "Total dépenses : %ld euros ( x1000 ) \n", total_depenses );

  ca = obtenir_chiffre_affaires_entreprise( &entreprise );
  printf( " Chiffre d'affaires : %ld (x1000) \n", ca );

  return 0;
}