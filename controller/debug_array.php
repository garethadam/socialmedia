<div id="debug_array">
    <!-- This code creates a debug div that will print outline
            all the php $_POST, $_GET and $_SESSION details. -->
    <?php
    // DEBUG
    echo '<div class="debug"><pre><p>DEBUG</p>';
    echo '<p>Get:</p>';
    echo var_dump($_GET);
    echo '<br>';
    echo '<p>POST: </p>';
    echo var_dump($_POST);
    echo '<br>';
    echo '<p>SESSION:</p>';
    echo var_dump($_SESSION);
    echo '<br>';
    echo '</pre></div>';

	echo $error_message;

	?>
</div>
