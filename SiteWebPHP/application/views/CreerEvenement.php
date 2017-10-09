<div class="container">
	<?php echo form_open('CreerEvenement/addEvent?idEquipe='.$idEquipe); ?>
	<h1>Créer un évènement</h1>
	<br>
	<b class="red-text">
		<?php echo $errorMessage;?>
	</b>
	<br>
	<div class="row">
		<div class="input-field col s12">
		 	<input type="date" name="dateEvenement" name="dateEvenement" class="datepicker" required>
			<label for="dateEvenement">Date <span>*</span></label>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="input-field col s12">
			<select id="typeEvenement" name="typeEvenement">
				<option value="Entrainement">Entrainement</option>
				<option value="Match">Match</option>
				<option value="Competition">Competition</option>
			</select>
			<label>Type <span>*</span></label> 
		</div>
	</div>
	<br>
	<div class="row">
		<div class="input-field col s12">
			<input id="lieu" name="lieu" type="text" class="validate" required>
			<label for="lieu">Lieu <span>*</span></label>
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
	<button class="btn waves-effect waves-light" type="submit" name="submit">
    	Créer
	</button>
	<br>
	<?php echo form_close(); ?>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('select').material_select();
	});

	$('.datepicker').pickadate({
	    selectMonths: true, // Creates a dropdown to control month
	    selectYears: 15, // Creates a dropdown of 15 years to control year
	    hiddenName: true,
	    formatSubmit: 'yyyy-mm-dd'
    });	
</script>