<html>
    <head>
        <title>Consumer Program</title>
    </head>
    <body>

		<h2>listAll</h2>
            <?php
            $json = file_get_contents("http://laptop-service/listAll");
            $obj = json_decode($json);
			$Opens = $obj->open;
			$Closes = $obj->close;
			echo "Open Time:\n";
            foreach ($Opens as $o) {
                echo "<li>$o</li>";
            }
			echo "Close Time:\n";
			foreach ($Closes as $c) {
				echo "<li>$c</li>";
			}
            ?>

		<h2>listAll Top=2</h2>
            <?php
            $json = file_get_contents("http://laptop-service/listAll/json?top=2");
            $obj = json_decode($json);
			$Opens = $obj->open;
			$Closes = $obj->close;
			echo "Open Time:\n";
            foreach ($Opens as $o) {
                echo "<li>$o</li>";
            }
			echo "Close Time:\n";
			foreach ($Closes as $c) {
				echo "<li>$c</li>";
			}
            ?>

		<h2>listAll/Csv Top=2</h2>
            <?php
                echo file_get_contents("http://laptop-service/listAll/csv?top=2");
            ?>

        <h2>listOpenOnly</h2>
            <?php
            $json = file_get_contents("http://laptop-service/listOpenOnly");
            $obj = json_decode($json);
			$Opens = $obj->open;
			echo "Open Time:\n";
            foreach ($Opens as $o) {
                echo "<li>$o</li>";
            }
            ?>
		
		<h2>listOpenOnly Top=4</h2>
            <?php
            $json = file_get_contents("http://laptop-service/listOpenOnly?top=4");
            $obj = json_decode($json);
			$Opens = $obj->open;
			echo "Open Time:\n";
            foreach ($Opens as $o) {
                echo "<li>$o</li>";
            }
            ?>

		<h2>listOpenOnly/Csv Top=4</h2>
            <?php
                echo file_get_contents("http://laptop-service/listOpenOnly/csv?top=4");
            ?>

		<h2>listCloseOnly</h2>
            <?php
            $json = file_get_contents("http://laptop-service/listCloseOnly");
            $obj = json_decode($json);
			$Closes = $obj->close;
			echo "Close Time:\n";
            foreach ($Closes as $c) {
                echo "<li>$c</li>";
            }
            ?>

		<h2>listCloseOnly Top=3</h2>
            <?php
            $json = file_get_contents("http://laptop-service/listCloseOnly?top=3");
            $obj = json_decode($json);
			$Closes = $obj->close;
			echo "Close Time:\n";
            foreach ($Closes as $c) {
                echo "<li>$c</li>";
            }
            ?>

		<h2>listCloseOnly/Csv Top=3</h2>
            <?php
                echo file_get_contents("http://laptop-service/listCloseOnly/csv?top=3");
            ?>
    </body>
</html>
