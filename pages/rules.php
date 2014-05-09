<?php
include_once (dirname(__FILE__)."/../common.php");

Common::startPage();
?>
<h1>Règles du jeu</h1>
<div class="text">
<h3>Participation</h3>
<p>Cette compétition est réservée à CanalTP (prestataires inclus bien sûr). Tout le monde peut s'inscrire mais tous les comptes doivent être validés donc pas la peine d'inscrire quelqu'un de l'extérieur, il serait refusé.</p>
<h3>Pronostics</h3>
<p>Les points suivants sont pronosticables :


<ul>
	<li>Le résultat de chaque match</li>
	<li>La position de chaque équipe au sein de sa poule à la fin de la première phase</li>
	<li>L'équipe championne du monde</li>
</ul>
Le pronostic de l'équipe championne du monde doit être fait avant le début de la compétition. Le pronostic des positions finales des équipes d'une poule doit être fait avant le début du 1er match de cette poule. Chaque match est pronosticable jusqu'à l'heure du début de celui-ci.</p>
<p>Le résultat de chaque match est celui de la fin du temps réglementaire. Les éventuelles prolongations ne sont pas prises en compte.</p>
<h3>Points</h3>
<p>Chaque score de match exact rapporte 3 points. Un résultat exact sans score exact (ex : 2-0 pronostiqué, 2-1 au final) rapporte 1 point. Dans ce cas une différence de buts correcte (ex : 2-0 pronostiqué, 3-1 au final) rapporte 1 deuxième point.


<p><i>Exemples:</i>


<table class="matchbets" style="text-align: center;">
	<tr>
		<td class="bet">Pronostic</td>
		<td class="viewbet">Score réel</td>
		<td class="points">Points</td>
	</tr>
	<tr>
		<td>2:0</td>
		<td>0:1</td>
		<td><b>0</b></td>
		<td style="text-align: right; background-color: white;">faux</td>
	</tr>
	<tr>
		<td>1:3</td>
		<td>1:2</td>
		<td><b>1</b></td>
		<td style="text-align: right; background-color: white;">résultat exact sans score exact</td>
	</tr>
	<tr>
		<td>2:1</td>
		<td>1:0</td>
		<td><b>2</b></td>
		<td style="text-align: right; background-color: white;">résultat exact sans score exact mais différence de buts exacte !</td>
	</tr>
	<tr>
		<td>4:4</td>
		<td>4:4</td>
		<td><b>3</b></td>
		<td style="text-align: right; background-color: white;">Tout bon : champagne !</td>
	</tr>
</table>
</p>
<b>Position des équipes dans les groupes </b>: <br>
1 équipe à la bonne place à la fin de la phase de poule rapporte 1 point. Trouver les 2 équipes qualifiées rapporte 1 point. Toutes les équipes à la bonne position rapporte un bonus d'1 point.
Il est donc possible de gagner 6 points au maximum par poule.</p>
<p>Trouver <b>l'équipe championne du monde</b> rapporte 5 points.</p>
<h3>Prix</h3>
<p>
<ul>
	<li>Au 1er : 50% des sommes misées</li>
	<li>Au 2eme : 30% des sommes misées</li>
	<li>Au 3eme : 20% des sommes misées</li>
</ul>
Il est bien sûr entendu que les mises seront enregistrées et que seul un joueur qui a <b>participé à la compétition payante et qui a effectivement payé avant le début de celle-ci </b>peut revendiquer un prix.
</p>
</div>
<br style="clear: both">
<?php
Common::endPage();
?>