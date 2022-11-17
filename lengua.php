<?php

$idioma = 'es';
/*if(in_array($_GET['idioma'],['es','en']))*/
if ($_GET && isset($_GET['idioma'])) {
    $idioma = in_array($_GET['idioma'], ['es', 'en']) ? $_GET['idioma'] : 'es';
}
//Cadena de textos en castellano e ingles
$cadenas = [
    'index' => [
        'es' => 'Bienvenid@ a Softonic©',
        'en' => 'Welcome to Softonic©'
    ],
    'cloud' => [
        'es' => 'Tus ficheros',
        'en' => 'Your files'
    ],
    'subir' => [
        'es' => 'Sube ficheros PDF o imágenes GIF, PNG y JPG',
        'en' => 'Upload PDF files or images GIF, PNG or JPG'
    ],
    'adminfich' => [
        'es' => 'Desde aqui puedes administrar tus ficheros',
        'en' => 'You can manage your files from here'
    ],
    'subirfich' => [
        'es' => 'Empieza a subir ficheros >>',
        'en' => 'Start uploading files >>'
    ],
    'nomfich' => [
        'es' => 'Nombre del fichero:',
        'en' => 'File name: '
    ],
    'selfich' => [
        'es' => 'Selecciona un fichero: ',
        'en' => 'Select a file: '
    ],
    'nonombre' => [
        'es' => '! Error: El nombre del fichero no es válido',
        'en' => '! Error: The file name is not valid'
    ],
    'nomrep' => [
        'es' => '! Error: Ya existe un fichero con ese nombre',
        'en' => '! Error: A file with that name already exists'
    ],
    'errfich' => [
        'es' => '! Error: No se ha podido subir el fichero',
        'en' => '! Error: The file could not be uploaded'
    ],
    'errext' => [
        'es' => '! Error: La extensión del fichero no está permitida',
        'en' => '! Error: The file extension is not allowed'
    ],
    'ficorrect' => [
        'es' => 'El fichero se ha subido correctamente',
        'en' => 'File uploaded succesfully!'
    ],
    'errnofich' => [
        'es' => 'No hay ficheros seleccionados',
        'en' => 'No files'
    ],
    'imgs' => [
        'es' => 'Tus imágenes',
        'en' => 'Your images'
    ],
    'home' => [
        'es' => 'Inicio',
        'en' => 'Home'
    ],
    'subir' => [
        'es' => 'Subir',
        'en' => 'Upload'
    ],
    'ficheros' => [
        'es' => 'Ficheros',
        'en' => 'Files'
    ]

];

function getCadena(string $id): string
{
    global $idioma, $cadenas;

    if (isset($cadenas[$id])) {
        return $cadenas[$id][$idioma];
    } else {
        return "Error interno: la cadena identificada con $id no existe";
    }
}