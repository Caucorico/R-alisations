<div class="container">
	 <div class="row">
	 	<div class="col m6 s12">
			<?php echo form_open('Login/login'); ?>
				<h1>S'identifier</h1>
				<div class="row">
					<div class="input-field col s12">
						<input id="email" name="email" type="email" class="validate" required>
						<label for="email">Email</label>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="input-field col s12">
						<input id="loginpwd" type="password" name="loginpwd" class="validate" required>
						<label for="loginpwd">Mot de passe</label>
					</div>
				</div>
				<br>
				<button class="btn waves-effect waves-light" type="submit" name="submit">
			    	Se connecter
				</button>
				<br>
				<b class="red-text">
					<?php echo $loginError;?>
				</b>
				 
			<?php echo form_close(); ?>
		</div>

		<div class="col m6 s12">
			<?php echo form_open('Login/register'); ?>
				<h1>S'inscrire</h1>
				<div class="row">
					<div class="input-field col s6">
						<input id="firstname" name="firstname" type="text" class="validate" required>
						<label for="firstname">Prénom <span>*</span></label>
					</div>
					<div class="input-field col s6">
						<input id="lastname" name="lastname" type="text" class="validate" required>
						<label for="lastname">Nom <span>*</span></label>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="input-field col s12">
						<input id="login" name="login" type="text" class="validate" required>
						<label for="login">Pseudonyme <span>*</span></label>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="input-field col s12">
						<input id="email" name="email" type="email" class="validate" required>
						<label for="email">Email</label>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="input-field col s6">
						<input name="pwd" id="pwd" type="password" class="validate" required>
						<label for="pwd">Mot de passe <span>*</span></label>
					</div>
					<div class="input-field col s6">
						<input name="confirmpwd" id="confirmpwd" type="password" required>
						<label for="confirmpwd" 
							   id="lblPasswordConfirm"
							   data-error="Les mots de passes ne correspondent pas" 
							   data-success="Les mots de passes correspondent">
							   Confirmer mot de passe 
							   <span>*</span>
						</label>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="input-field col s12">
						<input id="avatar" name="avatar" type="text">
						<label for="avatar">Avatar</label>
					</div>
				</div>
				<br>
				<button class="btn waves-effect waves-light" type="submit" name="submit">
			    	S'inscrire
				</button>
				<br>
				<b class="green-text">
					<?php echo $registerSuccess;?>
				</b>
				<b class="red-text">
					<?php echo $registerError;?>
				</b>
			<?php echo form_close(); ?>
		</div>
		<script type="text/javascript">
			$("#pwd").on("focusout", function (e) {
			    if ($(this).val() != $("#confirmpwd").val()) {
			        $("#confirmpwd").removeClass("valid").addClass("invalid");
			    } else {
			        $("#confirmpwd").removeClass("invalid").addClass("valid");
			    }
			});

			$("#confirmpwd").on("keyup", function (e) {
			    if ($("#pwd").val() != $(this).val()) {
			        $(this).removeClass("valid").addClass("invalid");
			    } else {
			        $(this).removeClass("invalid").addClass("valid");
			    }
			});
		</script>
	</div>
</div>