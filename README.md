#AkrabatSession

This ZF2 module is intended to make it simple to change the settings of a 
session; specifically the most common change required is to set a name for
the cookie used to hold the session id.

##Installation


### Git Submodule

Clone this project into your `./vendor/` directory

    cd vendor;
    git clone git://github.com/akrabat/AkrabatSession.git


## Configuration

Firstly, you need to edit `config/application.config.php` and add 
`AkrabatSession` to the  `modules` section

You then should add the following to your `config/autoload/global.php`:

        'session' => array(
            'name' => 'MY_SESSION_NAME_HERE',
        ),


### Available configuration keys

The available configuration options are in the `Zend\Session\Config\SessionConfig`
and `Zend\Session\Config\StandardConfig` classes. Most map to the PHP level
[session directives](http://www.php.net/manual/en/session.configuration.php)


Some The key ones are:

* `name` - Name of the session
* `remember_me_seconds` - Number of seconds to make session sticky, when rememberMe() is called. Default is 2 weeks (1209600 seconds)
* `save_path` - By default, the path where the session files are created
* `cookie_httponly` - Marks the cookie as accessible only through the HTTP protocol.
* `use_only_cookies` - Specifies that only cookies are used and not session ids in URLs

Note: `AkrabatSession` sets the `cookie_httponly` and `use_only_cookies` settings to true


## Session storage and save handler classes

If you need to set the SessionMangers's storage or save handler class, then
simply create a ServiceManager alias of `session_storage` or `session_save_handler`.
