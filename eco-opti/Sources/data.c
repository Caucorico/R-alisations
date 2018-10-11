#include <stddef.h>
#include <stdlib.h>
#include "data.h"

void init_machine1( struct machine * machine )
{
  machine->type = '1';
  machine->cout = 22000000; /* x1000 */
  machine->production_1x8h = 1000000;
  machine->nb_operateur_n_1x8h = 3;
  machine->nb_operateur_n_temps_plein = 3;
  machine->nb_operateur_n_temps_partiel = 0;
  machine->nb_polyvalent_n_1x8h = 1;
  machine->nb_polyvalent_n_temps_plein = 1;
  machine->nb_polyvalent_n_temps_partiel = 0;
  machine->nb_operateur_1x8h = 0;
  machine->nb_operateur_temps_plein = 0;
  machine->nb_operateur_temps_partiel = 0;
  machine->nb_polyvalent_1x8h = 0;
  machine->nb_polyvalent_temps_plein = 0;
  machine->nb_polyvalent_temps_partiel = 0;
  machine->consomation_kwh = 2;
  machine->duree_de_vie_max_annee = 8;
  machine->duree_de_vie_restante_annee = 8;
  machine->nb_max_moulage_reparation = 250000;
  machine->prix_reparation_moulage = 1000000; /* x1000 */
  machine->liste_employe = NULL;
}

void init_machine2( struct machine * machine )
{
  machine->type = '2';
  machine->cout = 34000000; /* x1000 */
  machine->production_1x8h = 2000000;
  machine->nb_operateur_n_1x8h = 4;
  machine->nb_operateur_n_temps_plein = 4;
  machine->nb_operateur_n_temps_partiel = 0;
  machine->nb_polyvalent_n_1x8h = 2;
  machine->nb_polyvalent_n_temps_plein = 1;
  machine->nb_polyvalent_n_temps_partiel = 1;
  machine->nb_operateur_1x8h = 0;
  machine->nb_operateur_temps_plein = 0;
  machine->nb_operateur_temps_partiel = 0;
  machine->nb_polyvalent_1x8h = 0;
  machine->nb_polyvalent_temps_plein = 0;
  machine->nb_polyvalent_temps_partiel = 0;
  machine->consomation_kwh = 2;
  machine->duree_de_vie_max_annee = 8;
  machine->duree_de_vie_restante_annee = 8;
  machine->nb_max_moulage_reparation = 250000;
  machine->prix_reparation_moulage = 1000000; /* x1000 */
  machine->liste_employe = NULL;
}

void init_machine3( struct machine * machine )
{
  machine->type = '3';
  machine->cout = 53000000; /* x1000 */
  machine->production_1x8h = 3000000;
  machine->nb_operateur_n_1x8h = 5;
  machine->nb_operateur_n_temps_plein = 5;
  machine->nb_operateur_n_temps_partiel = 0;
  machine->nb_polyvalent_n_1x8h = 2;
  machine->nb_polyvalent_n_temps_plein = 2;
  machine->nb_polyvalent_n_temps_partiel = 0;
  machine->nb_operateur_1x8h = 0;
  machine->nb_operateur_temps_plein = 0;
  machine->nb_operateur_temps_partiel = 0;
  machine->nb_polyvalent_1x8h = 0;
  machine->nb_polyvalent_temps_plein = 0;
  machine->nb_polyvalent_temps_partiel = 0;
  machine->consomation_kwh = 2;
  machine->duree_de_vie_max_annee = 8;
  machine->duree_de_vie_restante_annee = 8;
  machine->nb_max_moulage_reparation = 250000;
  machine->prix_reparation_moulage = 1000000; /* x1000 */
  machine->liste_employe = NULL;
}

void init_usine( struct usine * usine, unsigned char location )
{
  usine->location = location;
  usine->loyer_mensuel = 3000000; /* x1000 */
  usine->prix = 150000000; /* x1000 */
  usine->ligne_fabrication_max = 3;
  usine->duree_de_vie_max_annee = 10;
  usine->duree_de_vie_restante_annee = 10;
  usine->heure_max_jour = 24;
  usine->max_jours_annee = 280;
  usine->liste_machine = NULL;
  usine->gerant = NULL;
}

void init_vendeur( struct employe * employe, unsigned char temps_partiel )
{
  employe->type = 'V';
  employe->interimaire = 0;
  employe->partiel = temps_partiel;
  employe->salaire_heure = 20000; /* x1000 */
  employe->salaire_heure_poste = 20000; /* x1000 */
  employe->heure_max_jour = 8;
  employe->max_heure_semestre = 850;
  employe->cout_licenciement = 15000000; /* x1000 */
}

void init_operateur( struct employe * employe, unsigned char temps_partiel )
{
  employe->type = 'O';
  employe->interimaire = 0;
  employe->partiel = temps_partiel;
  employe->salaire_heure = 20000; /* x1000 */
  employe->salaire_heure_poste = 25000; /* x1000 */
  employe->heure_max_jour = 8;
  employe->max_heure_semestre = 850;
  employe->cout_licenciement = 15000000; /* x1000 */
}

void init_polyvalent( struct employe * employe, unsigned char temps_partiel )
{
  employe->type = 'P';
  employe->interimaire = 0;
  employe->partiel = temps_partiel;
  employe->salaire_heure = 25000; /* x1000 */
  employe->salaire_heure_poste = 30000; /* x1000 */
  employe->heure_max_jour = 8;
  employe->max_heure_semestre = 850;
  employe->cout_licenciement = 15000000; /* x1000 */
}

void init_operateur_interimaire( struct employe * employe, unsigned char temps_partiel )
{
  employe->type = 'O';
  employe->interimaire = 1;
  employe->partiel = temps_partiel;
  employe->salaire_heure = 37500; /* x1000 */
  employe->salaire_heure_poste = 46900; /* x1000 */
  employe->heure_max_jour = 8;
  employe->max_heure_semestre = 850;
  employe->cout_licenciement = 0; /* x1000 */
}

void init_vendeur_interimaire( struct employe * employe, unsigned char temps_partiel )
{
  employe->type = 'V';
  employe->interimaire = 1;
  employe->partiel = temps_partiel;
  employe->salaire_heure = 37500; /* x1000 */
  employe->salaire_heure_poste = 46900; /* x1000 */
  employe->heure_max_jour = 8;
  employe->max_heure_semestre = 850;
  employe->cout_licenciement = 0; /* x1000 */
}

void init_gerant( struct employe * employe)
{
  employe->type = 'G';
  employe->interimaire = 0;
  employe->partiel = 0;
  employe->salaire_heure = 35295; /* x1000 */
  employe->salaire_heure_poste = 35295;
  employe->heure_max_jour = 8;
  employe->max_heure_semestre = 850;
  employe->cout_licenciement = 15000000; /* x1000 */

}

void init_pdv_centre_ville( struct point_de_vente * point_de_vente )
{
  point_de_vente->type = 'V';
  point_de_vente->loyer_mensuel = 3000000; /* x1000 */
  point_de_vente->vendeur_necessaire = 1;
  point_de_vente->prix_de_vente = 200; /* x1000 */
  point_de_vente->heure_max_jour = 8;
  point_de_vente->max_jours_annee = 280;
  point_de_vente->qtte_vendable = 400000;
}

void init_pdv_excentre( struct point_de_vente * point_de_vente )
{
  point_de_vente->type = 'E';
  point_de_vente->loyer_mensuel = 2000000; /* x1000 */
  point_de_vente->vendeur_necessaire = 1;
  point_de_vente->prix_de_vente = 170; /* x1000 */
  point_de_vente->heure_max_jour = 8;
  point_de_vente->max_jours_annee = 280;
  point_de_vente->qtte_vendable = 400000;
}

void init_pdv_gms( struct point_de_vente * point_de_vente )
{
  point_de_vente->type = 'S';
  point_de_vente->loyer_mensuel = 0; /* x1000 */
  point_de_vente->vendeur_necessaire = 0;
  point_de_vente->prix_de_vente = 155; /* x1000 */
  point_de_vente->heure_max_jour = 0;
  point_de_vente->max_jours_annee = 0;
  point_de_vente->qtte_vendable = 3200000;
}

void init_electricite( struct electricite * electricite )
{
  electricite->cout_mwh = 90000; /* x1000 */
}

void init_sachet( struct sachet * sachet )
{
  sachet->cout = 20; /* x1000 */
}

void init_carton( struct carton * carton )
{
  carton->cout = 500; /* x1000 */
}

void init_transport( struct transport * transport )
{
  transport->gateau_max = 80000;
  transport->cout = 1000000; /* x1000 */
}

void init_beurre( struct beurre * beurre )
{
  beurre->prix_kg = 3000; /* x1000 */
}

void init_farine( struct farine * farine )
{
  farine->prix_kg = 1000; /* x1000 */
}

void init_oeuf( struct oeuf * oeuf )
{
  oeuf->prix_kg = 2000; /* x1000 */
}

void init_sucre( struct sucre * sucre )
{
  sucre->prix_kg = 2000; /* x1000 */
}