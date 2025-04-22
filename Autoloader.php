<?php

namespace elitedrive; //A modifier
// Ici on donne le nom de la racine du namespace - conseillé de l'appeler par un nom unique et pas "app", pour la mise en ligne sur Git par ex

class Autoloader
{
    public static function register()
    {
        spl_autoload_register([
            __CLASS__,
            'autoload'
        ]);
    }
    // __CLASS__ constante magique qui lance la classe dans laquelle on est
    // méthodes statiques sont accessibles sans avoir à instancier la classe

    public static function autoload($class)
    {
        // Convertir le namespace en chemin de fichier
        // On retire App\ en utilisant str_replace avec chaîne recherchée antislash (et antislash avant pour échapper le caractère)
        $class = str_replace(__NAMESPACE__ . '\\', '', $class);
        // Maintenant on remplace antislash par slash
        $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
        // Constante magique qui récupère le dossier dans lequel on est, puis va chercher le chemin et le fichier
        $file = __DIR__ . '/' . $class . '.php';

        if (file_exists($file)) {
            require $file;
        }

        // echo $file;
    }
}
