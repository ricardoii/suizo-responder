# Suizo Responder

**Paquete Laravel para formatear respuestas JSON de forma estandarizada.**

Este paquete proporciona una forma consistente de estructurar las respuestas JSON para APIs Laravel, siguiendo un formato uniforme para respuestas exitosas y de error.

---

## 📦 Instalación

### 1. Registrar el repositorio VCS en tu `composer.json`

Agregá esta entrada dentro del array `"repositories"` en tu proyecto Laravel:

```json
"repositories": [
  {
    "type": "vcs",
    "url": "https://github.com/ricardoii/suizo-responder.git"
  }
]
```

---

### 2. Instalar el paquete

En consola:

```bash
composer require ricardoii/suizo-responder
```

Laravel detectará automáticamente el `ServiceProvider` y registrará el Facade `apisuizo()` gracias al archivo `composer.json` del paquete.

---

## 🧰 Funcionalidades disponibles

El paquete expone los siguientes métodos a través del facade `apisuizo()`:

### ✅ Respuestas exitosas

```php
apisuizo()->success(string $mensaje = null, mixed $data = null)
```

```php
return apisuizo()->success('Operación realizada con éxito', ['id' => 123]);
```

---

### ❌ Respuestas de error

```php
apisuizo()->error(string $mensaje = null, mixed $errores = null)
```

```php
return apisuizo()->error('Error interno del servidor');
```

---

### 📭 Not Found (404)

```php
apisuizo()->notFound(string $mensaje = null, mixed $errores = null)
```

```php
return apisuizo()->notFound('Recurso no encontrado');
```

---

### 🛑 Validación fallida (422)

```php
apisuizo()->validation(string $mensaje = null, mixed $errores = null)
```

```php
return apisuizo()->validation('Datos inválidos', $validator->errors());
```

---

### 🔐 No autorizado (401)

```php
apisuizo()->unauthorized(string $mensaje = null, mixed $errores = null)
```

```php
return apisuizo()->unauthorized('Token inválido');
```

---

### 🚫 Prohibido (403)

```php
apisuizo()->forbidden(string $mensaje = null, mixed $errores = null)
```

```php
return apisuizo()->forbidden('Acceso denegado');
```

---

### 💥 Error del servidor (500)

```php
apisuizo()->serverError(string $mensaje = null, mixed $errores = null)
```

```php
return apisuizo()->serverError('Error inesperado');
```

---

## 🧪 Estructura del JSON resultante

### Éxito:

```json
{
  "status": 200,
  "message": "Mensaje opcional",
  "data": {
    // contenido devuelto
  }
}
```

### Error:

```json
{
  "status": 500,
  "message": "Mensaje de error",
  "errors": [
    // array de errores
  ]
}
```

> El campo `errors` puede ser un array plano o un array asociativo (por ejemplo, errores de validación).

---

## 🧑 Autor

Ricardo Bazán  
Argentina, 2025  
Repositorio interno: [http://10.40.10.123:3030/ricardo.bazan/suizo-responder](http://10.40.10.123:3030/ricardo.bazan/suizo-responder)

---

## 📄 Licencia

Este paquete está licenciado bajo la [MIT License](LICENSE).
