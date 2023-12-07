<?php

function conectarDb(): mysqli
{
    $db = new mysqli('localhost', 'root', '1Coma4142', 'bienesraices_crud');

    if (!$db) {
        echo "Error: No se pudo conectar a MySQL.";
        exit;
    }

    return $db;
}
