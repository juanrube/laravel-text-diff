# 📘 text-diff

Una librería Laravel para comparar textos y mostrar diferencias visuales en HTML, basada en [jfcherng/php-diff](https://github.com/jfcherng/php-diff).

---

## 🚀 Instalación

Requiere PHP 8.1+ y Laravel 10+.

Instalar con Composer:

```bash
composer require juanrube/text-diff
```

Publicar los recursos (configuración, CSS, vistas):

```bash
php artisan vendor:publish --tag=text-diff
```

Configuración (opcional)

```php
return [
    'renderer' => 'Inline', // o 'SideBySide'
    'detail_level' => 'word', // o 'char'
    'insert_markers' => ['<ins>', '</ins>'],
    'delete_markers' => ['<del>', '</del>'],
];
```

Carga automática de estilos CSS
El paquete inyecta automáticamente los estilos necesarios mediante un View Composer global.
Solo usa {!! $textdiff !!} en cualquier plantilla Blade:

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Diff Example</title>
    {!! $textdiff !!}
</head>
<body>
    <x-text-diff :old-text="$oldText" :new-text="$newText" />
</body>
</html>
```

Uso del Componente Blade
```html
<x-text-diff :old-text="$oldText" :new-text="$newText" />
```

* old-text: Texto original.
* new-text: Texto modificado.

Uso del Facade
```php
use Juanrube\TextDiff\Facades\TextDiff;

// Generar diff HTML
$html = TextDiff::generateDiff($oldText, $newText);

// Obtener el tag de estilos
$cssLink = TextDiff::styleTag();
```

Publicación de recursos
```php
php artisan vendor:publish --tag=text-diff
```

Esto publica:

* config/textdiff.php (archivo de configuración)
* public/vendor/textdiff/textdiff.css (estilos CSS)
* resources/views/vendor/textdiff/components/diff.blade.php (vistas)

```html
Hola mundo<ins>!</ins><br>
Esta es una prueba <del></del><ins>editada</ins><br>
Otra línea <ins>nueva</ins>