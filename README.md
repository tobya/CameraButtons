Script Control for Aver 520 Pro Camera
---

This laravel/php commandline app allows you to control Atem Pro 520 via its web interface.

I should be able to control this camera  via PTZ but doesnt seem to work for some reason.

I use it with Bitfocus Companion and a Stream Deck to send commands to the camara during a live shoot.

Install
----

> Git clone https://github.com/tobya/CameraButtons

> Composer install

Commands
----

## Move Camera to Preset

Move the camera to a specific preset.

- {camera} Camera Number read from config
- {preset} Preset number 0 - 9

````
php artisan camera:preset {camera} {preset}
````



````batchfile

php artisan camerabuttons:tokeninput

````

