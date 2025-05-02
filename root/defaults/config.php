<?php
/***************************************************************************
*                                                                          *
*            These apply everywhere and will need setting                  *
*                                                                          *
***************************************************************************/

$c->sysabbr     = 'DAViCal';

/****************************
********* Mandatory *********
*****************************/

/**
* Database connection: DAViCal will attempt to connect to the database by
* successively applying connection parameters from the array in
* $c->pg_connect.
*/
// $c->pg_connect[] = "dbname=DAVI_DATABASE user=DAVI_APPUSER";
$c->pg_connect[] = "dbname=DAVI_DATABASE user=DAVI_APPUSER port=PGPORT host=PGHOST password=DAVI_APPPASS";


/****************************
********* Desirable *********
*****************************/

/**
* "system_name" is used to specify the authentication realm of the server, as
* well as being used as a name to display in various places.
*
* Default: DAViCal CalDAV Server
*/
$c->system_name = "DAVI_SYSTNAME";

/**
* The CalDAV specification does not define GET on a collection, but typically
* this is used as a .ics download for the whole collection. This will also
* enable a download link in the web interface for calendars with entries.
*
* Default: false
*/
// $c->get_includes_subcollections = true;

/**
* If "readonly_webdav_collections" is true, then calendars accessed via WebDAV
* will be read-only. Any changes to them must be applied via CalDAV.
*
* You may want to set this to false during your initial setup to make it
* easier for people to PUT whole calendars or addressbooks as part of
* migrating their data. After this, it is recommended to turn it off so that
* clients which have been misconfigured are readily identifiable.
*
* Default: true
*/
// $c->readonly_webdav_collections = false;

/**
* This will allow failure on import of collections to apply only to an
* individual event that is faulty, rather than failing the whole collection.
*
* Default: false (fail whole collection)
*/
// $c->skip_bad_event_on_import = true;

/**
* Use memcache to cache various things. This is an array, allowing you to
* specify multiple memcache servers. Each each item in array is the server,
* port and priority. The priority is optional. For example, you can use the
* following to add two differnet servers, the second having a priority of 10.
*
* $c->memcache_servers[] = '127.0.0.1,11211';
* $c->memcache_servers[] = '127.0.0.2,11211,10';
*
* Default: none (memcache is not used)
*/
// $c->memcache_servers[] = '127.0.0.1,11211';


/***************************************************************************
*                                                                          *
*                         ADMIN web Interface                              *
*                                                                          *
***************************************************************************/

/**
* Address displayed on the login page to indicate who you should ask if you
* have problems logging on. Also for the "From" header of the email sent when
* a user has lost his password and clicks on the "Help! I've forgotten my
* password" on the login page.
*/
$c->admin_email = 'DAVI_ADMMAIL';

/**
* Set this to 'true' in order to restrict the /setup.php page (which contains
* the entire phpinfo() output) to 'Administrator' users.
*
* Default: false
*/
$c->restrict_setup_to_admin = true;

/**
* Restrict access to the administrative pages to only be available on a
* particular domain name and port. The default is that any DAViCal instance
* will have the administrative pages active. When any these settings is
* enabled, requests for administrative URLs such as index.php, admin.php,
* setup.php etc will be redirected to 'caldav.php', unless the restrictions
* are fulfilled.
*/
// $c->restrict_admin_domain = 'admin.davical.example.com';
// $c->restrict_admin_port   = '8443';

/**
* The "enable_row_linking" option controls whether javascript is used
* to make the entire row clickable in browse lists in the administration
* pages.  Since this doesn't work in Konqueror you may want to set this
* to false if you expect people to be using Konqueror with the DAViCal
* administration pages.
*
* Default: true
*/
// $c->enable_row_linking = false;

/**
* These should be an array of style sheets with a path specified relative
* to the root directory.  Used for overriding display styles in the admin
* interface.
*
* e.g. : $c->local_styles = array('/css/my.css');
*/
// $c->local_styles = array();
// $c->print_styles = array();

/**
* Allow users to see all accounts on the server in the web interface, or only
* their account and the accounts they have a relationship with. If set to
* false, users need the READ privilege to display another principal and their
* collections, and they need to be in the same group with another principal
* to find them in a drop-down list for granting privileges.
*
* Admins will still be able to see all accounts.
*
* Default: true
*/
// $c->list_everyone = false;

/**
* Provide a way of over-riding the default password change UI to render a
* clickable link instead. Usually the UI provides a pair of text boxes to
* enter a new password and confirm password. In some cases where remote
* authentication is being used, the password change process is managed in a
* more complex way and allowing it to be changed locally is not helpful. In
* this case the UI is disabled and an HREF displayed to take the user to the
& appropriate place for facilitating that.
*
* As well as the Administration UI, this will also affect the Forgotten
* Password UI since it would create a temporary local password. The login
* HTML rendered by libawl-php is over-ridden and replaced by the same HREF as
* above.
*
* Users with Administrator privileges will still see the default password
* change UI.
*
* Default: unset
*/
// $c->password_change_override = array(
//     'href'  => 'https://my.password/changer',
//     'label' => 'My Password Changer'
// );

/***************************************************************************
*                                                                          *
*                         Debug Options                                    *
*                                                                          *
***************************************************************************/

/**
* Whenever you think you've found an issue with how DAViCal handles a
* situation, generating some data on what it's actually doing and whether it
* can find a certain event in the database etc. can be essential to allow
* others (or yourself) to understand what's going wrong.
*
* There are many different types of debug messages (for more details see
* debug-config.php), but this will log them all:
*/
// $c->dbg["ALL"] = 1;

/**
* While the above setting will quickly fill your PHP error log and should
* best be restricted to one or two requests, logging just the client
* interaction is almost as useful. This should be the minimum for any support
* request on the mailing list or issue tracker.
*/
// $c->dbg["request"]  = 1;  // The request headers & content
// $c->dbg['response'] = 1;  // The response headers & content

/**
* Even on a moderately busy server, turning on debug logging for everyone can
* produce a lot of output in a short time that makes it hard to find the
* relevant lines. Debug filtering limits logging to certain IP addresses or
* usernames. (config values are arrays)
*/
// $c->dbg_filter["remoteIP"][] = '192.168.1.20';
// $c->dbg_filter["remoteIP"][] = '192.168.1.21';
// $c->dbg_filter["authenticatedUser"][] = 'peter';
// $c->dbg_filter["authenticatedUser"][] = 'john';


/***************************************************************************
*                                                                          *
*                         Caldav Server                                    *
*                                                                          *
***************************************************************************/

/**
* The "collections_always_exist" value defines whether a MKCALENDAR
* command is needed to create a calendar collection before calendar
* resources can be stored in it.  You will want to leave this to the
* default (true) if people will be using Evolution or Sunbird /
* Lightning against this because that software does not support the
* creation of calendar collections.
*
* Default: true
*/
// $c->collections_always_exist = false;

/**
* The name of a user's "home" calendar and addressbook. These will be created
* for each new user.
*
* Defaults:
*   home_calendar_name:    'calendar'
*   home_addressbook_name: 'addresses'
*/
// $c->home_calendar_name    = 'calendar';
// $c->home_addressbook_name = 'addresses';

/**
* Sets a numeric value indicating the maximum size in octets (bytes) of a
* resource that the server is willing to accept when an address object
* resource is stored in an address book collection (e.g. contacts with image
* attachments).
*
* Note that not all clients respect that property and that DAViCal won't deny
* creating or updating a resource that is larger than the specified limit if
* the client willingly or unwillingly ignores that property. Currently (late
* 2018) we only know of iOS devices to handle it properly.
*
* Default: 6550000
*/
// $c->carddav_max_resource_size = 6550000;

/**
* If the above options are not suitable for your new users, use this to
* create a more complex default collection management.
*
* Note: if you use this configuration option both $c->home_calendar_name and
*       $c->home_addressbook_name are ignored!
*
* See:
* https://wiki.davical.org/index.php/Configuration/settings/default_collections
*/
// $c->default_collections = array(
//     array(
//         'type' => 'addressbook',
//         'name' => 'addresses',
//         'displayname' => '%fn addressbook',
//         'privileges'  => null
//     ),
//     array(
//       'type' => 'calendar',
//       'name' => 'calendar',
//       'displayname' => '%fn calendar',
//       'privileges'  => null
//     )
// );

/**
* An array of groups / permissions which should be automatically added
* for each new user created.  This is a crude mechanism which we
* will hopefully manage to work out some better approach for in the
* future.  For now, create an array that looks something like:
*   array( 9 => 'R', 4 => 'A' )
* to create a 'read' relationship to user_no 9 and an 'all' relation
* with user_no 4.
*
* Default: none
*/
// $c->default_relationships = array();

/**
* An array of the privileges which will be configured for a user by default
* from the possible set of real privileges:
*   'read', 'write-properties', 'write-content', 'unlock', 'read-acl',
*   'read-current-user-privilege-set', 'bind', 'unbind', 'write-acl',
*   'read-free-busy', 'schedule-deliver-invite', 'schedule-deliver-reply',
*   'schedule-query-freebusy', 'schedule-send-invite', 'schedule-send-reply',
*   'schedule-send-freebusy'
*
* Or also from these aggregated privileges:
*   'write', 'schedule-deliver', 'schedule-send', 'all'
*/
$c->default_privileges = array('all'); // default: array('read-free-busy', 'schedule-query-freebusy');

/**
* An array of fields on the usr record which should be set to specific
* values when the users are created.
*
* Default: none
*/
// $c->template_usr = array(
//     'active' => true,
//     'locale' => 'it_IT',
//     'date_format_type' => 'E',
//     'email_ok' => date('Y-m-d')
// );

/**
* If "hide_TODO" is true, then VTODO requested from someone other than the
* admin or owner of a calendar will not get an answer. Often these todo are
* only relevant to the owner, but in some shared calendar situations they
* might not be in which case you should set this to false.
*
* Default: true
*/
// $c->hide_TODO = false;

/**
* If true, then VALARM from someone other than the admin or owner of a
* calendar will not be included in the response. The default is false because
* the preferred behaviour is to enable/disable the alarms in your CalDAV
* client software.
*
* Default: false
*/
// $c->hide_alarm = true;

/**
* If you want to hide older events (in order to save resources, speed up
* clients, etc.) define the desired time interval in number of days.
*/
// $c->hide_older_than = 90;

/**
* Hide bound collections from certain clients
*
* If you want to use iOS (which does not support delegation) in combination
* with other software which do support delegation, you can use this option
* to tailor a working solution: bind all collections you want to see on iOS
* (emulation of delegation) and then hide these collections from other
* clients with real delegation support.
*
* Default: false/not set: always show bound collections
*
* If set to true: never show bound collections
* If set to an array: hide if any header => regex tuple matches
* Example: Hide bound collections from clients which send a User-Agent header
* matching regex1 OR an X-Client header matching regex2
*/
// $c->hide_bound = array( 'User-Agent'=>'#regex1#', 'X-Client'=>'#regex2#');

/**
* External subscription (BIND) minimum refresh interval (minutes)
* Required if you want to enable remote binding ( webcal subscriptions )
*
* Default: 60
*/
// $c->external_refresh = 60;

/**
* External subscription (BIND) user agent string
* You may need to set a specific stirng if your remote calendar only delivers
* to known user agents.
*
* Default: DAViCal/$version
*/
// $c->external_ua_string = "DAViCal/" . $c->version_string;

/**
* If you want to force DAViCal to use HTTP Digest Authentication for CalDAV
* access. Note that this requires all user passwords to be stored in plain
* text in the database. It is probably better to configure the webserver to
* do Digest auth against a separate user database (see below for Webserver
* Auth).
*/
// $c->http_auth_mode = "Digest";

/**
* Provide freebusy information to any (unauthenticated) user via the
* freebusy.php URL. Only events marked as PRIVATE will be excluded from the
* report.
*
* Default: false (authentication required)
*/
// $c->public_freebusy_url = true;

/**
* The "support_obsolete_free_busy_property" value controls whether,
* during a PROPFIND, the obsolete Scheduling property
* "calendar-free-busy-set" is returned. Set the value to true to support the
* property only if your client requires it, however note that PROPFIND
* performance may be adversely affected if you do so.
*
* Introduced in DAViCal version 1.1.4 in support of Issue #31 Database
* Performance Improvements.
*
* Default: false
*/
// $c->support_obsolete_free_busy_property = false;

/**
* The default locale will be "en_NZ";
*
* If you are in a non-English locale, you can set the default_locale
* configuration to one of the supported locales.
*
* Supported Locales (at present, see: "select * from supported_locales ;" for
* a full list):
*
*     "de_DE", "en_NZ", "es_AR", "fr_FR", "nl_NL", "ru_RU"
*
* If you want locale support you probably know more about configuring it than
* me, but at this stage it should be noted that all translations are UTF-8,
* and pages are served as UTF-8, so you will need to ensure that the UTF-8
* versions of these locales are supported on your system.
*
* People interested in providing new translations are directed to the Wiki:
*   https://wiki.davical.org/w/Translating_DAViCal
*/
$c->default_locale = "DAVI_LOCALE";

/**
* This is used to construct URLs which are passed in the answers to the
* client.  You may want to force this to a specific domain in responses if
* your system is accessed by multiple names, otherwise you probably won't
* need to change it.
*
* Default: $_SERVER['SERVER_NAME']
*/
$c->domain_name = 'DAVI_HOSTNAME';

/**
* If this option is set to true, then "@$c->domain_name" is appended to the
* user login name if it does not contain the @ character. If email addresses
* are used as user names in Davical, this fixes a problem with MacOS X 10.6
* Addressbook that cannot login to CardDav account.
*
* Default: false
*/
// $c->login_append_domain_if_missing = true;

/**
* Many people want this, but it may be a security issue for you, so it is
* disabled by default.  If you enable it, then confidential / private events
* will be visible to the 'organizer' or 'attendee' lists.  The reason that
* this becomes a security issue is that this identification needs to be based
* on the user's e-mail address.  The user's e-mail address is generally
* something which they can set, so they could change it to be the address of
* an attendee of a meeting and then would be able to read the meeting.
*
* Without this, the only person who can view/change PRIVATE or CONFIDENTIAL
* events in a calendar is someone with full administrative rights to the
* calendar usually the owner.
*
* If the only person that devious is your sysadmin then you probably already
* enabled this option...
*
* Default: false
*/
// $c->allow_get_email_visibility = false;

/**
* Disable calendar-proxy-{read,write} on PROPFIND
*
* This can be useful if clients are known to not use this information,
* as it is very expensive to compute (especially on servers with lots of
* users who share their collections) and most clients will never use it,
* or ask for it explicitly using an expand-property REPORT, which is not
* affected by this option.
*
* Default: false/unset
*
* If set to false (or unset): always show
* If set to true: never show
* If set to an array: hide if any header => regex tuple matches
*/
// $c->disable_caldav_proxy_propfind_collections = array(
//     'User-Agent' => '#regex1#',
//     'X-Client'   => '#regex2#'
// );

/**
* A limiter on how many times we'll apply the recurrence rules for an event
* to find the next valid one.
*
* Default: 100
*
* If you see the following error message, you may want to consider increasing
* it:
* RRULE, loop limit has been hit in GetMoreInstances, you probably want to
* increase $c->rrule_loop_limit
*/
// $c->rrule_loop_limit = 100;

/**
* EXPERIMENTAL:
* If true, names of groups (prefixed with "@") given as an event attendee
* will get resolved to a list of members of that group. Note that CalDAV
* clients might get confused by this server behavior until they get
* synced again.
*
* Default: false.
*/
// $c->enable_attendee_group_resolution = true;


/***************************************************************************
*                                                                          *
*                             Scheduling                                   *
*                                                                          *
***************************************************************************/

/**
* If you want to turn off scheduling functions you can set this to 'false'
* and DAViCal will not advertise the ability to schedule, leaving it to
* calendar clients to send out and receive scheduling requests.
*
* Default: true
*/
// $c->enable_auto_schedule = false;

/**
* If true, then remote scheduling will be enabled.  There is a possibility
* of receiving spam events in calendars if enabled, you will at least know
* what domain the spam came from as domain key signatures are required for
* events to be accepted.
*
* You probably need to setup Domain Keys for your domain as well as the
* appropriate DNS SRV records.
*
* for example, if DAViCal is installed on cal.example.com you should have
* DNS SRV records like this:
* _ischedules._tcp.example.com. IN SRV 0 1 443 cal.example.com
* _ischedule._tcp.example.com.  IN SRV 0 1  80 cal.example.com
*
* DNS TXT record for signing outbound requests example:
* cal._domainkey.example.com. 86400 IN   TXT     "k=rsa\; t=s\; p=PUBKEY"
*
* Default: false
*/
// $c->enable_scheduling = true;

/**
* Domain Key domain to use when signing outbound scheduling requests, this
* is the domain with the public key in a TXT record as shown above.
*
* TODO: enable domain/signing by per user keys, patches welcome.
*
* Default: none
*/
// $c->scheduling_dkim_domain = '';

/**
* Domain Key selector to use when signing outbound scheduling requests.
*
* TODO: enable selectors/signing by per user keys, patches welcome.
*
* Default: 'cal'
*/
// $c->scheduling_dkim_selector = 'cal';

/*
* Domain Key private key
* Required if you want to enable outbound remote server scheduling
*
* Default: none
*/
// $c->schedule_private_key = 'PRIVATE-KEY-BASE-64-DATA';


/***************************************************************************
*                                                                          *
*                     Operation behind a Reverse Proxy                     *
*                                                                          *
***************************************************************************/

/**
* If you install DAViCal behind a reverse proxy (e.g. an SSL offloader or
* application firewall, or in order to present services from different
* machines on a single public IP / hostname), the client IP, protocol and
* port used may be different from what the web server is reporting to
* DAViCal. Often, the original values are written to the X-Real-IP and/or
* X-Forwarded-For, X-Forwarded-Proto and X-Forwarded-Port headers. You can
* instruct DAViCal to attempt to "do the right thing" and use the content of
* these headers instead, when they are available.
*
* CAUTION: Malicious clients can spoof these headers. When you enable this,
* you need to make sure your reverse proxy erases any pre-existing values of
* all these headers, and that no untrusted requests can reach DAViCal without
* passing the proxy server.
*
* Default: false
*/
// $c->trust_x_forwarded = true;

/**
* Instead or in addition to the above, you can compute, override or unset the
* relevant variables. This is a catch-all for non-standard or advanced
* environments.
*/

/* Unset X-Real-IP, as it's not controlled by the reverse proxy. */
// unset( $_SERVER['HTTP_X_REAL_IP'] );
// $c->trust_x_forwarded = true;

/* Set all values manually. */
// $_SERVER['HTTPS'] = 'on';
// $_SERVER['SERVER_PORT'] = 443;
// $_SERVER['REMOTE_ADDR'] = $_SERVER['Client-IP'];


/***************************************************************************
*                                                                          *
*                     Authentication Settings                              *
*                                                                          *
***************************************************************************/

/**
* Cache credentials, requires memcache_servers to be defined.
*
* If you enable this, please ensure that your memcached server(s) are
* suitably protected. While we store the credentials hashed in memcached,
* you may still be exposing youself, please ensure you understand the risk
* you may be taking by enabling this feature.
*
* We use HMAC-SHA256 and bcrypt using the password set in
* $c->auth_cache_secret as a pepper and a per user salt that is generated
* as required and cached for 10 days.
*
* Both the hash and the per user salt are stored in memcached. The hash has
* an expiry set as either $c->auth_cache_pass or $c->auth_cache_fail as
* appropriate. You must enable either (or both) of these with suitable
* expiry times (15 minutes?) based on your requirements.
*
* Default: false
*/
// $c->auth_cache = false;

/**
* Secret to use for caching passwords (aka pepper). For example, the output
* of:
*     pwgen 32
*
* Default: unset, which disables caching
*/
// $c->auth_cache_secret = NULL;

/**
* How long to cache credentials where username & password match (seconds).
*
* Default: 0 (aka don't cache passwords that match)
*/
// $c->auth_cache_pass = 0;

/**
* How long to cache credentials where username & password don't match
* (seconds).
*
* Default: 0 (aka don't cache passwords that don't match)
*/
// $c->auth_cache_fail = 0;

/***************************************************************************
*                                                                          *
*                     External Authentication Sources                      *
*                                                                          *
***************************************************************************/

/**
* Allow specifying another way to control access of the user by
* authenticating them against other drivers such as LDAP (the default is the
* PostgreSQL DB).
*
* $c->authenticate_hook['call'] should be set to the name of the plugin and
* must be a valid function that will be call like this:
*   call_user_func( $c->authenticate_hook['call'], $username, $password )
*
* The login mechanism is used in 2 different places:
*  - for the web interface in: index.php that calls DAViCalSession.php that
*    extends Session.php (from AWL libraries)
*  - for the caldav client in: caldav.php that calls HTTPAuthSession.php
* Both Session.php and HTTPAuthSession.php check against the
* authenticate_hook['call'], although for HTTPAuthSession.php this will be
* for each page.  For Session.php this will only occur during login.
*
* $c->authenticate_hook['config'] should be set up with any configuration
* data needed by the authenticate call - see below or in the Wiki for
* details.
*
* If you want to develop your own authentication plugin, have a look at
* awl/inc/AuthPlugins.php or any of the inc/drivers_*.php files.
*
* $c->authenticate_hook['optional'] = true; can be set to try default
* authentication as well in case the configured hook should report a failure.
*/
// $c->authenticate_hook['optional'] = true;

/********************************/
/******* Other AWL hook *********/
/********************************/
// require_once('auth-functions.php');
//  $c->authenticate_hook = array(
//      'call'   => 'AuthExternalAwl',
//      'config' => array(
//           // A PgSQL database connection string for the database
//           // containing user records
//          'connection' => 'dbname=wrms host=otherhost port=5433 user=general',
//           // Which columns should be fetched from the database
//          'columns'    => "user_no, active, email_ok, joined, last_update AS updated, last_used, username, password, fullname, email",
//           // a WHERE clause to limit the records returned.
//          'where'    => "active AND org_code=7"
//      )
//  );


/********************************/
/*********** LDAP hook **********/
/********************************/
/*
* For Active Directory go down to the next example.
*/

// $c->authenticate_hook['call'] = 'LDAP_check';
// $c->authenticate_hook['config'] = array(
//     /* Use URI to set one or more LDAP servers to connect to for
//      * redundancy. Also supports ldaps.
//      * If no URI string is set, host and port can be used */
//     'uri'  => 'ldaps://hostname:port ldap://hostname2:port2'
//     'host' => 'ldap.example.net', // host name of your LDAP Server
//     'port' => '389',              // port

       /* For the initial bind to be anonymous leave bindDN and passDN
        * commented out */
// DN and password if required to bind to this server for initial queries
//     'bindDN' => 'cn=calendar-manager,ou=users,dc=example,dc=net',
//     'passDN' => 'xxxxxxxx',

//     /* Perform a SASL bind instead of a simple bind. Uncomment this option
//      * to authenticate to the LDAP server using Kerberos credentials or TLS
//      * certificates.
//      * Depending on the SASL mechanism used, you may need to set some of the
//      * sasl_ options below. You may also need to set environment variables
//      * in the PHP process (KRB5CCNAME, LDAPTLS_CERT, LDAPTLS_KEY, etc).
//      */
//     'sasl'          => 'yes',
//     'sasl_mech'     => 'GSSAPI',
//     'sasl_realm'    => 'EXAMPLE.COM',
//     'sasl_authc_id' => null,
//     'sasl_authz_id' => null,
//     'sasl_props'    => null,

//     'protocolVersion' => '3', // version of LDAP protocol to use
//     'optReferrals'    => 0,   // whether to automatically follow referrals
//                               // returned by the LDAP server
//     'networkTimeout'  => 10,  // timeout in seconds

       /* where to look for users */
//     'baseDNUsers'  => 'ou=users,dc=example,dc=net',

       /* filter which must validate a user according to RFC4515, i.e.
        * surrounded by brackets. Default is (objectClass=*). You
        * should check what objectClass is used for your user accounts  */
//     'filterUsers'  => 'objectClass=Person',

       /* where to look for groups */
//     'baseDNGroups' => 'ou=divisions,dc=example,dc=net',

       /* filter with same rules as filterUsers, and the same default. You
        * should check what is used for your groups. */
//     'filterGroups' => 'objectClass=groupOfNames',

       /* /!\ "username" should be set and "modified" must be set
        * used to create the user based on their ldap properties */
//     'user_mapping_field' => array(
//         "username" => "uid",
//         "modified" => "modifyTimestamp",
//         "fullname" => "cn",
//         "email"    => "mail"
//     ),

       /* used to create the group based on the ldap properties */
//     'group_mapping_field' => array(
//         "name"     => "cn",
//         "modified" => "modifyTimestamp",
//         "members"  => "member"
//     ),

       /** used to set default value for all users, will be overcharged by
         * ldap if defined also in mapping_field **/
//     'default_value' => array(
//         "date_format_type" => "E",
//         "locale" => "fr_FR"
//     ),

       /** foreach key set start and length in the string provided by ldap
           example for openLDAP timestamp : 20070503162215Z **/
//     'format_updated' => array(
//         'Y' => array(0,4),
//         'm' => array(4,2),
//         'd' => array(6,2),
//         'H' => array(8,2),
//         'M' => array(10,2),
//         'S' => array(12,2)
//     ),

//     'startTLS' => 'yes',  // Require that TLS is used for LDAP?
             // If ldap_start_tls is not working, it is probably
             // because php wants to validate the server's
             // certificate. Try adding "TLS_REQCERT never" to the
             // ldap configuration file that php uses (e.g. /etc/ldap.conf
             // or /etc/ldap/ldap.conf). Of course, this lessens security!
//      'scope' => 'subtree', // Search scope to use, defaults to subtree.
//                            // Allowed values: base, onelevel, subtree.
//
//    );
//
// /* If there is some user/group you do not want to sync from LDAP, put
//  * their username in these lists */
// $c->do_not_sync_from_ldap = array( 'admin' => true );
// $c->do_not_sync_group_from_ldap = array( 'teamclient1' => true );
//
// include('drivers_ldap.php');

/*
* Use the following LDAP example if you are using Active Directory
*
* You will need to change host, passDN and DOMAIN in bindDN
* and baseDNUsers.
*/
// $c->authenticate_hook['call'] = 'LDAP_check';
// $c->authenticate_hook['config'] = array(
//     'host'              => 'ldap://ldap.example.net',
//     'port'              => '389', // usually 636 for ldaps
//     'sasl'              => 'yes',
//     'sasl_mech'         => 'GSSAPI',
//     'sasl_realm'        => 'EXAMPLE.COM',
//     'sasl_authc_id'     => null,
//     'sasl_authz_id'     => null,
//     'sasl_props'        => null,
//     'bindDN'            => 'cn=bind-user,cn=Users,dc=example,dc=net',
//     'passDN'            => 'secret',
//     'baseDNUsers'       => 'dc=example,dc=net',
//     'protocolVersion'   => 3,
//     'optReferrals'      => 0,
//     'networkTimeout'    => 10,
//     'filterUsers'       => '(&(objectcategory=person)(objectclass=user)(givenname=*))',
//     'mapping_field'     => array(
//         "username" => "sAMAccountName",
//         "fullname" => "displayName" ,
//         "email"    => "mail",
//         "modified" => ""
//     ),
//     'default_value'     => array(
//         "date_format_type" => "E",
//         "locale" => "en_NZ"
//     ),
//     'format_updated'    => array(
//         'Y' => array(0,4),
//         'm' => array(4,2),
//         'd' => array(6,2),
//         'H' => array(8,2),
//         'M' => array(10,2),
//         'S' => array(12,2)
//     )
// );
//
// /* If there is some user/group you do not want to sync from LDAP, put
//  * their username in these lists */
// $c->do_not_sync_from_ldap = array( 'admin' => true );
// $c->do_not_sync_group_from_ldap = array( 'teamclient1' => true );
//
// include('drivers_ldap.php');

// /* Kerberus configuration
//  *
//  * You may want your webserver to perform Kerberos SSO, in which case
//  * REMOTE_USER should be trusted. If that is the case, then set
//  * 'i_use_mode_kerberos' there are two options, neither are the default:
//  *
//  * * 'i_know_what_i_am_doing' means to trust REMOTE_USER, do not try and
//  *   authenticate to LDAP
//  * * 'allow_fallback_to_ldap_auth' means to trust REMOTE_USER, but if
//  *   it isn't present, try and authenticate to LDAP. This allows using
//  *   Kerberos for SSO, but still allows non-Kerberos supporting clients
//  *   to still use username/password login.
//  *
//  * If either are set, then we still get details from LDAP for the user.
//  *
//  * Either include this in the above authenticate_hook config setting,
//  * or use: */
//
//  $c->authenticate_hook['config']['i_use_mode_kerberos'] = '';

/********************************/
/****** PAM and IMAP hooks ******/
/********************************/

/**
* Authentication against PAM using the Squid helper script.
*/
// $c->authenticate_hook = array(
//     'call'   => 'SQUID_PAM_check',
//     'config' =>  array(
//         'script' => '/usr/bin/pam_auth',
//         'email_base' => 'example.com'
//     )
// );
// include('drivers_squid_pam.php');

/**
* Authentication against PAM/system password database using pwauth.
*/
// $c->authenticate_hook = array(
//     'call'       => 'PWAUTH_PAM_check',
//     'config'     => array(
//         'path' => '/usr/sbin/pwauth',
//         'email_base' => 'example.com'
//     )
// );
// include('drivers_pwauth_pam.php');

/********************************/
/****** Webserver does Auth *****/
/********************************/

/**
* It is quite common that the webserver can do the authentication for you,
* and you just want DAViCal to trust the username that the webserver will
* pass through (in the REMOTE_USER or REDIRECT_REMOTE_USER environment
* variable). In that case, set server_auth_type (can be an array) to the
* value provided by the webserver in the AUTH_TYPE environment variable, as
* well as the two following options as needed.
*
* Note that this method does not pull account details from anywhere, so you
* will first need to create an account in DAViCal for each username that will
* authenticate in this way - it's just that the password on that account will
* be ignored and authentication will happen through the authentication method
* that the webserver is configured with.
*/
// $c->authenticate_hook['server_auth_type'] = 'Basic';

/**
* Uncomment this to use Webserver Auth for CalDAV access in addition to the
* Admin web pages.
*/
// include_once('AuthPlugins.php');

/**
* If your Webserver Auth method provides a logout URL (traditional Basic Auth
* does not), you can enter it here so the Logout link in the Admin web pages
* can point to it.
*/
// $c->authenticate_hook['logout'] = '/logout';


/***************************************************************************
*                                                                          *
*                         Push Notification Server                         *
*                                                                          *
***************************************************************************/

/*
* This enable XMPP PubSub push notifications to clients that request them.
* N.B. this will publish URLs for ALL updates and does NOT restrict
* subscription permissions on the Jabber server!  That means anyone with
* read access to the pubsub tree of your jabber server can watch for updates,
* they will only see URLs to the updated entries not the calendar data.
*
* Only tested with ejabberd 2.0.x
*/

// $c->notifications_server = array(
//     /* jabber server hostname */
//     'host' => $_SERVER['SERVER_NAME'],
//     /* user(JID) to login/ publish as */
//     'jid'  => 'user@example.com',
//     /* password for above account */
//     'password' => '',
//     /* send a copy of all publishes to this jid */
//     // 'debug_jid' => 'otheruser@example.com'
// );
//
// include ( 'pubsub.php' );


/***************************************************************************
*                                                                          *
*                             Detailed Metrics                             *
*                                                                          *
***************************************************************************/

/*
* This enables a /metrics.php URL containing detailed metrics about the
* operation of DAViCal.  Ideally you will be running memcache if you are
* interested in keeping metrics, but there is a simple metrics collection
* available to you without running memcache.
*
* Note that there is currently no way of enabling metrics via memcache
* without memcache being enabled for all of DAViCal.
*/

/* Just the simple counter-based metrics */
$c->metrics_style = 'counters';

/* Only the metrics using memcache */
// $c->metrics_style = 'memcache';

/* Both styles of metrics */
// $c->metrics_style = 'both';

/* Restrict access to only this IP address */
// $c->metrics_collectors   = array('127.0.0.1');

/* Restrict access to only connections authenticating as this user */
$c->metrics_require_user = 'admin'; // default: 'metricsuser';

/***************************************************************************
*                                                                          *
*                               Audit Logging                              *
*                                                                          *
***************************************************************************/
/* To enable audit logging to syslog you can uncomment the following line.
*
* This file is suitable for basic auditing, if you want/need more
* comprehensive logging then see:
*   http://wiki.davical.org/index.php/Configuration/hooks/log_caldav_action
*/
// include('log_caldav_action.php');

