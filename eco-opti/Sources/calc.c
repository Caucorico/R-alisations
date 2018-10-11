#include <stddef.h>
#include <stdlib.h>
#include <stdio.h>
#include "data.h"
#include "calc.h"
#include "gest_struct.h"

void acheter_usine ( struct entreprise * entreprise, struct usine * usine )
{
  entreprise->capital = entreprise->capital - usine->prix;
  entreprise->liste_usine = ajouter_usine( entreprise->liste_usine, usine );
  recruter_gerant( usine );
}

void recruter_gerant( struct usine * usine )
{
  struct employe * gerant;

  gerant = malloc( sizeof( struct employe ) );
  init_gerant( gerant );
  usine->gerant = gerant;
}

void acheter_machine ( struct entreprise * entreprise, struct usine * usine, struct machine * machine )
{
  entreprise->capital -= machine->cout;
  usine->liste_machine = ajouter_machine( usine->liste_machine ,machine );
}

void recruter_employe ( struct machine * machine, struct employe * employe )
{
  machine->liste_employe = ajouter_employe( machine->liste_employe, employe );
}

void acheter_pdv ( struct entreprise * entreprise , struct point_de_vente * point_de_vente )
{
  entreprise->capital -= point_de_vente->prix_de_vente;
  entreprise->liste_pdv = ajouter_pdv ( entreprise->liste_pdv, point_de_vente );
}

void recruter_necessaire_machine ( struct machine * machine )
{
  long i;
  struct employe * employe;

  for ( i = 0 ; i < machine->nb_operateur_n_temps_plein ; i++ )
  {
    employe = malloc( sizeof( struct employe ) );
    init_operateur ( employe, 0 );
    machine->liste_employe = ajouter_employe( machine->liste_employe, employe);
    machine->nb_operateur_1x8h++;
    machine->nb_operateur_temps_plein++;
  }
  for ( i = 0 ; i < machine->nb_operateur_n_temps_partiel ; i++ )
  {
    employe = malloc( sizeof( struct employe ) );
    init_operateur ( employe, 1 );
    machine->liste_employe = ajouter_employe( machine->liste_employe, employe);
    machine->nb_operateur_1x8h++;
    machine->nb_operateur_temps_partiel++;
  }
  for ( i = 0 ; i < machine->nb_polyvalent_n_temps_plein ; i++ )
  {
    employe = malloc( sizeof( struct employe ) );
    init_polyvalent ( employe, 0 );
    machine->liste_employe = ajouter_employe( machine->liste_employe, employe);
    machine->nb_polyvalent_1x8h++;
    machine->nb_polyvalent_temps_plein++;
  }
  for ( i = 0 ; i < machine->nb_polyvalent_n_temps_partiel ; i++ )
  {
    employe = malloc( sizeof( struct employe ) );
    init_polyvalent ( employe, 1 );
    machine->liste_employe = ajouter_employe( machine->liste_employe, employe);
    machine->nb_polyvalent_1x8h++;
    machine->nb_polyvalent_temps_partiel++;
  }

}

long obtenir_production_semestriel_machine ( struct machine * machine )
{
  unsigned char test = 0;

  if( machine->nb_operateur_n_1x8h != machine->nb_operateur_1x8h )
    test |= 1;

  if ( machine->nb_operateur_n_temps_plein != machine->nb_operateur_temps_plein )
    test |= 1;

  if ( machine->nb_operateur_n_temps_partiel != machine->nb_operateur_temps_partiel )
    test |= 1;

  if ( machine->nb_polyvalent_n_1x8h != machine->nb_polyvalent_1x8h )
    test |= 1;

  if ( machine->nb_polyvalent_n_temps_plein != machine->nb_polyvalent_temps_plein )
    test |= 1;

  if ( machine->nb_polyvalent_n_temps_partiel != machine->nb_polyvalent_temps_partiel )
    test |= 1;

  if ( test )
  {
    return 0;
  }
  else
  {
    return machine->production_1x8h;
  }
}

long obtenir_total_production_semestre( struct entreprise * entreprise )
{
  struct liste_usine * liste_usine = entreprise->liste_usine;
  struct liste_machine * liste_machine;
  long production = 0;

  while ( liste_usine->next != NULL )
  {
    liste_machine = liste_usine->usine->liste_machine;
    while ( liste_machine->next != NULL )
    {
      production += obtenir_production_semestriel_machine( liste_machine->machine );
      liste_machine = liste_machine->next;
    }
    production += obtenir_production_semestriel_machine( liste_machine->machine );
  }
  liste_machine = liste_usine->usine->liste_machine;
    while ( liste_machine->next != NULL )
    {
      production += obtenir_production_semestriel_machine( liste_machine->machine );
      liste_machine = liste_machine->next;
    }
    production += obtenir_production_semestriel_machine( liste_machine->machine );

  return production;

}

long obtenir_couts_matieres_premieres ( long gateaux_produits )
{
  struct beurre infos_beurre;
  struct sucre infos_sucre;
  struct farine infos_farine;
  struct oeuf infos_oeuf;
  long kg_gateaux = gateaux_produits/40;
  long quart_kg_gateaux;
  long depenses = 0;
  printf("gateaux_produits : %ld \n", gateaux_produits);
  printf("kg_gateaux_produits : %ld \n", kg_gateaux);

  init_beurre( &infos_beurre );
  init_sucre( &infos_sucre );
  init_farine( &infos_farine );
  init_oeuf( &infos_oeuf );

  quart_kg_gateaux = kg_gateaux / 4;
  if ( kg_gateaux%4 != 0 ) quart_kg_gateaux+=1;

  depenses += ( quart_kg_gateaux * infos_beurre.prix_kg );
  depenses += ( quart_kg_gateaux * infos_sucre.prix_kg );
  depenses += ( quart_kg_gateaux * infos_farine.prix_kg );
  depenses += ( quart_kg_gateaux * infos_oeuf.prix_kg );

  return depenses;

}

long obtenir_total_depenses_semestre_liste_employe( struct liste_employe * liste )
{
  long depenses = 0;

  while ( liste->next != NULL )
  {
    depenses += ( liste->employe->max_heure_semestre * liste->employe->salaire_heure_poste );
    liste = liste->next;
  }
  depenses += ( liste->employe->max_heure_semestre * liste->employe->salaire_heure_poste );

  return depenses;
}

long obtenir_total_depense_electricite_machine ( long gateau_produits, long conso_kwh_kg )
{
  long kg_gateaux_produits = gateau_produits/40;
  long mwh_conso;
  struct electricite infos_electricite;

  init_electricite( &infos_electricite );

  mwh_conso = ( kg_gateaux_produits*conso_kwh_kg )/1000;
  printf("Mwh conso : %ld \n", mwh_conso);

  return (infos_electricite.cout_mwh * mwh_conso);


}

long obtenir_total_depenses_semestre_liste_machine ( struct liste_machine * liste )
{
  long depenses = 0;
  long gateau_produits = 0;

  while ( liste->next != NULL )
  {
    depenses += obtenir_total_depenses_semestre_liste_employe( liste->machine->liste_employe );
    
    gateau_produits = obtenir_production_semestriel_machine( liste->machine );
    printf("%ld , %ld , %ld \n",gateau_produits, liste->machine->nb_max_moulage_reparation, liste->machine->prix_reparation_moulage);
    depenses += ( ( gateau_produits / liste->machine->nb_max_moulage_reparation ) * liste->machine->prix_reparation_moulage );
    printf("test2\n");
    depenses += obtenir_couts_matieres_premieres( gateau_produits );
    printf("test3\n");
    depenses += obtenir_total_depense_electricite_machine( gateau_produits , liste->machine->consomation_kwh );

    liste = liste->next;
  }
  depenses += obtenir_total_depenses_semestre_liste_employe( liste->machine->liste_employe );
  depenses += ( ( gateau_produits / liste->machine->nb_max_moulage_reparation ) * liste->machine->prix_reparation_moulage );
  gateau_produits = obtenir_production_semestriel_machine( liste->machine );
  depenses += obtenir_couts_matieres_premieres( gateau_produits );
  depenses += obtenir_total_depense_electricite_machine( gateau_produits , liste->machine->consomation_kwh );

  return depenses;
}


long obtenir_total_depense_semestre ( struct entreprise * entreprise )
{
  long depenses = 0;
  struct liste_usine * liste_usine = entreprise->liste_usine;
  struct employe * gerant;

  while ( liste_usine->next != NULL )
  {
    depenses += obtenir_total_depenses_semestre_liste_machine( liste_usine->usine->liste_machine );
  

    gerant = liste_usine->usine->gerant;

    depenses += ( gerant->salaire_heure_poste * gerant->max_heure_semestre);

    liste_usine = liste_usine->next;
  }
  depenses += obtenir_total_depenses_semestre_liste_machine( liste_usine->usine->liste_machine );
  
  gerant = liste_usine->usine->gerant;
  depenses += ( gerant->salaire_heure_poste * gerant->max_heure_semestre);
  return depenses;
}

long obtenir_chiffre_affaires_entreprise ( struct entreprise * entreprise )
{
  struct liste_pdv * liste_pdv;
  long ca = 0;

  liste_pdv = entreprise->liste_pdv;

  while ( liste_pdv->next != NULL )
  {
    ca += ( liste_pdv->point_de_vente->prix_de_vente * liste_pdv->point_de_vente->qtte_vendable );

    liste_pdv = liste_pdv->next;
  }

  ca += ( liste_pdv->point_de_vente->prix_de_vente * liste_pdv->point_de_vente->qtte_vendable );

  return ca;
}