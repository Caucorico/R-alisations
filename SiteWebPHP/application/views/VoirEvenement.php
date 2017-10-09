<div class="container">
    <div class="row">
      <div class="col s12 m6">
        <div class="card blue-grey darken-1">
          <div class="card-content white-text">
            <span class="card-title"><?php echo $typeEvenement;?> le <?php echo $dateEvenement;?></span>
            <b>Lieu : <?php echo $lieu;?></b>
            <p><?php echo $description;?></p>
          </div>
          <div class="card-action">
            <a href="<?php echo site_url("VoirEvenement/present?idEquipe=".$idEquipe."&dateEvenement=".$dateEvenement."&participe=1");?>">Je participe</a>
            <a href="<?php echo site_url("VoirEvenement/present?idEquipe=".$idEquipe."&dateEvenement=".$dateEvenement."&participe=0");?>">Je serais absent</a>
          </div>
        </div>
      </div>
    </div>
</div>

