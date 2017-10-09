
<!-- Dropdown Structure -->
<ul id="dropdown1" class="dropdown-content">
  <li class="hide-on-large-only"><a class="blue-text">Bienvenue, <?php echo $prenom." ".$nom;?></a></li>
  <li class="divider"></li>
	<li class="hide-on-med-and-up"><a href=<?php echo site_url("VoirInvitation");?>>Invitations</a></li>
  <li class="divider"></li>
	<li class="hide-on-med-and-up"><a href=<?php echo site_url("MesEquipes");?>>Mes equipes</a></li>
	<li class="divider"></li>
	<li><a href=<?php echo site_url("ModifierInfos");?>>Mes infos</a></li>
	<li class="divider"></li>
	<li><a href=<?php echo site_url("Login/logout");?>>Deconnexion</a></li>

</ul>
<nav>
  <div class="nav-wrapper teal">
    <ul class="left">
      <li><a href=<?php echo site_url("Equipes");?>>Equipes</a></li>
      <li><a href=<?php echo site_url("Utilisateurs");?>>Utilisateurs</a></li>
    </ul>
    <ul>
      <li><a class="brand-logo hide-on-med-and-down">Bienvenue, <?php echo $prenom." ".$nom;?> </a></li>
    </ul>
    <ul class="right">
      <!-- Dropdown Trigger -->
      <li class="hide-on-small-only"><a href=<?php echo site_url("VoirInvitation");?>>Invitations</a></li>
      <li class="hide-on-small-only"><a href=<?php echo site_url("MesEquipes");?>>Mes equipes</a></li>
      <li>
        <a class="dropdown-button" data-activates="dropdown1">
          <i class="material-icons left">perm_identity</i>
          <b class="hide-on-small-only">Mon compte</b>
          <i class="material-icons right">arrow_drop_down</i>
        </a>
      </li>
    </ul>
  </div>
</nav>
        