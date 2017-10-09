<div class="container">
	<?php echo form_open('ModifierEquipe/updateEquipe'); ?>
	<h1>Modifier <?php echo $nom;?></h1>
		<br>
		<b class="red-text">
			<?php echo $errorMessage;?>
		</b>
		<b class="green-text">
			<?php echo $successMessage;?>
		</b>
		<br>
		<input id="id" name="id" type="text" value="<?php echo $id;?>" hidden required>
		<div class="row">
			<div class="input-field col s12">
				<input id="nom" name="nom" type="text" class="validate" value="<?php echo $nom;?>" required>
				<label for="nom">Nom <span>*</span></label>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="input-field col s12">
				<input id="pwd" type="password" name="pwd" value="<?php echo $pwd;?>">
				<label for="pwd">Mot de passe</label>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="input-field col s12">
				<input id="sports" name="sports" type="text" class="validate" value="<?php echo $sports;?>" required>
				<label for="sports">Sports <span>*</span></label>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="input-field col s12">
				<input id="ville" name="ville" type="text" class="validate" value="<?php echo $ville;?>" required>
				<label for="ville">Ville <span>*</span></label>
			</div>
		</div>
		<br>
		<div class="row">
          <div class="input-field col s12">
            <textarea maxLength="140" id="description" name="description" class="materialize-textarea" data-length="140"><?php echo $description;?></textarea>
            <label for="description">Description</label>
          </div>
        </div>
		<br>
		<div class="row">
			<div class="input-field col s12">
				<select id="mixite" name="mixite">
					<option value="mixte">Mixte</option>
					<option value="hommes">Hommes</option>
					<option value="femmes">Femmes</option>
				</select>
				<label>Mixité <span>*</span></label> 
			</div>
		</div>
		<br>
		<div class="row">
			<div class="input-field col s12">
				<input id="logo" name="logo" type="text" placeholder="url du logo" value="<?php echo $logo;?>">
				<label for="logo">Logo</label>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="input-field col s12">
				<input id="photo" name="photo" type="text" placeholder="url de la photo" value="<?php echo $photo;?>">
				<label for="photo">Photo</label>
			</div>
		</div>
		<br>
		<button class="btn waves-effect waves-light" type="submit" name="submit">
	    	Modifier cette equipe
		</button>
		<a href="ModifierEquipe/deleteEquipe?id=<?php echo $id;?>"
		   class="waves-effect waves-light btn right red">
			Supprimer
		</a>
		<br>
		<br>
		<br>
	<?php echo form_close(); ?>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('select').material_select();
	});
</script>