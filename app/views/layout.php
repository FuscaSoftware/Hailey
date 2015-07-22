<html>
    <head><title><?php echo $GLOBALS['sitename']; ?></title>
        <style>
            body {
                font-family: helvetica;
            }
            
            p {
                padding: 20px;
            }
            .stitched {
                padding: 20px;
                margin: 10px;
                background: #057eff;
                color: #fff;
                font-size: 21px;
                font-weight: bold;
                line-height: 1.3em;
                border: 2px dashed #fff;
                border-radius: 10px;
                box-shadow: 0 0 0 4px #0a8dff, 2px 1px 6px 4px rgba(10, 10, 0, 0.5);
                text-shadow: -1px -1px #1319aa;
                font-weight: normal;
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

            .ribbon-wrapper-green {
                width: 85px;
                height: 88px;
                overflow: hidden;
                position: absolute;
                top: -3px;
                right: -3px;
            }

            .ribbon-green {
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

            .ribbon-green:before, .ribbon-green:after {
                content: "";
                border-top:   3px solid #6e8900;   
                border-left:  3px solid transparent;
                border-right: 3px solid transparent;
                position:absolute;
                bottom: -3px;
            }

            .ribbon-green:before {
                left: 0;
            }
            .ribbon-green:after {
                right: 0;
            }
        </style>
    </head>
    <body>
        <div class="wrapper">
            <div class="ribbon-wrapper-green"><div class="ribbon-green">Beta</div></div>
            <div class="stitched">
                <h2><?php echo $name; ?></h2>
                <sup>Version 0.2</sup>
            </div>
            <p>Everything is working fine.<br> 
                Now you can start to code your next awesome project. </p>
            
        </div>
    </body>
</html>