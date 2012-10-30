#Behat and BrowserMobProxy 

Usage 

Install PHPBrowserMob Proxy

       $ sudo pear channel-discover element-34.github.com/pear
       $ sudo pear install -f element-34/PHPBrowserMobProxy
       $ sudo pear install -f element-34/Requests

Download latest version of the BrowserMob Proxy & Start it 

        $ cd browsermob-proxy-2.0-beta-6/
        $ cd bin
        $ sh browsermob-proxy -port 9090

Download Selenium Server and Start it 

       $ java -jar selenium-server-standalone-2.25.0.jar

#Install Behat & Run feature

        $ curl http://getcomposer.org/installer | php
        $ php composer.phar install

Now Run Behat to see test running in the browser

        $ ./bin/behat


#HAR file Generated 
See the HAR file is generated at '/tmp/BROWSERMOBHAR.har'

Use it for further tweaks