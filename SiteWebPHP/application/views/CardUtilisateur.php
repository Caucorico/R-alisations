<style type="text/css">
  .btn {
    margin:5px;
  }

</style>

<div class="container">
    <div class="card horizontal">
      <div class="card-image" >
        <img style="max-height: 160px; max-width: 256px;" src=<?php echo $avatar;?>>
      </div>
      <div class="card-stacked">
        <div class="card-content">
          <p>	
					<?php echo $prenom;?> <?php echo $nom;?>
		      </p>
          <b>
            <?php 
              if (isset($entraineur)) {
                  if ($entraineur == TRUE) {
                      echo "Entraineur";
                  }
              }
            ?>
          </b>
        </div>
		<div class="card-action">
      <a class ="waves-effect waves-light btn right <?php echo $showInviter;?>" 
		       href="<?php echo site_url("EnvoyerInvitation?userLogin=".$login);?>">
		     	Inviter
			</a>
      <a class ="waves-effect waves-light btn right red darken-2 <?php echo $showCongedier;?>" 
           href="<?php echo site_url("VoirEquipe/congedier?login=".$login."&idEquipe=".$idEquipe);?>">
          Congedier
      </a>
      <a class ="waves-effect waves-light btn right <?php echo $showPromouvoir;?>" 
           href="<?php echo site_url("VoirEquipe/promouvoir?login=".$login."&idEquipe=".$idEquipe);?>">
          Promouvoir
      </a>
      <a class ="waves-effect waves-light btn right red <?php echo $showDestituer;?>" 
           href="<?php echo site_url("VoirEquipe/destituer?login=".$login."&idEquipe=".$idEquipe);?>">
          Destituer
      </a>
        </div>
      </div>
    </div>
</div>