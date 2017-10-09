<div class="container">
	<div class="center-align">
		<h1>Rejoindre <?php echo $nom;?></h1>
		<br>
		<?php echo form_open('RejoindreEquipe/joinEquipe'); ?>
			<input id="nom" name="nom" type="text" value="<?php echo $nom;?>" hidden required>
			<input id="id" name="id" type="text" value="<?php echo $id;?>" hidden required>
			<div class="row">
				<div class="input-field col s12">
					<input id="pwd" type="password" name="pwd" class="validate" required>
					<label for="pwd">Mot de passe</label>
				</div>
			</div>
			<br>
			<button class="btn waves-effect waves-light" type="submit" name="submit">
				Rejoindre
			</button>
			<br>
			<br>
			<b class="red-text">
				<?php echo $errorMessage;?>
			</b>
		<?php echo form_close(); ?>
	</div>
</div>