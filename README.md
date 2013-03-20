# WHM Data Warehouse
    Project Home: http://aysmedia.com/code/whmdw/  
    Project Demo: http://demos.aysmedia.com/whmdw/  
    Code Home: http://github.com/aysmedia/whmdw/  


# About
WHM Data Warehouse is a data warehouse application for WHM (Web Host Manager) written in PHP & MySQL. For more information on WHM please see the 'References' section below.  

A client of ours wanted us to create a small web app that amongst other things would allow them to create new email addresses at one of their domains, without requiring WHM or cPanel access. This would allow them to have any employee create new email addresses, since they would have minimal access and could not do anything to mess up WHM or cPanel.  

While we were creating the app we found it much easier and safer to just import entire sections of the WHM into a local database and then manipulate the information there. This means that we weren't working on the actual WHM database, completely eliminating the chances of us harming live data.  

And just like that, the WHM Data Warehouse was born. We figured if we can benefit from this application, others may be able to as well.  

As this project is in its infancy, not all available WHM information is pulled into the data warehouse. To see which information is currently being retrieved please see the 'Currently Supported' section below.  


# Live Demo
Not sure if the WHM Data Warehouse is what you're looking for? Don't want to waste your time installing it only to find out that it's not? As developers ourselves, we hate when that happens, so AYS Media always tries to run live demos of our products so that we don't waste your time.  

So go ahead, take our live demo for a test drive before you install! http://demos.aysmedia.com/whmdw/  


# Downloading
You have two options for downloading the WHM Data Warehouse.  

NOTE: Whenever possible we recommend that you use option #1, the git repository download directly from your server.  

1. Use git right from your server to retrieve the source code. To do so, change to the directory where you want to install and run the following command:  

        git clone git://github.com/aysmedia/whmdw.git .  

2. Visit the following URL to download the most recent source code archive: https://github.com/aysmedia/whmdw/archive/master.zip  


# Installation
1. Please choose from one of the following two options:  

    If you used git to retrieve the source code in the previous step, just change to the directory where you ran the git command and your files are already waiting for you.  

    If you downloaded the source code in the previous step, you will now need to upload the archive to your server and then unpack it into the folder where you wish to install.  

2. Create a MySQL database that will be used to store the WHM Data Warehouse information  

3. In the '_includes' folder, copy config.SAMPLE.inc.php to config.inc.php and then update config.inc.php to reflect your server's settings  

4. Open the WHM Data Warehouse in a web browser and click on the "Rebuild Data Warehouse" link  

5. A new browser window will open, which will run a script that creates the initial data warehouse  

6. If you want to see the progress on the data warehouse build you can flip back to the original window and hit refresh  

7. Depending on how much information you have on your server it may take a few minutes for the build to complete  

8. Since the WHM Data Warehouse project is in its infancy, we have not yet built an authentication system into the software. Because of this we highly recommend that you setup your own method of authentication on the installation folder, such as HTTP Authentication (http://en.wikipedia.org/wiki/Basic_access_authentication).  


# Installation (Optional)
If you're going to use the WHM Data Warehouse regularly, you can setup a cron job to the below file to automate the builds.  

    [WHM DW INSTALL PATH]/cron/index.php  


# Usage
The primary purpose of the WHM Data Warehouse is to give you a local copy of your web server's information, however we have also included a lightweight UI so that you can see the data that is stored in the warehouse.  

After installation just load the URL in a web browser and play around in the UI, it's pretty self explanatory.  


# Upgrading
You have two options for upgrading the WHM Data Warehouse.  

1. Use git right from your server to upgrade. To do so, just run the following command from within the directory where you installed the WHM Data Warehouse:  

        git pull  
    
    That's it. Upgrading with git is very easy, which is one of the reasons using git is our recommended method for downloading the WHM Data Warehouse source code.  

2. Visit the following URL to download the most recent source code archive: https://github.com/aysmedia/whmdw/archive/master.zip  

   Them simply unpack the new archive overtop of where you installed the previous version.  


# Currently Supported
The following sections are currently supported, but our end goal is to have every piece of WHM information that can be retrieved via API stored in the data warehouse. The more information in the data warehoue, the more information you have to work with.  

### ACCOUNTS
The following information is retrieved from your WHM and stored in the "_dw_whm_accounts" table in your WHM DW.  

startdate, plan, suspended, theme, shell, maxpop, maxlst, maxaddons, suspendtime, ip, maxsub, domain, maxsql, partition, maxftp, user, suspendreason, unix_startdate, diskused, maxparked, email, disklimit, owner  

### DNS ZONES
The following information is retrieved from your WHM and stored in the "_dw_whm_dns_zones" table in your WHM DW.  

zonefile, domain  

### DNS RECORDS
The following information is retrieved from your WHM and stored in the "_dw_whm_dns_records" table in your WHM DW.  

domain, name, line, nlines, address, class, exchange, preference, expire, minimum, cname, mname, nsdname, raw, refresh, retry, rname, serial, ttl, type, txtdata  


# References
WHM & cPanel: http://cpanel.net/products/cpanelwhm/  


# Support
If you have any questions or comments please visit http://aysmedia.com or email us at code@aysmedia.com  

To report bugs, please visit http://github.com/aysmedia/whmdw/issues/  


# License
WHM Data Warehouse - A Data Warehouse application for WHM (Web Host Manager) written in PHP & MySQL.  
Copyright (C) 2010 Greg Chetcuti  

WHM Data Warehouse is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.  

WHM Data Warehouse is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.  

You should have received a copy of the GNU General Public License along with WHM Data Warehouse. If not, please see http://www.gnu.org/licenses/  
