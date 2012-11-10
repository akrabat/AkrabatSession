#AkrabatSession

This ZF2 module is intended to make it simple to change the settings of a 
session; specifically the most common change required is to set a name for
the cookie used to hold the session id.

##Installation

You have a number of choices for installing `AkrabatSession`:

### with Composer

Add `"akrabat/akrabat-session": "dev-master"` to your `composer.json` file and run `php composer.phar update`.

### by cloning the project

Clone this project into your `./vendor/` directory:

        git submodule add git://github.com/akrabat/AkrabatSession.git vendor/AkrabatSession

### as a Git Submodule

Clone this project into your `./vendor/` directory:

        cd vendor
        git clone git://github.com/akrabat/AkrabatSession.git

## Configuration

Once you have installed AkrabatSession, you need to enable it by editing 
`config/application.config.php` and adding `AkrabatSession` to the `modules`
section.

To configure the session as you required, add the following to your 
`config/autoload/global.php` file:

        'session' => array(
            'name' => 'MY_SESSION_NAME_HERE',
        ),

Add additional configuration keys as needed.


### Available configuration keys

The available configuration options are in the `Zend\Session\Config\SessionConfig`
and `Zend\Session\Config\StandardConfig` classes. Most map to the PHP level
[session directives](http://www.php.net/manual/en/session.configuration.php)


Some of the more useful ones are:

* `name` - Name of the session
* `remember_me_seconds` - Number of seconds to make session sticky, when rememberMe() is called. Default is 2 weeks (1209600 seconds)
* `save_path` - By default, the path where the session files are created
* `cookie_httponly` - Marks the cookie as accessible only through the HTTP protocol.
* `use_only_cookies` - Specifies that only cookies are used and not session ids in URLs

Note: `AkrabatSession` sets the `cookie_httponly` and `use_only_cookies` settings to true


## Session storage and save handler classes

If you need to set the SessionMangers's storage or save handler class, then
simply create a ServiceManager alias of `session_storage` or `session_save_handler`.
