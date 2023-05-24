<link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
      <div class="navbarskripsi">
            <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
                <div class="container px-5">
                    <a class="navbar-brand" href="skripsiutama.php">Cek Plagiasi</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item"><a class="nav-link" href="index.html">Pustaka</a></li>
                            <li class="nav-item"><a class="nav-link" href="about.html">Tentang</a></li>                    
                        </ul>
                    </div>
                </div>
            </nav>
      </div>
<?php
include "levenshteindistance.php";
include "preprocessing.php";
require "vendor/autoload.php";

use GordonLesti\Levenshtein\Levenshtein;
// echo "<pre>", var_dump($_POST), "</pre>";

// $filepembanding = "";
// $filepembanding2 = [];
if (!empty($_POST["deteksi"])) {
	$GLOBALS["filepembanding"] = $_POST["filepembanding"];
	$GLOBALS["filepembanding2"] = $_POST["filepembanding2"];
	if (!empty($_POST["preprocessing"])) {
		preprocessing($_POST["preprocessing"], $_POST["filepembanding"], $_POST["filepembanding2"]);
	}
}

global $bil1;
global $bil2;
global $operasi;
global $similarity;
global $length;
global $length2;
global $diff;

// $bil1 = $_POST["fileutama"]; // $bil2 = $_POST["tab' .$i. '"]; // $texting = strlen('fileutama'); // $operasi = $_POST["operasi"]; // $area1 = $_FILES["fileutama"]; // $area2 = $_FILES["tab$i"]; // $area4 = $_POST["tab$i"]; // $length = strlen($area3); // $length2 = strlen($area4); // $area3 = $_POST["fileutama"];
// echo $length;

// $diff = Levenshtein::levenshtein($fileutama, "fileutama");

// echo $diff; // die();

// $similarity = (1 - $diff / max($length, $length2)) * 100;

// $filepembanding = "";
if (isset($_POST["deteksi"])) {
	$bil1 = $GLOBALS["filepembanding"];
	$bil2 = $GLOBALS["filepembanding2"];

	$length = strlen($bil1);
	$length2 = [];
	// echo "Length 1 = " . $length;
	foreach ($bil2 as $key => $value) {
		#code...
		$length2[] = strlen($value);
	}
	echo "PERSENTASE LEVENSHTEIN DISTANCE";
	echo "<br>";
	foreach ($length2 as $key => $value) {
		#code...
		// echo "file $key = " . $value;
	}
	for ($i = 0; $i < count($length2); $i++) {
		$diff = Levenshtein::levenshtein($bil1, $bil2[$i]);
		// echo "[" . $i + 1 . "]Nilai Diff: $diff <br>";
		$similarity = (1 - $diff / max($length, $length2[$i])) * 100;

		// echo "<br>";
		echo $similarity;

		// if ($similarity >= 25) {
		// 	echo "File Terdeteksi Plagiat";
		// } else {
		// 	echo "File Tidak Terdeteksi Plagiat";
		// }
		echo "<br>";
	}

	echo "<br>";
	echo "PERSENTASE SIMILAR TEXT";
	foreach ($bil2 as $key => $value) {
		echo "<br>";
		similar_text($bil1, $value, $percent);
		echo $percent;
		// if ($percent >= 25) {
		// 	echo "File Terdeteksi Plagiat";
		// } else {
		// 	echo "File Tidak Terdeteksi Plagiat";
		// }
		// echo "<br>";
	}
}
?>

<!doctype html>
<html>

<head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <title>Skripsi Cek Plagiasi</title>
</head>

      <body>
<?php
$DisplayForm = true;
if (isset($_POST["Upload"])) {
	$DisplayForm = false;
}
if ($DisplayForm) { ?>
      <br>
      <div class="d-flex justify-content-center">
        <form method="POST" enctype="multipart/form-data">
                <input type="file" name="file1">
                <input type="file" name="my_file[]" multiple>
                <input class="btn btn-primary" type="submit" name="Upload" value="Upload">
        </form>
      </div>
        <?php }
?> 
        
        <!-- File 1 -->

        <div class="container">
                <div class="row">
                        <div class="col-6">
                                <?php if (isset($_FILES["file1"])) {

                                	$myFile = $_FILES["file1"];
                                	$nama = $myFile["name"];
                                	?>
                                  
                                        <p>File Utama: <?= $nama ?></p>
                                        <p>
                                        <form method ="post" action="skripsiutama.php" enctype="multipart/form-data">
                                          <?php $isiFilee = file_get_contents($_FILES["file1"]["tmp_name"]); ?>
                                                <textarea readonly wrap="off" name="filepembanding" id="" cols="70" rows="25"><?= $isiFilee ?></textarea>
                                                <!-- echo nl2br(file_get_contents($_FILES['file']['tmp_name'])); -->
                                        </p>
                                <?php
                                } ?>

                        </div>
                        <div class="col-6">
                                <?php if (isset($_FILES["my_file"])) {

                                	$myFile = $_FILES["my_file"];
                                	$fileCount = count($myFile["name"]);

                                	// $namaFile = array($nama);
                                	// $a = $i + 1;
                                	// $isiFile = nl2br(file_get_contents($_FILES['my_file']['tmp_name']));
                                	?>
                                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                                                <?php
                                                $myFile = $_FILES["my_file"];
                                                $nama = $myFile["name"];
                                                for ($i = 0; $i < $fileCount; $i++) {
                                                	echo '<li class="nav-item" role="presentation">
                                                                <button class="nav-link" id="data-tab" data-bs-toggle="tab" data-bs-target="#tab' .
                                                		$i .
                                                		'"   type="button" role="tab" aria-controls="data" aria-selected="true">' .
                                                		"$nama[$i]" .
                                                		'</button>
                                                        </li>';
                                                }
                                                ?>
                                        </ul>
                                        <!-- <p>File 
                                                <p> -->

                                        <!-- <li class="nav-item" role="presentation">
                                                                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</button>
                                                        </li> -->
                                        </ul>

                                        <!-- tab content -->


                                        <div class="tab-content" id="myTabContent">
                                                <?php for ($i = 0; $i < $fileCount; $i++) {
                                                	$isiFile = file_get_contents($_FILES["my_file"]["tmp_name"][$i]);
                                                	echo '<div class="tab-pane fade show" id="tab' .
                                                		$i .
                                                		'" role="tabpanel" aria-labelledby="data-tab">' .
                                                		'<textarea rea    donly name="filepembanding2[]" wrap="off" cols="70" rows="25">' .
                                                		$isiFile .
                                                		"</textarea>" .
                                                		"</div>";
                                                } ?>
                                                <p><?php
                                                Persentase:
                                                $similarity;
                                                ?></p>
                                        </div>


                                <?php
                                } ?>

                        </div>
                </div>

        </div>

        
        <?php if (isset($_POST["Upload"])) {
        	$hide = 2; ?>
        
        <div class="container">

                <input type="checkbox" name="preprocessing[]" id="casefolding" value="casefolding" />
                <label for="casefolding">casefolding</label>

                <input type="checkbox" name="preprocessing[]" id="filtering" value="filtering" />
                <label for="filtering">filtering</label>

                <!-- <input type="checkbox" name="preprocessing[]" id="tokenizing" value="tokenizing" />
                <label for="tokenizing">tokenizing</label> -->

                <input type="checkbox" checked disabled name="preprocessing[]" id="levenshteindistance" value="levenshteindistance" />
                <label for="tokenizing">Levenshtein Distance</label>

                <br>
                <button type="submit" name="deteksi" value="hitung" class="btn btn-primary">Cek Plagiasi</button>
    
              </div>
                      
        <?php
        } ?>
        </form>










        <!-- File 2 -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
</html>