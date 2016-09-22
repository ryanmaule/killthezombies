<?php 
$data->width = 900;
$this->load->view('inc_content_header.php',$data);
?>

						<!-- START of content !-->
						<div class="content-full">
							<!-- START of section !-->
							<div class="section">
								<div class="section-head">
									<h2>KILL THE ZOMBIES! STORE</h2>
									<div class="cl">&nbsp;</div>
								</div>
								
<script type="text/javascript">

function mycarousel_initCallback(carousel)
{
    // Disable autoscrolling if the user clicks the prev or next button.
    carousel.buttonNext.bind('click', function() {
        carousel.startAuto(0);
    });

    carousel.buttonPrev.bind('click', function() {
        carousel.startAuto(0);
    });

    // Pause autoscrolling if the user moves with the cursor over the clip.
    carousel.clip.hover(function() {
        carousel.stopAuto();
    }, function() {
        carousel.startAuto();
    });
};

jQuery(document).ready(function() {
    jQuery('#amazoncarousel').jcarousel({
        auto: 3,
        scroll: 2,
        wrap: 'circular',
        initCallback: mycarousel_initCallback
    });
});

</script>

<style>
.jcarousel-skin-tango .jcarousel-container {
	margin-left: -20px;
}

.jcarousel-skin-tango .jcarousel-direction-rtl {
	direction: rtl;
}

.jcarousel-skin-tango .jcarousel-container-horizontal {
    width: 900px;
    height: 160px;
    padding: 20px 40px;
}

.jcarousel-skin-tango .jcarousel-container-vertical {
    width: 110px;
    height: 900px;
    padding: 40px 20px;
}

.jcarousel-skin-tango .jcarousel-clip {
    overflow: hidden;
}

.jcarousel-skin-tango .jcarousel-clip-horizontal {
    width:  900px;
    height: 160px;
}

.jcarousel-skin-tango .jcarousel-clip-vertical {
    width:  110px;
    height: 900px;
}

.jcarousel-skin-tango .jcarousel-item {
	height: 160px;
	min-width: 106px;
	padding: 0 15px;
}

.jcarousel-skin-tango .jcarousel-item-horizontal {
	margin-left: 0;
    margin-right: 10px;
}

.jcarousel-skin-tango .jcarousel-direction-rtl .jcarousel-item-horizontal {
	margin-left: 10px;
    margin-right: 0;
}

.jcarousel-skin-tango .jcarousel-item-vertical {
    margin-bottom: 10px;
}

.jcarousel-skin-tango .jcarousel-item-placeholder {
    background: #fff;
    color: #000;
}

/**
 *  Horizontal Buttons
 */
.jcarousel-skin-tango .jcarousel-next-horizontal {
    position: absolute;
    top: 43px;
    right: 5px;
    width: 32px;
    height: 32px;
    cursor: pointer;
    background: transparent url(/themes/killthezombies/css/images/next-horizontal.png) no-repeat 0 0;
    display: none !important;
}

.jcarousel-skin-tango .jcarousel-direction-rtl .jcarousel-next-horizontal {
    left: 5px;
    right: auto;
    background-image: url(/themes/killthezombies/css/images/prev-horizontal.png);
}

.jcarousel-skin-tango .jcarousel-next-horizontal:hover,
.jcarousel-skin-tango .jcarousel-next-horizontal:focus {
    background-position: -32px 0;
}

.jcarousel-skin-tango .jcarousel-next-horizontal:active {
    background-position: -64px 0;
}

.jcarousel-skin-tango .jcarousel-next-disabled-horizontal,
.jcarousel-skin-tango .jcarousel-next-disabled-horizontal:hover,
.jcarousel-skin-tango .jcarousel-next-disabled-horizontal:focus,
.jcarousel-skin-tango .jcarousel-next-disabled-horizontal:active {
    cursor: default;
    background-position: -96px 0;
}

.jcarousel-skin-tango .jcarousel-prev-horizontal {
    position: absolute;
    top: 43px;
    left: 5px;
    width: 32px;
    height: 32px;
    cursor: pointer;
    background: transparent url(/themes/killthezombies/css/images/prev-horizontal.png) no-repeat 0 0;
    display: none !important;
}

.jcarousel-skin-tango .jcarousel-direction-rtl .jcarousel-prev-horizontal {
    left: auto;
    right: 5px;
    background-image: url(/themes/killthezombies/css/images/next-horizontal.png);
}

.jcarousel-skin-tango .jcarousel-prev-horizontal:hover, 
.jcarousel-skin-tango .jcarousel-prev-horizontal:focus {
    background-position: -32px 0;
}

.jcarousel-skin-tango .jcarousel-prev-horizontal:active {
    background-position: -64px 0;
}

.jcarousel-skin-tango .jcarousel-prev-disabled-horizontal,
.jcarousel-skin-tango .jcarousel-prev-disabled-horizontal:hover,
.jcarousel-skin-tango .jcarousel-prev-disabled-horizontal:focus,
.jcarousel-skin-tango .jcarousel-prev-disabled-horizontal:active {
    cursor: default;
    background-position: -96px 0;
}

/**
 *  Vertical Buttons
 */
.jcarousel-skin-tango .jcarousel-next-vertical {
    position: absolute;
    bottom: 5px;
    left: 43px;
    width: 32px;
    height: 32px;
    cursor: pointer;
    background: transparent url(/themes/killthezombies/css/images/next-vertical.png) no-repeat 0 0;
    display: none !important;
}

.jcarousel-skin-tango .jcarousel-next-vertical:hover,
.jcarousel-skin-tango .jcarousel-next-vertical:focus {
    background-position: 0 -32px;
}

.jcarousel-skin-tango .jcarousel-next-vertical:active {
    background-position: 0 -64px;
}

.jcarousel-skin-tango .jcarousel-next-disabled-vertical,
.jcarousel-skin-tango .jcarousel-next-disabled-vertical:hover,
.jcarousel-skin-tango .jcarousel-next-disabled-vertical:focus,
.jcarousel-skin-tango .jcarousel-next-disabled-vertical:active {
    cursor: default;
    background-position: 0 -96px;
}

.jcarousel-skin-tango .jcarousel-prev-vertical {
    position: absolute;
    top: 5px;
    left: 43px;
    width: 32px;
    height: 32px;
    cursor: pointer;
    background: transparent url(/themes/killthezombies/css/images/prev-vertical.png) no-repeat 0 0;
    display: none !important;
}

.jcarousel-skin-tango .jcarousel-prev-vertical:hover,
.jcarousel-skin-tango .jcarousel-prev-vertical:focus {
    background-position: 0 -32px;
}

.jcarousel-skin-tango .jcarousel-prev-vertical:active {
    background-position: 0 -64px;
}

.jcarousel-skin-tango .jcarousel-prev-disabled-vertical,
.jcarousel-skin-tango .jcarousel-prev-disabled-vertical:hover,
.jcarousel-skin-tango .jcarousel-prev-disabled-vertical:focus,
.jcarousel-skin-tango .jcarousel-prev-disabled-vertical:active {
    cursor: default;
    background-position: 0 -96px;
}
</style>

<?php
//check that there are items in the response
if (isset($response['Items']['Item']) ) {

	$response = array_slice($response,0,12);

	echo '<ul id="amazoncarousel" class="jcarousel-skin-tango">';

    //loop through each item
    foreach ($response['Items']['Item'] as $result) {

        //check that there is a ASIN code - for some reason, some items are not
        //correctly listed. Im sure there is a reason for it, need to check.
        if (isset($result['ASIN'])) {

            //store the ASIN code in case we need it
            $asin = $result['ASIN'];

            //check that there is a URL. If not - no need to bother showing
            //this one as we only want linkable items
            if (isset($result['DetailPageURL'])) {

                echo '<li>';

                //create the URL link
                echo '<a href="/store/item/' . $asin .'">';

                //if there is a small image - show it
                if (isset($result['SmallImage']['URL'] )) {
                    echo '<img src="'. $result['MediumImage']['URL'] .'" title="'. $result['ItemAttributes']['Title'] .'">';
                }

                // if there is a title - show it
                if (isset($result['ItemAttributes']['Title'])) {
                    //echo $result['ItemAttributes']['Title'];
                }
                
                echo '</a>';

                echo '</li>';

            }
        }
        
    }
    
    echo '</ul>';

} else {

    //display that nothing was found - should no results be found
    echo '<p  style="">No Amazon suggestions found</p>';

}
?>
							</div>
							<!-- END of section !-->
						</div>
						<!-- END of content !-->

<?php $this->load->view('inc_content_footer.php'); ?>