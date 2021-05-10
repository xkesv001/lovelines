<?php
$databaze = 'ete32e_2021zs_01';
$uzivatel = 'ete32e_2021zs_01';
$heslo = 'ZxXOdb';

if (!($cnn = mysqli_connect('localhost', $uzivatel, $heslo)))
	die('Nepodarilo se pripojit k databazovemu serveru.');
if (!mysqli_select_db($cnn, $databaze))
	die('Nepodarilo se otevrit databazi.');

//echo 'Pripojeni k databazi bylo uspesne.';
