

<?php

include_once './models/Elemento.php';




if (!empty(($_GET['id'])) && !empty(trim($_GET['id']))) {
     echo (Elemento::eliminar($_GET['id']));
} else {
     echo json_encode(['success' => false, 'message' => 'no has pasado get de id por xaamp', 'data' => null], JSON_PRETTY_PRINT);
}
