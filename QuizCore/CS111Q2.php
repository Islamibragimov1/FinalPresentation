<?php
session_start();

$conn = mysqli_connect($_SESSION['servername'], $_SESSION['username'], $_SESSION['password'], $_SESSION['dbname']);

$select = "SELECT * FROM questions WHERE difficulty = '5'";
$result = $conn->query($select);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$a21 = $_POST['21'];
	$a22 = $_POST['22'];
	$a23 = $_POST['23'];
	$a24 = $_POST['24'];
	$a25 = $_POST['25'];

	if ($result->num_rows > 0) {
		// output data of each row
		while ($row = $result->fetch_assoc()) {
			if ($a21 == $row['question_answer']) {
				$_SESSION['score'] = $_SESSION['score'] + 1;
			}
			if ($a22 == $row['question_answer']) {
				$_SESSION['score'] = $_SESSION['score'] + 1;
			}
			if ($a23 == $row['question_answer']) {
				$_SESSION['score'] = $_SESSION['score'] + 1;
			}
			if ($a24 == $row['question_answer']) {
				$_SESSION['score'] = $_SESSION['score'] + 1;
			}
			if ($a25 == $row['question_answer']) {
				$_SESSION['score'] = $_SESSION['score'] + 1;
			}
		}
	}

	$sql = "UPDATE students SET question_21 = '$a21', question_22 = '$a22', question_23 = '$a23', question_24 = '$a24', question_25 = '$a25' WHERE email = '$_COOKIE[student]';";
	mysqli_query($conn, $sql);

	header("Location: CS111Q3.php");
}

$pageTitle = "Exam";
require_once 'testheader.php';
// Include functions file
require_once 'functions.php';
?>
<!--Main-->
<!--Main Div-->
<div class="container shadow p-3 my-5 bg-body-tertiary rounded">
	<h2>Exam Question Set: 5</h2>
</div>

<!-- Progress bar -->
<?php echo generateProgressBar(40); ?>

<div class="container">
	<!--Questions pulled from database-->
	<form id="Q1" method="post" action="#">
		<?php
		if ($result->num_rows > 0) {
			// output data of each row
			while ($row = $result->fetch_assoc()) {
				echo '<div class="container shadow p-3 my-5 bg-body-tertiary rounded">';
				echo '<h4>' . $row["question_body"] . '</h4>';
				echo '<div class="form-check">';
				echo '<input class="form-check-input" type="radio" id="'  . $row["question_id"] . '-A" name="' . $row["question_id"] . '" value="' . $row["answer_1"] . '" required>';
				echo '<label class="form-check-label" for="'  . $row["question_id"] . '-A">A: ' . $row["answer_1"] . '</label><br>';
				echo '</div>';
				echo '<div class="form-check">';
				echo '<input class="form-check-input" type="radio" id="'  . $row["question_id"] . '-B" name="' . $row["question_id"] . '" value="' . $row["answer_2"] . '" required>';
				echo '<label class="form-check-label" for="'  . $row["question_id"] . '-B">B: ' . $row["answer_2"] . '</label><br>';
				echo '</div>';
				echo '<div class="form-check">';
				echo '<input class="form-check-input" type="radio" id="'  . $row["question_id"] . '-C" name="' . $row["question_id"] . '" value="' . $row["answer_3"] . '" required>';
				echo '<label class="form-check-label" for="'  . $row["question_id"] . '-C">C: ' . $row["answer_3"] . '</label><br>';
				echo '</div>';
				echo '<div class="form-check">';
				echo '<input class="form-check-input" type="radio" id="'  . $row["question_id"] . '-D" name="' . $row["question_id"] . '" value="' . $row["answer_4"] . '" required>';
				echo '<label class="form-check-label" for="'  . $row["question_id"] . '-D">D: ' . $row["answer_4"] . '</label><br>';
				echo '</div>';
				echo '</div>';
			}
		}
		?>
		<div class="container d-grid gap-2 d-md-grid justify-content-md-center">
			<input type="submit" value="Next" class="btn btn-lg btn-bd-red">
		</div>
	</form>
</div>

<?php
// Include footer.
require_once 'testfooter.php';
?>