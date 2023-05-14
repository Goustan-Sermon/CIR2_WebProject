<?php
require_once('../../php/database.php');
// Enable all warnings and errors.
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection.
$db = dbConnect();
?>
<form action="test.php" method="post">
    <select class="form-select" name="semestre" required>
        <option selected disabled value="hey">Semestre</option>
        <?php
            $semestres = getSemestreOfEnseignant($db, '4');
            foreach($semestres as $semestre){
                echo '<option value="'.$semestre['id_semestre'].'">'.$semestre['nom_semestre'].'</option>';
            } 
        ?>
    </select>
    <button type="submit">Submit POST Data</button>

    
</form>

<?php
            print($_POST['semestre']);

?>