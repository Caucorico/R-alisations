<style type="text/css">
  .card {
    margin:5px;
  }

</style>

<div  class="container">
	<div class="center-align">
	   <?php
	   echo "<h1>".$nom."</h1>";
	   ?>
	</div>

	<div class="row">
	  	<div class="card col s12 m5">
			<div class="card-image waves-effect waves-block waves-light"> 
				<img src= <?php echo $photo; ?> >
			</div>

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
	  <div class="card col s12 m6">
	    <div class="card-content">
	    	<h3>Calendrier</h3>
	    	<?php 
	    		if (isset($calendrier)) {
	    			echo $calendrier;
	    		} else {
	    			echo "Vous ne faites pas partie de cette équipe";
	    		}
	    	 ?>
	    	 <br>
	    	 <a href=<?php echo site_url("CreerEvenement?idEquipe=".$id);?>
			   class="waves-effect waves-light btn <?php echo $showEntraineur;?>">
			   Créer un évenement
			</a>
	    </div>
	  </div>
	</div>
</div>


