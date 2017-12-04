# CSGOAced.xyz
# ![CSGOAced.xyz](https://raw.githubusercontent.com/CSGOAced/CSGOAced.xyz/master/img/thumbnail.png)

### What is this?
![CSGOAced.xyz](https://cloud.githubusercontent.com/assets/14254842/26793504/1d5c3814-4a16-11e7-9386-8cc69239af6e.png)
 [CSGOAced.xyz](https://www.csgoaced.xyz) is a Counter-Strike: Global Offensive coinflip betting website, created by me, [Tiago Severino](https://github.com/TiagoSeverino). It is no longer hosted, but you can view images of the site [here](http://imgur.com/a/st2di), or download and inspect the code yourself.

### How does CSGOAced.xyz work?
This is the repository for CSGOAced.xyz Website. It is written in HTML/CSS/JavaScript for the client-side, and PHP/Node.JS for the server-side.
Some libraries/frameworks Used:
* jQuery - http://jquery.com/
* Bootstrap - http://getbootstrap.com/
* Socket.io - https://socket.io/
* Clipboard.js - https://clipboardjs.com/
* jQuery Confirm - https://craftpip.github.io/jquery-confirm/
* jQuery AnimateNumber - http://aishek.github.io/jquery-animateNumber/
* SteamAuthentication - https://github.com/CSGOAced/SteamAuthentication/


In addition to the website, we are also using a SteamBot, which can be found [here](https://github.com/CSGOAced/CSGOAced.xyz-NodeServer), and is written in Node.JS.

### How to setup this project for my own use?
    git clone --recursive https://github.com/CSGOAced/CSGOAced.xyz
  - Rename and configure [Config File](https://github.com/CSGOAced/CSGOAced.xyz/blob/master/lib/controller/Config.php.default) to Config.php.
  - Rename and configure Database [Connection File](https://github.com/CSGOAced/CSGOAced.xyz/blob/master/lib/database/Connect.php.default) to Database.php.
  - Configure and Install Database with this [Instalation Script](https://github.com/CSGOAced/CSGOAced.xyz/blob/master/db_installation.sql).
  - Install CSGO Aced [SteamBot](https://github.com/CSGOAced/CSGOAced.xyz-NodeServer).
