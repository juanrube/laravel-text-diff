
---

# 📂 **Contenido de `/examples/example.blade.php`**

```blade
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Diff Example</title>
    {!! $textdiff !!}
</head>
<body>
    <h1>Comparación de Textos</h1>
    @php
        $oldText = "Hola mundo\nEsta es una prueba\nOtra línea";
        $newText = "Hola mundo!\nEsta es una prueba editada\nOtra línea nueva";
    @endphp
    <x-text-diff :old-text="$oldText" :new-text="$newText" />
</body>
</html>
