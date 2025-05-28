# 📘 Laravel Text Diff 📘

Una librería Laravel para comparar textos y mostrar diferencias visuales en HTML, basada en [jfcherng/php-diff](https://github.com/jfcherng/php-diff).

---

## Instalación

Requiere PHP 8.1+ y Laravel 10+.

Instalar con Composer:

```bash
composer require juanrube/text-diff
```

Para Laravel menor a 9 utilizar la versión especifica
```bash
composer require juanrube/text-diff:"^1.0.0-laravel8"
```

Publicar los recursos (configuración, CSS, vistas):

```bash
php artisan vendor:publish --tag=text-diff
```
Esto publica:

* config/textdiff.php (archivo de configuración)
* public/vendor/textdiff/textdiff.css (estilos CSS)
* resources/views/vendor/textdiff/components/diff.blade.php (vistas)

Configuración (opcional)

```php
return [
    // renderer class name:
    'rendererName' => [
        'Combined',
        'Context',
        'Inline',
        'JsonHtml',
        'JsonText',
        'SideBySide',
        'Unified',
    ],

    // the Diff class options
    'differOptions' => [
        // show how many neighbor lines
        // Differ::CONTEXT_ALL can be used to show the whole file
        'context' => 3,
        // ignore case difference
        'ignoreCase' => false,
        // ignore line ending difference
        'ignoreLineEnding' => false,
        // ignore whitespace difference
        'ignoreWhitespace' => false,
        //
        //
    ],
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
    <x-text-diff :old-text="$oldText" :new-text="$newText" :title="$titulo">
        
        <!-- O incluso puedes usar el slot en lugar de $titulo -->
    
    <x-text-diff :old-text="$oldText" :new-text="$newText"
        <x-slot name="title">Mi título personalizado</x-slot>
    </x-text-diff>
</body>
</html>
```

Uso del Componente Blade
```html
    <x-text-diff :old-text="$oldText" :new-text="$newText" :title="$titulo">
        
        <!-- O -->
    
    <x-text-diff :old-text="$oldText" :new-text="$newText"
        <x-slot name="title">Mi título personalizado</x-slot>
    </x-text-diff>
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

Ejemplos renderizado
```html
Hola mundo<ins>!</ins><br>
Esta es una prueba <del></del><ins>editada</ins><br>
Otra línea <ins>nueva</ins>