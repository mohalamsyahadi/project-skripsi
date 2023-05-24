<?php
// echo "<pre>";
// var_dump($_GET);
// echo "</pre>";

function preprosesing($feature, $filePembanding, $fileDibanding)
{
	for ($i = 0; $i < count($feature); $i++) {
		$feature[$i]($filePembanding, $fileDibanding);
	}
}

function filtering($filePembanding, $fileDibanding)
{
	$filePembanding = strtolower($filePembanding);
	echo "<br>";
	foreach ($fileDibanding as $key => $value) {
		echo strtolower($fileDibanding[$key]);
		echo "<br>";
	}
}

function tokenizing($filePembanding, $fileDibanding)
{
	// Rumus Tokenizing
	echo "fitur tokenizing dijalankan<br>";
}

function CaseFolding($filePembanding, $fileDibanding)
{
}
