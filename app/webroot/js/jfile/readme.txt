JFileUpload 2.8
http://www.jfileupload.com

==========================================================
JFileUpload homepage:
http://www.jfileupload.com/products/jfileupload/index.html

Support forums:
http://www.jfileupload.com/support/forums/index.php
==========================================================

* Open applet_http.html or applet_ftp.html for sample *
* Open documentation/index.html for documentation and FAQ *


----------------
01/17/2011: v2.8
----------------
- IPv6 support support added for FTP.
- CRC32 and MD5 checksum added for FTP.
- "chunkmode=onflyrange" support added for HTTP PUT.
- "preemptiveauth" regular parameter added.
- "cookiesource" extra parameter added to load cookies from Java Plugin.
- "resumeheader" extra parameter added to improve resume support.
- i18n.properties improved:
  progress.bar.upload.checksum.failed.label


----------------
08/17/2010: v2.7
----------------
- whitelist and blacklist parameters can be updated from JavaScript.
- JavaScript functions added to fix issues under Chrome and FireFox:
  getExtra, setExtra, getRegular, setRegular, cancel().
- Language detection and resource loading sample added.
- encoding=auto added to issue FEAT FTP command for charset auto-detection.
- FTPS implementation improved.
- Transfertype extra parameter bug fix.
- i18n.properties improved:
  authentication.username.empty


----------------
04/15/2010: v2.6
----------------
- URL support added for resources parameter.
- listcommmand extra parameter added to select FTP list command for overwrite.
- MKCOL support added for HTTP PUT upload.
- metascope parameter added to meta data for status, post and forward support.
- templatescope parameter added to allow path renaming.
- notifyrelativefilename=full option added to forward renamed info. 
- cookieheader=singleline extra parameter added for cookies compatibility.
- i18n support improved to fix applet warning for JRE 1.6.0_19 (or higher).


----------------
11/10/2009: v2.5
----------------
- Multiple cookies support added with cookienameX/cookievalueX.
- Resume support for chunks upload added with chunkmode=onflyrange.
- 'chunkbasesize' multipart parameter added for chunks.
- 'retryonerrorheader' extra parameter added for conditional retry attempts.
- Auto increment identifier added to renaming template.
- "identifierinit" regular parameter added.
- "localeresourcesextension" regular parameter added.
- Encryption custom delimiters added.
- Authentication popup window centered over front-end.
- i18n.properties improved:
   filechooser.dialog.lnk
   fileprogressbar
> Add-ons section updated:
   - JFileDownload: It provides files/folders download support.


----------------
05/25/2009: v2.4
----------------
- Proxy auto-detection bug fixed for JRE 1.6.0_10 and higher.
- Proxy settings can be updated from JavaScript.
- Socket buffersize parameter available for HTTP transfer.
- i18n.properties improved:
   filechooser.dialog.enterkey
- Internet Explorer 8 support added.
> Add-ons section updated:
   - FlickrUpload: It adds Flickr upload support.


----------------
02/03/2009: v2.3
----------------
- Encryption support added for login and password.
- archivemaxsize parameter added for overall ZIP archiving.
- i18n.properties improved:
   progress.button.cancel.align
   progress.button.select.align
   progress.button.layout
   progress.bar.upload.layout
   progress.info.layout
- Bug fix in overall ZIP archiving for blacklist and whitelist.
- Bug fix for single chunk with chunkratio property enabled.
> Add-ons section updated:
   - SFTP: It adds SSH File Transfer Protocol support.
   - JS3Explorer: It provides an Amazon S3 file manager.
 

----------------
11/03/2008: v2.2
----------------
- Persistent preferences support added.
- Overall ZIP archiving before upload support added.
- "localeresources" parameter added to workaround unexpected I18N HTTP requests.
- i18n.properties improved:
   taskoutput.scrollbar.vertical
   taskoutput.preprocessingfilter.starting
   taskoutput.preprocessingfilter.completed
   taskoutput.preprocessingfilter.failed
   progress.bar.upload.preprocessingfilter.starting
   progress.bar.upload.preprocessingfilter.started
   progress.bar.upload.preprocessingfilter.completed
   progress.bar.upload.preprocessingfilter.failed
   progress.bar.upload.split.starting
   progress.bar.upload.split.started
   progress.bar.upload.split.completed
   progress.bar.upload.split.failed
   frame.icon
- Documentation and tutorials updated.
- Java 1.6 update 10 support.
- Google Chrome support.


----------------
06/23/2008: v2.1
----------------
- Multiple chained filters support added.
- "chmodafterupload" extra parameter added for FTP.
- "accountcreationchmod" extra parameter added for FTP.
- "ftpcommandmonitor" extra parameter added to support FTP STAT command.
- "buffersize" parameter support added for FTP.
- Drag & drop \000 bug fixed under Linux Suse and Ubuntu.
- Multiple "/" bug fixed for CWD FTP command.
- Bug fixed for grayscale image previewing.
- "template" + "chunksize" behavior improved.
- "hideinfo" parameter added.
- "WWW-Authenticate: NTLM" bug fixed.
- "httpntlmdomain" extra parameter added.
- "headextraparameters" extra parameter.
- Internationalization improved with new properties:
   taskoutput.filter.starting
   progress.bar.upload.filter.starting
   progress.bar.upload.indeterminate
> Add-ons section updated:
   - PERLScript: Perl upload sample script for JFileUpload.


----------------
02/28/2008: v2.0
----------------
- Applet digitally signed by a trusted certificate.
- "retry" and "retrydelay" parameters added to attempt retries
  when current upload fails.
- Regular expression support added for "template" parameter.
- "filetimestamp" extra parameter added for HTTP upload.
- Epoch timestamp added with "extra" value for postparameters.
- "commandmonitor" extra parameter added for FTP.
- "retry" regular parameter added.
- i18n.properties improved:
   progress.bar.upload.option
   filechooser.preview.image.forcergb
   taskoutput.upload.failed.filesonly.error
- Encoding bug fix for resume and overwrite feature.
- Files left counter bug fix on progress bar with chunks.
- FTP transfer type support improved.
- HTTP Client upgraded to 3.1
- Documentation updated
   API & Design section improved.
   Tutorials section added.


------
v1.9.3
------
- uihelper property added.
- Authentication pop-up improved.
- chunkextension extra parameter added.
- notifyrelativefilename extra parameter added.
- extrarelative support added for post parameter.
- cancelonstop parameter added.
- transfer speed/time remaining refresh rate improved.
> Add-ons section updated:
   - JS3Upload: Amazon S3 bucket upload support.
   - JSAPI: Enhanced JavaScript API.


------
v1.9.2
------
- "zipmaxsize" parameter added.
- Time remaining support added for progress.info property.
- Transfer speed added to time elapsed/timeremaining message.
- "remoteverification" extra parameter added for FTP.
- "forward" parameter implemented for WebStart.
- i18n.properties improved:
   frame.title
   progress.bar.upload.completed.label
   progress.bar.upload.filter.started
   progress.bar.upload.filter.completed
   progress.bar.upload.filter.failed
   progress.button.cancel.font.size.factor
   progress.button.cancel.font.style
   progress.button.select.font.size.factor
   progress.button.select.font.style
   progress.bar.font.size.factor
   progress.bar.font.style
   progress.info.label.align
   progress.info.label.foreground
   progress.info.label.background
> Add-ons section updated :
   - JBatchUpload: This plugin allows add files in a queue before 
                   uploading.


------
v1.9.1
------
- "checksum" parameter added:
   It allows to compute and send MD5/CRC32 for HTTP uploads.
- "resumecommand" extra parameter added to improve FTP resume:
   It allows to use APPE FTP command when resuming.
- "accountpwd" extra parameter added to allow PWD initial command.
- "chunkmode" parameter added to support on-fly chunking.
- Progress bar color bug fixed.
- New properties available in i18n.properties :
   progress.bar.upload.starting.label
   progress.bar.upload.checksum.started.label
   progress.bar.upload.checksum.completed.label
   progress.bar.upload.compress.started
   progress.bar.upload.compress.completed
   progress.bar.upload.compress.failed
- Documentation updated.
- Windows Vista support added.
> Add-ons section updated :
   - JImageUpload: This plugin allows to preview images with thumbnails
                   before uploading.


----
v1.9
----
- minsize parameter added.
- i18n.properties improved :
   filechooser.dialog.open.button
   filechooser.dialog.open.button.tooltip
   filechooser.dialog.cancel.button
   filechooser.dialog.cancel.button.tooltip
   progress.bar.upload.completing.label
   progress.bar.upload.completing.color
   taskoutput.upload.failed.minsize.error
- Empty folder bug fixed for "Select files" button.
- Files remaining message added to progress.bar.upload.label property.
- ArrayIndexOutOfBound bug fixed for overall progress bar with JImageFilter.
- HTML/JavaScript samples updated.
- WeakSSL add-on updated.
- Documentation updated.

+ Internet Explorer 7.0 support.
+ Firefox 2.0 support.
+ Opera 9.0 support.
+ kb912945 (click to activate) workaround included.


----
v1.8
----
- GZIP support added for "ziponfly" parameter.
- "startdir" parameter added for file chooser.
- "authentication" parameter added (allowing to prompt user for credentials).
- "blacklist" parameter added.
- "zipignorelist" parameter added.
- "transfertype" extra parameter added for FTP.
- Drag&Drop with whitelist bug fixed.
- Time elapsed bug fixed.
- i18n.properties improved :
   filechooser.dialog.filefilter.label
   filechooser.dialog.filefilter.blacklist
   progress.bar.upload.done.label
   progress.bar.upload.failed.label
   progress.bar.upload.cancelled.label
   taskoutput.linewrap
   dnd
- setProperty JavaScript method improved.
- Documentation updated.
- "Click to activate" (KB912945) workaround for IE included.
- JRE 1.6 support added.
> Add-ons section updated :
   - JDiskExplorer: This plugin provides an explorer-like front-end.
   - JSEHTTP: This plugin adds Single Sign On support for NTLM proxy.


----
v1.7
----
- Image preview support added to file chooser.
- Custom messages added in i18n.properties for progress bars while uploading :
   progress.bar.upload.label=Uploading {0}% ({1})
   progress.info=overallprogressbar 
   progress.info.label=Overall upload {0}% ({1}/{2})
   progress.info.option=fileratio
- ArrayIndexOutOfBound bug fixed for overallprogressbar with chunksize.
- JavaScript to Applet API improved.
   setProperty(param,value) function added to update parameters.
- lookandfeel property improved :
   classname or auto to select platform L&F.
- Username, password and url could be setup in i18n.properties.
- Documentation improved.


----
v1.6
----
- resume feature added for both FTP and HTTP.
- FTPS support added (SSL/TLS implicit and explicit with channel protection).
- overwrite parameter added.
- Renaming feature added through "template" parameter.
- Cancel button could be removed.
- Optional "Select file(s)" button added :
   You could enable a button to browse files/folders through the following
   keys in i18n.properties :
    progress.button.select=Select file(s)
    progress.button.select.color.background=EEEEFF
    progress.button.select.color.foreground=000033
    progress.button.select.disabled.color=000099
- Optional background image added through taskoutput.image.background property.
- Multiple directories upload support improved.
- Read-only devices (CD-ROM/DVD) support added through "tmpfolder" parameter.
- Workaround included for custom HTTP error messages issue.
- Copy/Paste and Drag&Drop support improved for Gnome/Linux and KDE/Linux.
- API improved : Pluggable front-end support added.
- Documentation updated (samples and screenshots included).
> Add-ons section updated :
   - PGP Filter: This plugin allows to PGP encrypt files before upload.
   - PHPScript: This is a working PHP script sample for JFileUpload.

+ Gene6 FTP server support added.
+ Orenosv FTP server support added.


----
v1.5
----
- Auto-detect HTTP proxy settings improved.
- Optional progress info added :
   You can select either an overall transfer progress bar 
   or time elapsed (hh:mm:ss) for current transfer through
   "progress.info" and "progress.info.label" i18n properties
- Redirect after upload feature improved :
   "forward" property allows to append parameter.
   cookiename/cookievalue pair supported in "post" parameter.
   url encoding bug fixed.
- Multiple applet instances on same HTML page support added.
- getState and getFilenames JavaScript methods added.
- "encoding" support added to FTP upload.
- JavaScript setParameter bug fixed.
- Documentation updated.


----
v1.4
----
- username/password parameters added to support HTTP www-authentication.
- Pluggable pre-processing filter API added.
- i18n.properties improved :
   taskoutput.filter.started
   taskoutput.filter.completed
   taskoutput.filter.failed
- Custom look and feel support added.
- Documentation improved.
+ Add-ons section updated :
  - JImageFilter: This plugin allows to scale (generate thumbnails
                  or magnify) images before uploading.


----
v1.3
----
- "hiddenfile" parameter added to accept/deny hidden files for upload.
- "policy" parameter added to abort/ignore unmatching files to upload.
   (This parameter works with whitelist, maxsize and hiddenfile parameters).
- "ziponfly" parameter added.
- "post" and "postparameters" added to allow HTTP POST request after 
   successfull uploads and before optional URL redirection.
- "errorheader" parameter added to pass custom error message from 
   server-side to JFileUpload.
- "deleteonfail" extra parameter added to delete file on FTP server
   if upload is cancelled or failed.
- Bug fix in FTP remote folders creation.
  (recursive feature added).
- i18n.properties improved :
   menu.color.selection.background property added.
   taskoutput.upload.failed.hidden.error property added.
   taskoutput.upload.failed.whitelist.error property added.
   taskoutput.compress.started property added.
   taskoutput.compress.completed property added.
   taskoutput.compress.failed property added.
- Documentation updated.
+ Add-ons section added :
  - WeakSSL plugin: It allows to run JFileUpload under HTTPS with 
    a self-signed SSL certificate and get rid of "No trusted CA" error.
  - ColdFusion sample upload script.


----
v1.2
----
- Base64 parameters encoding support added.
  (Enclose Base64 parameters into [])
- Cookie support added.
- JavaScript to Applet API added.
  setParameter(name,value) added to pass dynamic parameters.
- FTP PASV command support added.
- FTP SITE custom command support added.
- SOCKS proxy support added.
- HTTP proxy support added.
- HTTPS support added.
- Mime-Types support added.
- Internationalization and Multilanguage support improved.
- True Type font support added.
- Colors support bug fixes.
- Documentation updated.

+ GlobalScape FTP server support added.
+ Windows 2003 FTP server support added.
+ JRE 1.5.0 support added.


----
v1.1
----
 - Multiple files selection support added.
   maxfiles parameter added.
 - Directory upload support added.
   folderdepth and relativefilename parameters added.
 - Split feature added to support very large uploads (>2GB).   
   It allows to get rid of 2GB HTTP POST limit of web servers such as Apache.
   Cancel button available while splitting.
   Progress bar available while splitting.
   chunksize parameter added.
 - Redirect after upload feature added.
   forward, forwardparameters and forwardtarget parameters added.
 - FTP support.
   username, password, account parameters added.
 - Copy/Paste (ctrl-v, apple-v) support added.
 - Java Web Start and stand alone application support added.
   (FTP JNLP sample and HTTP JNLP included)
 - Design improved to plug any transport protocol.
 - FTP applet sample and HTTP applet sample included.
 - New optional parameters:
   timeout parameter added for underlying socket.
 - Documentation updated.
 + Safari/MacOSX support added.
 + Internet Explorer/MacOSX support added.
 + Mozilla 1.4.1/Linux support added.
 + BulletProof FTP Server support added.
 + Ability FTP Server support added.


----
v1.0
----
Features:
 - Upload progress bar available.
 - Drag and drop support.
 - Cancel upload included.
 - Whitelist support.
 - max. file size limit support.
 - Up to 5 additional HTTP parameters support.
 - Large uploads support (more than 1GB).
 - Low memory consuming.
 - Fast and easy deployment (Applet).
 - Multilanguage support.
 - HTTP Multipart/form-data (RFC 1867) compliant.
 - JSP/Servlet, ASP/.NET, PHP, Perl/CGI support for server-side.
 - Customizable colors.
 - Flexible API
   (Cookies support, HTTP 1.0/1.1 support, ...)

Security:
 JFileUpload JAR files include a trusted X509 certificate to get rid
 of security restrictions (access to local disk to select files to upload).


Note:
----
JFileUpload supports Commons-HTTPClient 3.1 and includes Commons-Logging 1.1.
Learn more about Commons-Logging: http://jakarta.apache.org/commons/logging/
Learn more about Commons-HTTPClient: http://jakarta.apache.org/commons/httpclient/
Learn more about Commons-NET: http://jakarta.apache.org/commons/net/
Learn more about ORO: http://jakarta.apache.org/oro/