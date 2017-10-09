<div class="container">
	<?php echo form_open('CreerEquipe/createEquipe'); ?>
	<h1>Créer une nouvelle equipe</h1>
		<br>
		<b class="red-text">
			<?php echo $errorMessage;?>
		</b>
		<br>
		<div class="row">
			<div class="input-field col s12">
				<input id="nom" name="nom" type="text" class="validate" required>
				<label for="nom">Nom <span>*</span></label>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="input-field col s12">
				<input id="pwd" type="password" name="pwd">
				<label for="pwd">Mot de passe</label>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="input-field col s12">
				<input id="sports" name="sports" type="text" class="validate" required>
				<label for="sports">Sports <span>*</span></label>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="input-field col s12">
				<input id="ville" name="ville" type="text" class="validate" required>
				<label for="ville">Ville <span>*</span></label>
			</div>
		</div>
		<br>
		<div class="row">
          <div class="input-field col s12">
            <textarea maxLength="140" id="description" name="description" class="materialize-textarea" data-length="140"></textarea>
            <label for="description">Description</label>
          </div>
        </div>
		<br>
		<div class="row">
			<div class="input-field col s12">
				<select id="mixite" name="mixite">
					<option value="Mixte">Mixte</option>
					<option value="Hommes">Hommes</option>
					<option value="Femmes">Femmes</option>
				</select>
				<label>Mixité <span>*</span></label> 
			</div>
		</div>
		<br>
		<div class="row">
			<div class="input-field col s12">
				<input id="logo" name="logo" type="text" placeholder="url du logo">
				<label for="logo">Logo</label>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="input-field col s12">
				<input id="photo" name="photo" type="text" placeholder="url de la photo">
				<label for="photo">Photo</label>
			</div>
		</div>
		<br>
		<button class="btn waves-effect waves-light" type="submit" name="submit">
	    	Créer équipe
		</button>
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