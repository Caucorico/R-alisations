#ifndef CALC
#define CALC

/* Acheter une usine */
void acheter_usine ( struct entreprise * entreprise, struct usine * usine );

/* Recruter un gerant, appeler automatiquement lors de l'achat d'une usine. */
void recruter_gerant( struct usine * usine );

/* Acheter une machine */
void acheter_machine ( struct entreprise * entreprise, struct usine * usine, struct machine * machine );

/* Recruter un employe */
void recruter_employe ( struct machine * machine, struct employe * employe );

/* Acheter un point de vente */
void acheter_pdv ( struct entreprise * entreprise , struct point_de_vente * point_de_vente );

/* Recruter tout le personnel nécessaire au fonctionnement d'une machine */
void recruter_necessaire_machine ( struct machine * machine );

/* Récupère la production semestriel de la machine. */
long obtenir_production_semestriel_machine ( struct machine * machine );

/* Récupère la production semestriel de l'entreprise. */
long obtenir_total_production_semestre( struct entreprise * entreprise );

/* Fonction qui récupère toutes les dépenses en matières premières en fonction du nombre de gateau produit. */
long obtenir_couts_matieres_premieres ( long gateaux_produits );

/* Fonction qui récupère toutes les dépenses des salaires de la liste d'employés passé en argument. */
long obtenir_total_depenses_semestre_liste_employe( struct liste_employe * liste );

/* Fonction qui renvoie le cout de tout l'electricite consommé d'une machine. */
long obtenir_total_depense_electricite_machine ( long gateau_produits, long conso_kwh_kg );

/* Fonction qui récupère toutes les dépenses des machines de la liste de machine passé en argument. */
long obtenir_total_depenses_semestre_liste_machine ( struct liste_machine * liste );

/* Fonction qui récupère toutes les dépenses du semestre. */
long obtenir_total_depense_semestre ( struct entreprise * entreprise );

/* Fonction qui renvoie le chiffre d'affaires de l'entreprise passée en argument. */
long obtenir_chiffre_affaires_entreprise ( struct entreprise * entreprise );

#endif