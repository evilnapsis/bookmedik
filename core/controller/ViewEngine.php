<?php

/**
 * Clase ViewEngine
 * 
 * Helper / Wrapper para inicializar el motor de plantillas Twig y renderizar vistas HTML
 * con variables globales (base_url, session, flashes) inyectadas automáticamente.
 */
class ViewEngine {
    /** @var \Twig\Environment|null Instancia singleton de Twig */
    private static ?\Twig\Environment $twig = null;

    /**
     * Inicializa el entorno de Twig con el cargador de archivos desde la carpeta 'public'
     * @return \Twig\Environment
     */
    public static function init(): \Twig\Environment {
        if (self::$twig === null) {
            // Asegurar la carga de Twig si no se ha cargado previamente
            if (!class_exists('\Twig\Environment')) {
                if (file_exists(__DIR__ . '/../../vendor/autoload.php')) {
                    require_once __DIR__ . '/../../vendor/autoload.php';
                } elseif (file_exists(__DIR__ . '/../../legobox/vendor/autoload.php')) {
                    require_once __DIR__ . '/../../legobox/vendor/autoload.php';
                }
            }

            $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../../public');
            self::$twig = new \Twig\Environment($loader, [
                'cache' => false,
                'debug' => true,
            ]);
            
            // Cálculo de la URL base del proyecto para soportar subcarpetas dinámicamente
            $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME'] ?? ''), '/\\');
            self::$twig->addGlobal('base_url', $baseUrl);
            
            // Registro de globales y helpers para seguridad CSRF
            self::$twig->addGlobal('csrf_token', Session::csrfToken());
            self::$twig->addFunction(new \Twig\TwigFunction('csrf_field', function() {
                return '<input type="hidden" name="csrf_token" value="' . Session::csrfToken() . '">';
            }, ['is_safe' => ['html']]));
        }
        return self::$twig;
    }

    /**
     * Renderiza una plantilla Twig y la imprime en la salida HTTP
     * @param string $template Nombre del archivo relativo a 'public/' (ej. 'pacients/index.html.twig')
     * @param array $data Arreglo de variables a pasar a la vista
     */
    public static function render(string $template, array $data = []): void {
        $twig = self::init();
        $twig->addGlobal('session', $_SESSION ?? []);
        $twig->addGlobal('flashes', Session::getFlashes());
        echo $twig->render($template, $data);
    }
}
