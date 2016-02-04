<?php
/**
 * My Application sample
 * 
 * PHP version 5
 *
 * @category Cxptest_CI
 * @package  App
 * @author   Mike Hudson <mhudson@connexionpoint.com>
 * @license  http://mhudson-cxp.github.com/ Apache License 2.0
 * @version  GIT:  $Id$
 * @link     http://mhudson-cxp.github.com/
 */
namespace App;

/**
 * My Application sample
 *
 * @category SampleCiWithPhp
 * @package  App
 * @author   Mike Hudson <mhudson@connexionpoint.com>
 * @license  http://mhudson-cxp.github.com/ Apache License 2.0
 * @version  Release:  1.0
 * @link     http://mhudson-cxp.github.com/
 */
class App
{
    /**
     * This will run the application.
     * 
     * @return integer
     */
    public function run()
    {
        return 42;
    }
}
?>
<HTML>
    <HEAD>
        <TITLE>cxptest</TITLE>
        <script>
            function startTime()
                {
                    var today=new Date();
                    var h=today.getHours();
                    var m=today.getMinutes();
                    var s=today.getSeconds();
                    // add a zero in front of numbers<10
                    h=checkTime(h);
                    m=checkTime(m);
                    s=checkTime(s);
                    document.getElementById('txt').innerHTML=h+":"+m+":"+s;
                    t=setTimeout(function(){startTime()},500);
                }

            function checkTime(i)
                {
                    if (i<10)
                {
                    i="0" + i;
                }
                    return i;
                }
        </script>
    </HEAD>
    <BODY onload="startTime()">
        <FONT COLOR="red">cxptest</FONT> PHP Application<BR><BR>
        <div id="txt"></div>
        <BR><BR><BR>
    </BODY>
</HTML>