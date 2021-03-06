<?php $debug = false ?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aan de lanen</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
    <link type="text/css" href="./css/nouislider.min.css" rel="stylesheet">
    <link type="text/css" href="./css/style.min.css?<?php echo filemtime('./css/style.min.css'); ?>" rel="stylesheet">
    <?php
	if ($debug == true) {
		echo '<script type="text/javascript">var debug=true;</script>';
		$files = glob("../source/*.js");
		sort($files);
		foreach ($files as $file) {
			echo '<script type="text/javascript" src="' . $file . '"></script>';
		}
	} else {
		echo '<script type="text/javascript">var debug=false;</script>';
		echo '<script type="text/javascript" src="./js/generic-min.js?' . filemtime('./js/generic-min.js') . '"></script>';
		//echo '<script type="text/javascript">if(console && console.log)console.log=function(){}</script>';
	}
	?>
</head>

<body>
    <div id="container" class="clearfix init animation">
        <header class="clearfix">
            <img width="31" height="45" src="./img/amsterdam-sloterdijk-mo-town-logo-100px.png" alt="Logo">
            <ul>
                <li>Woningzoeker</li>
            </ul>
        </header>

        <div id="unit-filter" class="clearfix">
            <div>
                <div class="col slider">
                    <div class="slider-tooltip small" id="price-from"></div>
                    <div class="slider-tooltip small" id="price-to"></div>
                    <div id="slider-price"></div>
                </div>
                <div class="col slider">
                    <div class="slider-tooltip small" id="livingsurface-from"></div>
                    <div class="slider-tooltip small" id="livingsurface-to"></div>
                    <div id="slider-livingsurface"></div>
                </div>
                <div class="col">
                    <select name="name" autocomplete="off">
                        <option value="">Woningtype</option>
                    </select>
                </div>
                <div class="col">
                    <select name="level" autocomplete="off">
                        <option value="">Verdieping</option>
                    </select>
                </div>
                <div class="col">
                    <select name="roomcount" autocomplete="off">
                        <option value="">Aantal kamers</option>
                    </select>
                </div>
                <div class="col">
                    <select name="status" autocomplete="off">
                        <option value="">Beschikbaarheid</option>
                    </select>
                </div>
                <div class="col-reset">
                    <button class="filter-clear"></button>
                </div>
            </div>
        </div>

        <div id="viewport" class="clearfix">
            <div class="unit-container-overlay"></div>
            <div id="block-container">
                <ul class="tabbar">
                    <li class="btn color-secondary">Westgevel</li>
                    <li class="btn color-secondary">Zuid-Westgevel</li>
                    <li class="btn color-secondary">Zuidgevel</li>
                    <li class="btn color-secondary">Oostgevel</li>
                </ul>
                <div class="unit-selector-height"></div>
                <div class="pointer boxshadow">
                    <span class="value-id">-</span>
                </div>
                <div id="block-prev" class="btn color-secondary block-button"><img src="./img/button-prev.svg"></div>
                <div id="block-next" class="btn color-secondary block-button"><img src="./img/button-next.svg"></div>
                <div class="unit-selector">
                    <div class="unit-content">
                        <?php
						$svg = file_get_contents('./img/31608 - Ext 01-small.svg'); //west
						echo preg_replace('/\t|\n|\r/', '', preg_replace("#<!DOCTYPE[^>[]*(\[[^]]*\])?>#sim", "", $svg));
                        ?>
                    </div>
                </div>
                <div class="unit-selector">
                    <div class="unit-content">
                        <?php
						$svg = file_get_contents('./img/31608 - Ext 03-small.svg'); //zuidwest
						echo preg_replace('/\t|\n|\r/', '', preg_replace("#<!DOCTYPE[^>[]*(\[[^]]*\])?>#sim", "", $svg));
                        ?>
                    </div>
                </div>
                <div class="unit-selector">
                    <div class="unit-content">
                        <?php
						$svg = file_get_contents('./img/31608 - Ext 05-small.svg'); //zuid
						echo preg_replace('/\t|\n|\r/', '', preg_replace("#<!DOCTYPE[^>[]*(\[[^]]*\])?>#sim", "", $svg));
                        ?>
                    </div>
                </div>
                <div class="unit-selector">
                    <div class="unit-content">
                        <?php
						$svg = file_get_contents('./img/31608 - Ext 06-small.svg'); //oost
						echo preg_replace('/\t|\n|\r/', '', preg_replace("#<!DOCTYPE[^>[]*(\[[^]]*\])?>#sim", "", $svg));
                        ?>
                    </div>
                </div>
            </div>

            <div id="unit-container">

                <div id="unit-info">
                    <div id="unit-close">???</div>

                    <div id="unit-header">
                        <h1><span class="unit-name">&nbsp;</span> <span class="unit-id"></span></h1>
                    </div>

                    <h2 class="clearfix"><span class="unit-status"></span><span class="unit-price">&nbsp;</span></h2>
                    <div id="unit-image">
                        <ul class="tabbar"></ul>
                        <div class="zoom"></div>
                    </div>

                    <div class="rows clearfix">

                        <div class="row prop"><span class="label">Verdieping</span><span class="unit-level"></span>
                        </div>
                        <div class="row prop"><span class="label">Woonoppervlakte</span><span
                                class="unit-livingsurface"></span></div>
                        <div class="row prop"><span class="label">Inhoud</span><span class="unit-volume"></span></div>
                        <div class="row prop"><span class="label">Kamers</span><span class="unit-roomcount"></span>
                        </div>
                        <div class="row prop"><span class="label">Terras</span><span class="unit-terrace"></span></div>
                        <div class="row prop"><span class="label">Ori&euml;ntatie terras</span></span><span
                                class="unit-orientationterrace"></span></div>

                        <div class="row prop dummy"><span class="label">&nbsp;</span><span
                                class="unit-dummy">&nbsp;</span></div>
                    </div>

                    <a id="unit-form-btn" href="https://www.nieuwbouw-demaasbode.nl/"
                        class="btn btn-disabled placeholder" target="bpd">Meer info</a>
                    <a id="unit-contact-btn" href="https://www.nieuwbouw-motown.nl/service/contact"
                        class="btn btn-disabled color-secondary placeholder" target="bpd">Interesse? Neem contact
                        op!</a>
                </div>

                <div id="unit-list">
                    <div id="filter-message">
                        <h2>Geen woningen gevonden</h2>
                        <p>Er zijn geen woningen die voldoen aan jouw wensen. Pas je wensen in het zoekfilter aan.</p>
                        <button class="filter-clear btn" type="button">Reset filter</button>
                    </div>
                    <ul></ul>
                </div>
            </div>
        </div>
    </div>
</body>

</html>