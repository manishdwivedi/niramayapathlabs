A recent update to Microsoft Internet Explorer included a change that 
alters the way users interact with applets in the browser. 
Microsoft Internet Explorer running on the following platforms are 
affected by this change:

    * Microsoft Windows XP Service Pack 2 (SP2)
    * Microsoft Windows Server 2003 Service Pack 1 (SP1)
    * Supported versions of Windows XP and Windows Server 2003

With this change, users can no longer directly interact with applets by default.
Users are first required to manually activate the applet's user interface, before
interacting with the applets. If the page has multiple applets, users have to 
activate each applet's user interface individually. 

How JFileUpload is affected by this IE update ?
 1 - Drag&Drop seems to not work.
 2 - You need to double-click on File menu to select a file.
 3 - "Click to active" message is displayed.
 
How to fix this issue ?
 Try applet_http_kb912945.html + applet_http.js included for HTTP upload.
 Try applet_ftp_kb912945.html + applet_ftp.js included for FTP upload.

See :
- http://java.sun.com/developer/technicalArticles/J2SE/Desktop/ieappletguide/index.html
- http://support.microsoft.com/kb/912945/en-us

Note that this issue also affects Flash, Acrobat, QuickTime and real player plugins.