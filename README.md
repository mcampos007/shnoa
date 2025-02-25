# WEB SHNOA

## Rama backend

Pasos a seguir para actualizar la rama remota de backend

1. Asegúrate de estar en la rama backend

   Primero, verifica que estás trabajando en tu rama backend. En tu terminal, ejecuta:

```bash
git checkout backend
```

2. Confirma que tus cambios están listos para ser enviados
   Asegúrate de haber agregado y confirmado todos los cambios necesarios:

```bash
git add .
git commit -m "Descripción clara de los cambios realizados"
```

3. Sincroniza la rama backend con el remoto
   Antes de subir tus cambios, obtén las actualizaciones remotas para evitar conflictos:

```bash
git pull origin backend
```

4. Sube los cambios a la rama remota backend
   Envía tus cambios al repositorio remoto:

```bash
git push origin backend
```

5. Sincroniza la rama main
   Si deseas actualizar la rama main con los cambios de backend, primero cambia a main:

```bash
git checkout main
```

Luego, combina los cambios desde backend en main:

```bash
git merge backend
```

6. Resuelve conflictos (si los hay)
   Si hay conflictos durante el proceso de fusión, resuélvelos manualmente en los archivos indicados. Una vez resueltos, confirma los cambios:

```bash
git add .
git commit -m "Resueltos conflictos en la fusión de backend en main"
```

7. Sube los cambios a la rama remota main
   Actualiza el repositorio remoto con los cambios de la rama main:

```bash
git push origin main
```

## Configuraciones para el envío de correo

- Debes configurar en .env y para el caso de enviar con gmail habilitar para usarlo en

```bash
https://myaccount.google.com/apppasswords?pli=1&rapt=AEjHL4MnErtmf5FpsYNlmVcTNUGzl-HIMjBVVR1AzEr_Ue4-i30wX_rUOzO9Wt-e3-swqkvMjKsZG9Gkg1V0Lk7Ot8TkxqgV2rC7LI6pUeiqqUs-QEF33tQ
```

```bash
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=tu-correo@gmail.com
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=tu-correo@gmail.com
MAIL_FROM_NAME="Tu Nombre o Empresa"
```

### consideraciones sobre php 8.2

- Para el registro de las imágenes se debe tner acceso a storage/public y re3visar .env y en /config/filesystems.php
