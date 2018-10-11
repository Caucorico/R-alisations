#ifndef DATA
#define DATA

struct entreprise
{
  struct liste_pdv * liste_pdv;
  struct liste_usine * liste_usine;
  long tresorerie;
  long capital;
};

struct liste_usine
{
  struct usine * usine;
  struct liste_usine * next;
};

struct liste_machine
{
  struct machine * machine;
  struct liste_machine * next;
};

struct liste_employe
{
  struct employe * employe;
  struct liste_employe * next;
};

struct liste_pdv
{
  struct point_de_vente * point_de_vente;
  struct liste_pdv * next;
};

struct machine
{
  char type;
  long cout; /* x1000 */
  long production_1x8h;
  long nb_operateur_n_1x8h;
  long nb_operateur_n_temps_plein;
  long nb_operateur_n_temps_partiel;
  long nb_polyvalent_n_1x8h;
  long nb_polyvalent_n_temps_plein;
  long nb_polyvalent_n_temps_partiel;
  long nb_operateur_1x8h;
  long nb_operateur_temps_plein;
  long nb_operateur_temps_partiel;
  long nb_polyvalent_1x8h;
  long nb_polyvalent_temps_plein;
  long nb_polyvalent_temps_partiel;
  long consomation_kwh;
  long duree_de_vie_max_annee;
  long duree_de_vie_restante_annee;
  long nb_max_moulage_reparation;
  long prix_reparation_moulage; /* x1000 */
  struct liste_employe * liste_employe;
};

struct employe
{
  char type;
  unsigned char partiel;
  unsigned char interimaire;
  unsigned char temps_partiel;
  long salaire_heure;
  long salaire_heure_poste;
  long heure_max_jour;
  long max_heure_semestre;
  long cout_licenciement;
};

struct point_de_vente
{
  char type;
  long loyer_mensuel;
  long vendeur_necessaire;
  long prix_de_vente;
  long heure_max_jour;
  long max_jours_annee;
  long qtte_vendable;
};

struct usine
{
  unsigned char location;
  long loyer_mensuel; /* x1000 */
  long prix; /* x1000 */
  long ligne_fabrication_max;
  long duree_de_vie_max_annee;
  long duree_de_vie_restante_annee;
  long heure_max_jour;
  long max_jours_annee;
  struct liste_machine * liste_machine;
  struct employe * gerant;
};

struct electricite
{
  long cout_mwh; /* x1000 */
};

struct sachet
{
  long cout; /* x1000 */
};

struct carton
{
  long cout; /* x1000 */
};

struct transport
{
  long gateau_max;
  long cout; /* x1000 */
};

struct beurre
{
  long prix_kg; /* x1000 */
};

struct farine
{
  long prix_kg; /* x1000 */
};

struct oeuf
{
  long prix_kg; /* x1000 */
};

struct sucre
{
  long prix_kg; /* x1000 */
};

/* Initialise la structure machine en une machine1 */
void init_machine1( struct machine * machine );

/* Initialise la structure machine en une machine2 */
void init_machine2( struct machine * machine );

/* Initialise la structure machine en une machine3 */
void init_machine3( struct machine * machine );

/* Initialise la structure d'usine */
void init_usine( struct usine * usine, unsigned char location );

/* Initialise un employé en temps que vendeur */
void init_vendeur( struct employe * employe, unsigned char temps_partiel );

/* Initialise un employé en temps qu'opérateur */
void init_operateur( struct employe * employe, unsigned char temps_partiel );

/* Initialise un employé en temps que polyvalant */
void init_polyvalent( struct employe * employe, unsigned char temps_partiel );

/* Initialise un employé en temps qu'opérateur intérimaire. */
void init_operateur_interimaire( struct employe * employe, unsigned char temps_partiel );

/* Initialise un employé en temps que vendeur intérimaire. */
void init_vendeur_interimaire( struct employe * employe, unsigned char temps_partiel );

/* Initialise un employé en temps que gerant. */
void init_gerant( struct employe * employe);

/* Initialise un point de vente en centre ville */
void init_pdv_centre_ville( struct point_de_vente * point_de_vente );

/* Initialise un point de vente excentré. */
void init_pdv_excentre( struct point_de_vente * point_de_vente );

/* Initialise un point de vente en moyenne/grande surface. */
void init_pdv_gms( struct point_de_vente * point_de_vente );

/* Initialise les caractéristiques de l'électricité. */
void init_electricite( struct electricite * electricite );

/* Initialise les coûts d'un sachet. */
void init_sachet( struct sachet * sachet );

/* Initialise les coûts d'un carton. */
void init_carton( struct carton * carton );

/* Initialise les coûts du transport. */
void init_transport( struct transport * transport );

/* Initialise les prix du beurre. */
void init_beurre( struct beurre * beurre );

/* Initialise les prix de la farine. */
void init_farine( struct farine * farine );

/* Initialise les prix des oeufs. */
void init_oeuf( struct oeuf * oeuf );

/* Initialise les prix du sucre. */
void init_sucre( struct sucre * sucre );
#endif