<html>
    <head><title><?php echo $GLOBALS['sitename']; ?></title>
        <style>
            body {
                font-family: helvetica;
            }

            p {
                padding: 20px;
            }
            .ribbon {
                font-size: 16px !important;
                /* This ribbon is based on a 16px font side and a 24px vertical rhythm. I've used em's to position each element for scalability. If you want to use a different font size you may have to play with the position of the ribbon elements */

                width: 50%;

                position: relative;
                background: #ba89b6;
                color: #fff;
                text-align: center;
                padding: 1em 2em; /* Adjust to suit */
                margin: 2em auto 3em; /* Based on 24px vertical rhythm. 48px bottom margin - normally 24 but the ribbon 'graphics' take up 24px themselves so we double it. */
            }
            .ribbon:before, .ribbon:after {
                content: "";
                position: absolute;
                display: block;
                bottom: -1em;
                border: 1.5em solid #986794;
                z-index: -1;
            }
            .ribbon:before {
                left: -2em;
                border-right-width: 1.5em;
                border-left-color: transparent;
            }
            .ribbon:after {
                right: -2em;
                border-left-width: 1.5em;
                border-right-color: transparent;
            }
            .ribbon .ribbon-content:before, .ribbon .ribbon-content:after {
                content: "";
                position: absolute;
                display: block;
                border-style: solid;
                border-color: #804f7c transparent transparent transparent;
                bottom: -1em;
            }
            .ribbon .ribbon-content:before {
                left: 0;
                border-width: 1em 0 0 1em;
            }
            .ribbon .ribbon-content:after {
                right: 0;
                border-width: 1em 1em 0 0;
            }
            .wrapper {
                margin: 50px auto;
                width: 640px;
                padding: 40px;
                background: white;
                border-radius: 10px;
                -webkit-box-shadow: 0px 0px 8px rgba(0,0,0,0.3);
                -moz-box-shadow:    0px 0px 8px rgba(0,0,0,0.3);
                box-shadow:         0px 0px 8px rgba(0,0,0,0.3);
                position: relative;
                z-index: 90;
            }

            .ribbon2-wrapper-green {
                width: 85px;
                height: 88px;
                overflow: hidden;
                position: absolute;
                top: -3px;
                right: -3px;
            }

            .ribbon2-green {
                font: bold 15px Sans-Serif;
                color: #333;
                text-align: center;
                text-shadow: rgba(255,255,255,0.5) 0px 1px 0px;
                -webkit-transform: rotate(45deg);
                -moz-transform:    rotate(45deg);
                -ms-transform:     rotate(45deg);
                -o-transform:      rotate(45deg);
                position: relative;
                padding: 7px 0;
                left: -5px;
                top: 15px;
                width: 120px;
                background-color: #BFDC7A;
                background-image: -webkit-gradient(linear, left top, left bottom, from(#BFDC7A), to(#8EBF45)); 
                background-image: -webkit-linear-gradient(top, #BFDC7A, #8EBF45); 
                background-image:    -moz-linear-gradient(top, #BFDC7A, #8EBF45); 
                background-image:     -ms-linear-gradient(top, #BFDC7A, #8EBF45); 
                background-image:      -o-linear-gradient(top, #BFDC7A, #8EBF45); 
                color: #6a6340;
                -webkit-box-shadow: 0px 0px 3px rgba(0,0,0,0.3);
                -moz-box-shadow:    0px 0px 3px rgba(0,0,0,0.3);
                box-shadow:         0px 0px 3px rgba(0,0,0,0.3);
            }

            .ribbon2-green:before, .ribbon2-green:after {
                content: "";
                border-top:   3px solid #6e8900;   
                border-left:  3px solid transparent;
                border-right: 3px solid transparent;
                position:absolute;
                bottom: -3px;
            }

            .ribbon2-green:before {
                left: 0;
            }
            .ribbon2-green:after {
                right: 0;
            }
        </style>
    </head>
    <body>
        <div class="wrapper">
            <div class="ribbon2-wrapper-green"><div class="ribbon2-green">Beta</div></div>
            <h1 class="ribbon">
                <strong class="ribbon-content"><?php echo $name; ?><br><sup>it works!</sup></strong>
            </h1>
            <p>Everything is working fine.<br> 
                Now you can start to code your next awesome project. </p>
            <p>Read the documentation at <a href="http://lambda-code.github.io/Hailey/">Github</a>
                and check for updates.</p>
            <p><img src="haileylogo.png" height="400">
            </p>
        </div>
    </body>
</html>