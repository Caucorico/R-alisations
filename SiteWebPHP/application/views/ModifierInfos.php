<div class="container">
	 <div class="row">
		<div class="col m6 s12">
			<?php echo form_open('ModifierInfos/changePassord'); ?>
				<h1>Changer de mot de passe</h1>
				<div class="row">
					<div class="input-field col s12">
						<input name="oldpwd" id="oldpwd" type="password" class="validate" required>
						<label for="oldpwd">Mot de passe actuel <span>*</span></label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input name="pwd" id="pwd" type="password" class="validate" required>
						<label for="pwd">Nouveau mot de passe <span>*</span></label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
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
				<br>
				<button class="btn waves-effect waves-light" type="submit" name="submit">
			    	Changer de mot de passe
				</button>
				<br>
				<b class="green-text">
					<?php echo $pwdSuccess;?>
				</b>
				<b class="red-text">
					<?php echo $pwdError;?>
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

		<div class="col m6 s12">
			<?php echo form_open('ModifierInfos/changeEmail'); ?>
				<h1>Changer d'email</h1>
				<div class="hide-on-small-only">
					<br>
					<br>
					<br>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input name="oldemail" id="oldemail" type="email" class="validate" required>
						<label for="oldemail">Email actuel <span>*</span></label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input name="email" id="email" type="email" class="validate" required>
						<label for="email">Nouvel email <span>*</span></label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input name="pwd" id="pwd" type="password" class="validate" required>
						<label for="pwd">Mot de passe <span>*</span></label>
					</div>
				</div>
				<br>
				<br>
				<button class="btn waves-effect waves-light" type="submit" name="submit">
			    	Changer d'email
				</button>
				<br>
				<b class="green-text">
					<?php echo $emailSuccess;?>
				</b>
				<b class="red-text">
					<?php echo $emailError;?>
				</b>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>