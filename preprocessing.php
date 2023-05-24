<?php
// echo "<pre>";
// var_dump($_GET);
// echo "</pre>";

$filepembanding = "";
$filepembanding2 = [];

function preprocessing($feature, $fileP, $fileD)
{
	$GLOBALS["filepembanding"] = $fileP;
	$GLOBALS["filepembanding2"] = $fileD;
	// echo "<pre>";
	// var_dump($GLOBALS["filepembanding"]);
	// var_dump($GLOBALS["filepembanding2"]);

	// // var_dump($feature, $fileP, $fileD);
	// echo "</pre>";
	// die();
	for ($i = 0; $i < count($feature); $i++) {
		$feature[$i]($GLOBALS["filepembanding"], $GLOBALS["filepembanding2"]);
	}
}

function CaseFolding($fileP, $fileD)
{
	// echo "-------------------------AWAL CASE FOLDING-------------------------<br>";
	echo "<pre>";
	$GLOBALS["filepembanding"] = strtolower($fileP);
	echo "</pre>";

	foreach ($fileD as $key => $value) {
		echo "<pre>";
		$GLOBALS["filepembanding2"][$key] = strtolower($value);

		echo "</pre>";
	}
	// echo "-----------------------------SELESAI CASE FOLDING-----------------------------";
}

function filtering($fileP, $fileD)
{
	// echo "-------------------------AWAL FILTERING-------------------------<br>";
	$filterkata = [
		"abstract",
		"assert",
		"boolean",
		"break",
		"byte",
		"case",
		"catch",
		"char",
		"class",
		"const",
		"continue",
		"default",
		"do",
		"double",
		"else",
		"enum",
		"exports",
		"extends",
		"final",
		"finally",
		"float",
		"for",
		"goto",
		"if",
		"implements",
		"import",
		"instanceof",
		"int",
		"interface",
		"long",
		"module",
		"native",
		"new",
		"open",
		"opens",
		"package",
		"private",
		"protected",
		"provides",
		"public",
		"requires",
		"return",
		"short",
		"static",
		"strictfp",
		"super",
		"switch",
		"string",
		"synchronized",
		"this",
		"throw",
		"throws",
		"to",
		"transient",
		"transitive",
		"try",
		"uses",
		"void",
		"volatile",
		"while",
		"with",
		"integer",
	];
	echo "<pre>";

	var_dump($GLOBALS["filepembanding"] = str_replace($filterkata, "", $fileP));
	echo "</pre>";
	echo "<pre>";
	// var_dump($GLOBALS["filepembanding"] = str_replace($filterkata, "", $fileP));

	foreach ($fileD as $key => $value) {
		$GLOBALS["filepembanding2"][$key] = str_replace($filterkata, "", $value);
		echo "</pre>";
	}
	// echo "-------------------------------SELEASI FILTERING-------------------------------";
}

function tokenizing($fileP, $fileD)
{
	// echo "-------------------------AWAL TOKENIZING-------------------------<br>";
	echo "<pre>";
	var_dump($GLOBALS["filepembanding"] = explode(" ", $fileP));
	// echo "<br>";
	echo "</pre>";
	echo "<br>";
	foreach ($fileD as $key => $value) {
		echo "<pre>";
		$GLOBALS["filepembanding2"][$key] = explode(" ", $value);
		// echo "<br>";
		echo "</pre>";
	}
	// echo "-------------------------------SELEASI TOKENIZING-------------------------------";
}

function levenshteindistance($fileP, $fileD)
{
}
