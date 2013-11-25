<?php
include_once (dirname(__FILE__)."/../common.php");

Common::startPage();
?>
<h1>Spielregeln</h1>
<div class="text">
<p>Jedes Spiel hat irgendwelche Regeln... Dieses ab jetzt auch!</p>
<h3>Teilnahme</h3>
<p>Teilnehmen kann jeder, der sich durch das Anmeldeformular einträgt
und dann vom Spieladministrator freigeschaltet wird. Das bedeutet damit,
dass das hier ein "geschlossenes" Tippspiel für Freunde der
Tippspielorganisatoren ist.</p>
<h3>Tippen</h3>
<p>Getippt werden:


<ul>
	<li>der Weltmeister</li>
	<li>die einzelnen Spielergebnisse</li>
	<li>und die Mannschafts-Endpositionen innerhalb der Vorgruppen</li>
</ul>
Dabei gilt: der Weltmeister muss bis zum Beginn der WM getippt sein, und
Positionstipps müssen bis zum Beginn des ersten Spiels der zugehörigen
Gruppe abgegeben werden. Die Spieltipps kannst du immer bis zum Anpfiff
des Spiels eintragen; hat das Spiel begonnen, ist das nicht mehr
möglich.
</p>
<p>Getippt wird das Ergebnis nach 90 Minuten. Das heißt bis zum Abpfiff der regulären Spielzeit. Tore in der Verlängerung zählen nicht mehr.</p>
<h3>Bewertung</h3>
<p>Für ein richtig getipptes <b>Spielergebnis</b> erhältst du 3 Punkte.
Ist nicht das exakte Ergebnis aber die Tendenz (also Gewonnen, Verloren,
Unentschieden) korrekt, bekommst du einen Punkt. Ist zudem deine
Tordifferenz die gleiche wie im tatsächlichen Ergebnis, kriegst du statt
einem sogar zwei Punkte.


<p><i>Beispiele:</i>


<table class="matchbets" style="text-align: center;">
	<tr>
		<td class="bet">getippt</td>
		<td class="viewbet">tatsächlich</td>
		<td class="points">Punkte</td>
	</tr>
	<tr>
		<td>2:0</td>
		<td>0:1</td>
		<td><b>0</b></td>
		<td style="text-align: right; background-color: white;">falsch</td>
	</tr>
	<tr>
		<td>1:3</td>
		<td>1:2</td>
		<td><b>1</b></td>
		<td style="text-align: right; background-color: white;">Tendenz</td>
	</tr>
	<tr>
		<td>2:1</td>
		<td>1:0</td>
		<td><b>2</b></td>
		<td style="text-align: right; background-color: white;">Tordifferenz!</td>
	</tr>
	<tr>
		<td>4:4</td>
		<td>4:4</td>
		<td><b>3</b></td>
		<td style="text-align: right; background-color: white;">richtig!</td>
	</tr>
</table>
</p>
Nun zu den <b>Gruppenpositionen</b>: <br>
Steht ein Team am Ende der Vorrunde auf genau dem Platz, den du getippt
hast, erhältst du für dieses Team einen Punkt. Hast du die Einteilung
wer weiterkommt - und wer nicht - richtig getroffen, erhältst du für
diese Gruppe zusätzlich einen Punkt. Hast du alle Teams an die richtige
Stelle gesetzt, bekommst du noch einen Punkt obendrauf. Damit kannst du
also maximal <b>4</b> <i>(vier Teams richtig)</i> <b>+ 1</b> <i>(genau
deine 2 Favoriten kommen</i> weiter) <b>+ 1</b> <i>(alle Teams richtig)</i>
= <b>6</b> Punkte erreichen.
</p>
<p>Für den richtigen <b>Weltmeistertipp</b> kassierst du 5 Punkte.</p>
<h3>Preise</h3>
<p>Wird es geben. Dazu in Zukunft noch näheres. Jedenfalls steht fest:
Wer sich mit 3 Euro beteiligen möchte ist gewinnberechtigt. Die Preise
werden dann durch dieses Geld finanziert. Es wird aber nicht nur einen
Preis geben, sondern die besten Tippspieler erhalten jeweils einen
Preis. Außerdem wird ein Preis unter allen (zahlenden) Tippspielern
verlost. Die tatsächliche Anzahl der Preise und aus was der einzelne
Preis bestehen wird, hängt von der finanziellen Beteiligung und der
Kreativität der Preisaussucher ab ;-). Dabei kann ein Preis auch
durchaus mal speziell auf seinen Gewinner zugeschnitten sein...</p>
</div>
<br style="clear: both">
<?php
Common::endPage();
?>