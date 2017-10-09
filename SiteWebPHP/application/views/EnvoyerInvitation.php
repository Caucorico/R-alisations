<div class="container">
	<div class="row">
		<div class="center align">
			<?php echo form_open('EnvoyerInvitation/envoiInvitation?userLogin='.$_GET['userLogin']); ?>
			<br>
			<h1>Dans quelle équipe inviter cet utilisateur ?</h1>
			<br>
			<div class="row">
				<div class="input-field col s12">
	  				<select id="equipe" name="equipe">
	  					<?php 
	  						foreach($equipes as $equipe){
	  							if ($equipe != NULL){
	  								echo "<option value=\"".$equipe->id."\">".$equipe->nom."</option>";
	  							}
	  						}
	  					?>
	  				</select>
				</div>
			</div>
			<br>
			<br>
			<button class="btn waves-effect waves-light" type="submit" name="submit">
				Inviter
			</button>
			<br>
			<br>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('select').material_select();
	});
</script>
