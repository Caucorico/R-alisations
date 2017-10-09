<style type="text/css">
  .btn {
    margin:5px;
  }

</style>

<div class="container">
	<div class="row">
		<div class="col s12">
			<div class="card horizontal hide-on-small-only">
				<img style="max-height: 256px; max-width: 256px;" src=<?php echo $logo;?>>
				<div class="card-stacked">
					<div class="card-action">
						<a href=<?php echo site_url("VoirEquipe/index/".$id);?>>
							<?php echo $nom;?>
						</a>
						<a href=<?php echo site_url("VoirInvitation/refuse?idEquipe=".$id);?>
						   class="waves-effect waves-light btn right red"
						 >
							Refuser 
						</a>
						<a href=<?php echo site_url("VoirInvitation/accept?idEquipe=".$id);?>
						   class="waves-effect waves-light btn right"
						 >
							Accepter 
						</a>
					</div>
					<div class="divider"></div>
					<div class="card-content">
						<p><?php echo $description;?></p>
						<br>
						<b><?php echo $sports;?></b>
						<br>
						<b><?php echo $mixite;?></b>
						<br>
						<b>Ville : </b><?php echo $ville;?>
					</div>
				</div>
			</div>
			<div class="card hide-on-med-and-up">
				<img style="max-height: 256px; max-width: 256px;" src=<?php echo $logo;?>>
				<div class="card-stacked">
					<div class="card-content">
						<p><?php echo $description;?></p>
						<br>
						<b><?php echo $sports;?></b>
						<br>
						<b><?php echo $mixite;?></b>
						<br>
						<b>Ville : </b><?php echo $ville;?>
					</div>
					<div class="card-action"> 
						<a href=<?php echo site_url("VoirEquipe/index/".$id);?>>
							<?php echo $nom;?>
						</a>
						<a href=<?php echo site_url("VoirInvitation/refuse?idEquipe=".$id);?>
						   class="waves-effect waves-light btn right red"
						 >
							Refuser 
						</a>
						<a href=<?php echo site_url("VoirInvitation/accept?idEquipe=".$id);?>
						   class="waves-effect waves-light btn right"
						 >
							Accepter 
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>