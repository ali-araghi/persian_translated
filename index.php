<?php
  echo "Persian, Translated";
  $mysqli = new mysqli('localhost','admin','password','persian_translated');
  $mysqli->set_charset('utf8');
  if ($mysqli->connect_errno) {
      echo "Sorry, this website is experiencing problems.";
      echo "Error: Failed to make a MySQL connection, here is why: \n";
      echo "Errno: " . $mysqli->connect_errno . "\n";
      echo "Error: " . $mysqli->connect_error . "\n";
      exit;
  }
  function outputQuery($mysqli){
    $sql = 'SELECT ref_persons.person_name, translations.translation_title, translations.trans_pub_year
    FROM ref_persons, translations 
    WHERE translations.author_id = ref_persons.person_id';
    //'SELECT * from ref_persons'; 
        // run the query
    if (!$result = $mysqli->query($sql)) {
        // Handle error
        echo "Sorry, this website is experiencing problems.";
        echo "Error: Query failed to execute, here is why: \n";
        echo "Query: " . $sql . "\n";
        echo "Errno: " . $mysqli->errno . "\n";
        echo "Error: " . $mysqli->error . "\n";
        exit;
        }
        // If zero rows....
    if ($result->num_rows === 0) {
            echo "This query resulted in no matches returned. Please try again.";
            exit;
        }
    echo "<table>\n";
    while ($row = $result->fetch_assoc()) {
        echo " <tr>\n";
        echo "  <td>".$row['person_name']."</td>\n";
        echo "  <td>".$row['translation_title']."</td>\n";
        echo "  <td>".$row['trans_pub_year']."</td>\n";
        //echo "  <td>".$row['first_name_en']."</td>\n";
        //echo "  <td>".$row['last_name_en']."</td>\n";
        //echo "  <td>".$row['last_name_fa']."</td>\n";
        //echo "  <td>".$row['first_name_fa']."</td>\n";
        echo " </tr>\n";
    }
    echo "</table>";
  }
  outputQuery($mysqli);
  mysqli_close($mysqli);
  //echo "<img url='../images/".$cover_id.".jpg'>";
?>