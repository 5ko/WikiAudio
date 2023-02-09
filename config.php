<?php if (!defined('PmWiki')) exit();
/**
  Written by (c) Petko Yotov 2017-2023   www.pmwiki.org/Petko

  This text is written for PmWiki; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published
  by the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version. See pmwiki.php for full details
  and lack of warranty.
*/

// $EnableRedirect = 0;

##  $WikiTitle is the name that appears in the browser's title bar.
$WikiTitle = 'Wiki.Audio';
$XL['en']['SiteSlogan'] = "Audio tutorials, questions and documents on sound recording, studio technology, recording technology and sound engineering";

##  $ScriptUrl is the URL for accessing wiki pages with a browser.
##  $PubDirUrl is the URL for the core pub directory.

$ScriptUrl = "$UrlScheme://{$_SERVER['SERVER_NAME']}";
$EnablePathInfo = 1; # Clean URLs

$PubDirUrl = "$UrlScheme://{$_SERVER['SERVER_NAME']}/pub";
$FarmPubDirUrl = "$UrlScheme://{$_SERVER['SERVER_NAME']}/pub";


# Per-group subdirectories for page storage
$WikiDir = new PageStore('wiki.d/{$Group}/{$FullName}');


##  If you want to have a custom skin, then set $Skin to the name
##  of the directory (in pub/skins/) that contains your skin files.
##  See PmWiki.Skins and Cookbook.Skins.
$Skin = 'wikiaudioskin';

## Use a separate /modules location for configuration, styles, modules and skins
$ModuleDir = "modules";
$ModuleDirUrl = '/modules';
$SkinLibDirs = array(
  "$ModuleDir/skins/\$Skin"   => "$ModuleDirUrl/skins/\$Skin");

$LocalCSSDir = "$ModuleDir/WikiAudio/css";
$LocalCSSDirUrl = "$ModuleDirUrl/WikiAudio/css";
$LocalDir = "$ModuleDir/WikiAudio";

##  You'll probably want to set an administrative password that you
##  can use to get into password-protected pages.  Also, by default
##  the "attr" passwords for the PmWiki and Main groups are locked, so
##  an admin password is a good way to unlock those.  See PmWiki.Passwords
##  and PmWiki.PasswordsAdmin.
$DefaultPasswords['admin'] = array(
  '@admins',
);


$DefaultPasswords['upload'] = 
$DefaultPasswords['edit'] = array('id:*', '@readers', '@editors', '@patrons' );

$EnableCookieSecure = 1;
$EnableCookieHTTPOnly = 1;
$CookieSameSite = 'Lax';
pm_session_start();


$EnableRecentUploads = 1;
$EnableLocalTimes = 1; # Enable compact (short) local times, in the visitor's timezone.

$DefaultGroup = 'En';
$DefaultPage = 'En.En';

##  Unicode (UTF-8) allows the display of all languages and all alphabets.
##  Highly recommended for new wikis.
include_once("$FarmD/scripts/xlpage-utf-8.php");


# Contains connection details for SMTP and DB, not to be shared in VCS.
include_once("local/.auth.php");

# Utility functions (Petko)
include_once("local/debug.php");


$PmForm['libcalc'] = 'saveto={$FullName} form=#calcform fmt=#calcpost';
$PmForm['biblio'] = 'saveto={$FullName} form=#bform fmt=#bpost';

# Remove second link question mark
$LinkPageCreateFmt = "<a class='createlinktext' rel='nofollow' 
  title='\$LinkAlt' href='{\$PageUrl}'>\$LinkText</a>";
# Add class .wikilink
$LinkPageSelfFmt = "<a class='selflink wikilink' rel='nofollow' 
  title='\$LinkAlt' href='{\$PageUrl}'>\$LinkText</a>";

# Autologin config is in local/.auth.php
SDVA($Modules, array(
  'dbhelper' => 0,
  'smtpmail' => 10,
  'authemail' => 20,
  'pmform' => 100,
  'allegro' => array(1200, 'FormsGroup'=>'Forms', 'group'=>'-Site,-SiteAdmin,-Forms,-PmWiki'),
  'biblio' => array(1400, 'name'=>'Biblio.*'),
  'pausegif' => array(1500, 'action'=>'browse'),
));

include_once("$FarmD/modules/modules/modules.php");

##  PmWiki comes with graphical user interface buttons for editing;
##  to enable these buttons, set $EnableGUIButtons to 1.
$EnableGUIButtons = 1;



##  If you want uploads enabled on your system, set $EnableUpload=1.
##  You'll also need to set a default upload password, or else set
##  passwords on individual groups and pages.  For more information
##  see PmWiki.UploadsAdmin.
$EnableUpload = 1;
$EnableUploadVersions = 1;
$EnableRecentUploads = 1;
$UploadMaxSize = 640*1024*1024;
$UploadBlacklist = array('.php', '.pl', '.cgi', '.py'); # disallow common script files
$UploadPermAdd = 0; # Recommended for most new installations
$UploadNameChars = '-a-zA-Z0-9_.';
$UploadExts['m4a'] = 'audio/aac';
$UploadExts['aac'] = 'audio/aac';
// $AuthCascade['upload'] = 'edit';

##  By default, PmWiki doesn't allow browsers to cache pages.  Setting
##  $EnableIMSCaching=1; will re-enable browser caches in a somewhat
##  smart manner.  Note that you may want to have caching disabled while
##  adjusting configuration files or layout templates.
# $EnableIMSCaching = 1;                   # allow browser caching


##  $DiffKeepDays specifies the minimum number of days to keep a page's
##  revision history.  The default is 3650 (approximately 10 years).
## Copyright for collaborative works lasts 70 years after publication.
$DiffKeepDays = 25567;

$TimeFmt = '%F %R';

## Text shown when a page doesn't exist
$DefaultPageTextFmt = '(:include {$Group}.PageNotFound $[{$SiteGroup}.PageNotFound]:)';

##  You can enable syntax highlighting for the documentation and/or
##  for the edit form. 
$EnablePmSyntax = 2; # 1 or 2, see documentation

# Sortable tables,  (PmWiki core)
$EnableSortable = 1;
$EnableHighlight = 1;
$EnableListIncludedPages = 1;

##  For a basic table of contents, see page PmWiki/TableOfContents
$PmTOC['Enable'] = 1;
$PmTOC['MaxLevel'] = 3;
$PmTOC['NumberedHeadings'] = '1.1.1.1.1.1';
$PmTOC['EnableBacklinks'] = 1;


$Allegro['AnonymousNewPagePat'] = '??.*, ??-*.*, Test.*';

$Allegro['SavePTV'] = "SourceUrl,InterLang,IsTrail,Status,Parent,SPOrder";



$WikiStyleCSS[] = 'line-height';



$EnableNotify = 1;
$NotifyDelay = 120;
$NotifyTimeFmt = '%d/%m %H:%M';

$NotifyItemFmt =
  "* {\$Title}
  {\$PageUrl}
  \$PostTime {\$Author} : \$CleanChangeSummary\n";
// $NotifyBodyFmt = "Recent $WikiTitle posts:\n"
//   . "  https://wiki.audio/wiki/Site/AllRecentChanges\n\n\$NotifyItems\n";
$NotifyHeaders = "Content-type: text/plain; charset=UTF-8";
$FmtV['$CleanChangeSummary'] = preg_replace("/\\s+/", ' ', $ChangeSummary);




# For the wikicode edit form
$EnableEditAutoText = 1;

# Recent changes show page title instead of numeric identifier
$RecentChangesFmt = array(
  '$SiteGroup.AllRecentChanges' => 
    '* [[{$Group}.{$Name}|+]]  . . . $CurrentLocalTime $[by] $AuthorLink: [=$ChangeSummary=]',
  '$Group.RecentChanges' =>
    '* [[{$Group}/{$Name}|+]]  . . . $CurrentLocalTime $[by] $AuthorLink: [=$ChangeSummary=]');

$FmtPV['$Title1'] = 'FmtTitle1($pn)';

function FmtTitle1($pn) {
  $title = PageVar($pn, '$Title');
  return utf8string($title, 0, 1);
}






