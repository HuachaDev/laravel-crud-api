# API de Productos

## Descripción del Proyecto

La API de Productos permite gestionar un inventario de productos, incluyendo funcionalidades para listar, agregar, actualizar y eliminar productos.


### Tecnologías Utilizadas

- **Laravel V 10.48.22:**
- **PHP V8.1.6:** 
- **MySQL:**

### Importación de la Base de Datos
crear una base de datos: productManagement
php artisan migrate  

## Endpoints

### 1. Listar Productos
- **Método**: `GET`
- **Ruta**: `/productos`
- **Ejemplo de Respuesta**:
    ```json
    [
      { "id": 1, "nombre": "Producto A", "descripcion": "Descripción A", "precio": 100, "cantidad_stock": 50 },
      { "id": 2, "nombre": "Producto B", "descripcion": "Descripción B", "precio": 200, "cantidad_stock": 30 }
    ]
    ```

### 2. Crear Producto
- **Método**: `POST`
- **Ruta**: `/productos`
- **Ejemplo de Solicitud**:
    ```json
    { 
      "nombre": "Nuevo Producto", 
      "descripcion": "Descripción del nuevo producto", 
      "precio": 150, 
      "cantidad_stock": 20 
    }
    ```

### 3. Ver Detalle de Producto
- **Método**: `GET`
- **Ruta**: `/productos/{id}`
- **Ejemplo de Respuesta**:
    ```json
    { 
      "id": 1, 
      "nombre": "Producto A", 
      "descripcion": "Descripción A", 
      "precio": 100, 
      "cantidad_stock": 50,
      "created_at": "2024-01-01 00:00:00",
      "updated_at": "2024-01-01 00:00:00"
    }
    ```

### 4. Actualizar Producto
- **Método**: `PUT`
- **Ruta**: `/productos/{id}`
- **Ejemplo de Solicitud**:
    ```json
    { 
      "nombre": "Producto A Actualizado", 
      "descripcion": "Descripción actualizada", 
      "precio": 120, 
      "cantidad_stock": 40,
      "descuento_stock": 10 
    }
    ```
- **Descripción**: Si se incluye el campo `descuento_stock`, se descontará del stock actual del producto. Asegúrate de que el stock no sea negativo.

### 5. Eliminar Producto
- **Método**: `DELETE`
- **Ruta**: `/productos/{id}`
- **Ejemplo de Respuesta**:
    ```json
    { "message": "Producto 'Nombre del Producto' eliminado con éxito." }
    ```
- **Manejo de errores**: Si el producto no existe, se devolverá un mensaje de error:
    ```json
    { "error": "Producto no encontrado." }
    ```

1. **Clonar el repositorio**:
   ```bash
 
 
    ```

2. **Instalar las dependencias**:
    ```bash 
    composer install
     ```    
3. **Copiar  y editar archivo**:
    ```bash 
    cp .env.example .env
    
    Editar
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=productManagement
    DB_USERNAME=root
    DB_PASSWORD=
     ```    
  
2. **Levantar el servidor local**:
    ```bash 
       php artisan serve
     ```  
