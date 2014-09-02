# wsend server in PHP

## Overview
[wsend](https://github.com/abemassry/wsend) is a Command Line Tool for sending files. In its default configuration it uploads files to wsend.net. While this is useful especially for users who don't want to have to setup their own server, sometimes you need to do just that.

This projects aims to provide an easy solution for that problem. It offers a PHP implementation of a server that can be used with wsend.

## Installation and Configuration (server side)

**Uploading the Files to your Web Host**
Upload the following two files to your web host:
- `.htaccess`
- `wsend-server.php`

**Creating the uploads Directory**
Create a directory for the uploads. This directory does not need to be in /var/www (or to whichever folder your web server is configured).
Make sure the web server can write to that directory:

    chown www-data:www-data /your/directory

**Configuring wsend-server.php**
Open `wsend-server.php` in any text editor and edit the following variables to suit your needs:
- `$server_url`: Set this to the URL you want your wsend server to be accessed at. Make sure to include the protocol (ie. http:// or https://).
- `$upload_dir`: Set this to the uploads directory you created. Don't forget the trailing slash.

## Configuration (client side)
First, install wsend as described in the official documentation.

Then, edit the wsend script (~/.wsend/wsend by default) and change `protocol` and `site`.

## Current Status
This project is in very early stages of development.
The following features are implemented already:
- Uploading files (i.e. wsend /path/to/your/file.ext)
- Viewing and downloading files (i.e. http://wsend.server.net/661e7921dc034cc2a4bdf6e8dd84be23/file.ext)

Currently, there is no user management. Anyone can upload files and there is no way of listing, changing or deleting them from the command line. However, you can of course just browse the uploads directory on the web server. If you want a list of the local files, use `wsend --list-local`.

## Important Notes
Please remember that this project is still work-in-progress. Not all features are implemented yet (see Current Status) and there may still be bugs.  
While I am trying to make sure that the version I upload to this repository is always safe to use, you have to keep the following things in mind:
- The wsend server is public. Anyone who knows the URL can freely upload files to it. Unfortunately, due to the few restrictions wsend imposes, this is likely to be abused for illegal purposes. If you want to only use your wsend server for yourself, currently you will have to use something like IP blocking on your web server. I do however plan to implement user management (and limited registration) in the future.
- I am not a security professional. I am of course trying my best to implement the appropriate precautions but there may still be security vulnerabilities in this software.
- There currently is not update mechanism, so you will have to check this repository regularly to make sure you don't miss important updates.
- As I have mentioned, this software is nowhere near complete. If you find any bugs, have suggestions or want to contribute, please feel free to contact me. Do however note that this is just a side-project and that I might not respond immediately.

## Questions
**Why did you use PHP? This could easily be implemented with node.js, ruby, [whatever].**  
I am most certainly aware that PHP is not considered a 'nice' language anymore. However, it gets the job done and it has two many advantages: Almost all web hosts support PHP and it is therefore easy and cheap for any user to set up their own wsend server. Furthermore, I know my way around PHP quite well, whilst my experience with node.js for example is quite limited :)  
I do however plan on implementing this server with node.js (and maybe other platforms) in the future. Stay tuned.

**Why don't you just buy an account at wsend.net and support the developers?**  
If a wsend.net account suits your needs, by all means buy one! wsend is an awesome piece of software and the developers definitely deserve your money. This project is in no way intended to get users away from wsend.net.  
There are however reasons that just make using a wsend.net account impossible. In those cases, you can use this project.

**Will the uploaded files be removed after 30 days like on wsend.net?**  
No. However, you could easily achieve that with a cron job and a small script.

**I have another question that is not listed here.**  
Feel free to contact me at kontakt@benjamin-altpeter.de. Do however note that this is just a side-project of mine and that I might not respond immediately.