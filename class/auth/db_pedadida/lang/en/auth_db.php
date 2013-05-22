<?php
// This file is not part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Strings for component 'auth_db_pedadida', language 'en'.
 *
 * @package   auth_db_pedadida
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['auth_db_pedadidacantconnect'] = 'Could not connect to the specified authentication database...';
$string['auth_db_pedadidadebugauthdb'] = 'Debug ADOdb';
$string['auth_db_pedadidadebugauthdbhelp'] = 'Debug ADOdb connection to external database - use when getting empty page during login. Not suitable for production sites.';
$string['auth_db_pedadidadeleteuser'] = 'Deleted user {$a->name} id {$a->id}';
$string['auth_db_pedadidadeleteusererror'] = 'Error deleting user {$a}';
$string['auth_db_pedadidatitle'] = 'Pedadida Authentication';
$string['pluginname'] = 'Pedadida Authentication';
$string['auth_db_pedadidadescription'] = 'This method uses an external database table to check whether a given username and password is valid.  If the account is a new one, then information from other fields may also be copied across into Moodle.';
$string['auth_db_pedadidaextencoding'] = 'External db encoding';
$string['auth_db_pedadidaextencodinghelp'] = 'Encoding used in external database';
$string['auth_db_pedadidaextrafields'] = 'These fields are optional.  You can choose to pre-fill some Moodle user fields with information from the <b>external database fields</b> that you specify here. <p>If you leave these blank, then defaults will be used.</p><p>In either case, the user will be able to edit all of these fields after they log in.</p>';
$string['auth_db_pedadidafieldpass'] = 'Name of the field containing passwords';
$string['auth_db_pedadidafieldpass_key'] = 'Password field';
$string['auth_db_pedadidafielduser'] = 'Name of the field containing usernames';
$string['auth_db_pedadidafielduser_key'] = 'Username field';
$string['auth_db_pedadidahost'] = 'The computer hosting the database server.';
$string['auth_db_pedadidahost_key'] = 'Host';
$string['auth_db_pedadidachangepasswordurl_key'] = 'Password-change URL';
$string['auth_db_pedadidainsertuser'] = 'Inserted user {$a->name} id {$a->id}';
$string['auth_db_pedadidainsertuserduplicate'] = 'Error inserting user {$a->username} - user with this username was already created through \'{$a->auth}\' plugin.';
$string['auth_db_pedadidainsertusererror'] = 'Error inserting user {$a}';
$string['auth_db_pedadidaname'] = 'Name of the database itself';
$string['auth_db_pedadidaname_key'] = 'DB name';
$string['auth_db_pedadidapass'] = 'Password matching the above username';
$string['auth_db_pedadidapass_key'] = 'Password';
$string['auth_db_pedadidapasstype'] = '<p>Specify the format that the password field is using. MD5 hashing is useful for connecting to other common web applications like PostNuke.</p> <p>Use \'internal\' if you want to the external DB to manage usernames &amp; email addresses, but Moodle to manage passwords. If you use \'internal\', you <i>must</i> provide a populated email address field in the external DB, and you must execute both admin/cron.php and auth/db_pedadida/cli/sync_users.php regularly. Moodle will send an email to new users with a temporary password.</p>';
$string['auth_db_pedadidapasstype_key'] = 'Password format';
$string['auth_db_pedadidareviveduser'] = 'Revived user {$a->name} id {$a->id}';
$string['auth_db_pedadidarevivedusererror'] = 'Error reviving user {$a}';
$string['auth_db_pedadidasetupsql'] = 'SQL setup command';
$string['auth_db_pedadidasetupsqlhelp'] = 'SQL command for special database setup, often used to setup communication encoding - example for MySQL and PostgreSQL: <em>SET NAMES \'utf8\'</em>';
$string['auth_db_pedadidasuspenduser'] = 'Suspended user {$a->name} id {$a->id}';
$string['auth_db_pedadidasuspendusererror'] = 'Error suspending user {$a}';
$string['auth_db_pedadidasybasequoting'] = 'Use sybase quotes';
$string['auth_db_pedadidasybasequotinghelp'] = 'Sybase style single quote escaping - needed for Oracle, MS SQL and some other databases. Do not use for MySQL!';
$string['auth_db_pedadidatable'] = 'Name of the table in the database';
$string['auth_db_pedadidatable_key'] = 'Table';
$string['auth_db_pedadidatype'] = 'The database type (See the <a href="http://phplens.com/adodb/supported.databases.html" target="_blank">ADOdb documentation</a> for details)';
$string['auth_db_pedadidatype_key'] = 'Database';
$string['auth_db_pedadidaupdatinguser'] = 'Updating user {$a->name} id {$a->id}';
$string['auth_db_pedadidauser'] = 'Username with read access to the database';
$string['auth_db_pedadidauser_key'] = 'DB user';
$string['auth_db_pedadidausernotexist'] = 'Cannot update non-existent user: {$a}';
$string['auth_db_pedadidauserstoadd'] = 'User entries to add: {$a}';
$string['auth_db_pedadidauserstoremove'] = 'User entries to remove: {$a}';

